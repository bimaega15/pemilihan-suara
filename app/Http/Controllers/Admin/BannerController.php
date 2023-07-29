<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $getCurrentUrl = Check::getCurrentUrl();
        if (!isset(Check::getMenu($getCurrentUrl)[0])) {
            abort(403, 'Cannot access page');
        }
        $getMenu = Check::getMenu($getCurrentUrl)[0];

        session()->put('bannerAcess.is_create', $getMenu->is_create);
        session()->put('bannerAcess.is_update', $getMenu->is_update);
        session()->put('bannerAcess.is_delete', $getMenu->is_delete);


        //
        if ($request->ajax()) {
            $bannerAcess = session()->get('bannerAcess');

            $data = Banner::all();
            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonUpdate = '';
                if ($bannerAcess['is_update'] == '1') {
                    $buttonUpdate = '
                    <a href="' . route('admin.banner.edit', $v_data->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                    <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                }
                $buttonDelete = '';
                if ($bannerAcess['is_delete'] == '1') {
                    $buttonDelete = '
                    <form action=' . route('admin.banner.destroy', $v_data->id) . ' class="d-inline">
                        <button type="submit" class="btn-delete btn btn-outline-danger m-b-xs" style="border-color: #F11A7B !important;">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                    ';
                }


                $button = '
                <div class="text-center">
                    ' . $buttonUpdate . '
                    ' . $buttonDelete . '
                </div>
                ';

                $url_gambar_banner = asset('upload/banner/' . $v_data->gambar_banner);
                $gambar_banner = '<a class="photoviewer" href="' . $url_gambar_banner . '" data-gallery="photoviewer" data-title="' . $v_data->gambar_banner . '">
                    <img src="' . $url_gambar_banner . '" width="100%;"></img>
                </a>';

                $result['data'][] = [
                    $no++,
                    $gambar_banner,
                    $v_data->judul_banner,
                    $v_data->keterangan_banner,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
        return view('admin.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'judul_banner' => 'required',
            'gambar_banner' => 'image|max:2048',
        ], [
            'required' => ':attribute wajib diisi',
            'image' => ':attribute harus berupa gambar',
            'max' => ':attribute tidak boleh lebih dari :max',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'invalid form validation',
                'result' => $validator->errors()
            ], 400);
        }

        // biodata
        $file = $request->file('gambar_banner');
        $gambar_banner = $this->uploadFile($file);

        $data = [
            'judul_banner' => $request->input('judul_banner'),
            'gambar_banner' => $gambar_banner,
            'keterangan_banner' => $request->input('keterangan_banner'),
        ];
        $insert = Banner::create($data);
        if ($insert) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil insert data',
                'result' => $request->all(),
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal insert data',
            ], 400);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $Banner = Banner::find($id);
        if ($Banner) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $Banner,
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal ambil data',
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'judul_banner' => 'required',
            'gambar_banner' => 'image|max:2048',
        ], [
            'required' => ':attribute wajib diisi',
            'image' => ':attribute harus berupa gambar',
            'max' => ':attribute tidak boleh lebih dari :max',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'invalid form validation',
                'result' => $validator->errors()
            ], 400);
        }

        $file = $request->file('gambar_banner');
        $gambar_banner = $this->uploadFile($file, $id);

        $data = [
            'judul_banner' => $request->input('judul_banner'),
            'gambar_banner' => $gambar_banner,
            'keterangan_banner' => $request->input('keterangan_banner'),
        ];
        $insert = Banner::find($id)->update($data);
        if ($insert) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil insert data',
                'result' => $request->all(),
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal insert data',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->deleteFile($id);
        $delete = Banner::destroy($id);
        if ($delete) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil delete data',
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal delete data',
            ], 400);
        }
    }

    private function uploadFile($file, $id = null)
    {
        if ($file != null) {
            // delete file
            $this->deleteFile($id);
            // nama file
            $fileExp =  explode('.', $file->getClientOriginalName());
            $name = $fileExp[0];
            $ext = $fileExp[1];
            $name = time() . '-' . str_replace(' ', '-', $name) . '.' . $ext;

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload =  public_path() . '/upload/banner/';

            // upload file
            $file->move($tujuan_upload, $name);
        } else {
            if ($id == null) {
                $name = 'default.png';
            } else {
                $banner = Banner::where('id', $id)->first();
                $name = $banner->gambar_banner;
            }
        }

        return $name;
    }

    private function deleteFile($id = null)
    {
        if ($id != null) {
            $banner = Banner::where('id', '=', $id)->first();
            $gambar = public_path() . '/upload/banner/' . $banner->gambar_banner;
            if (file_exists($gambar)) {
                if ($banner->gambar_banner != 'default.png') {
                    File::delete($gambar);
                }
            }
        }
    }
}
