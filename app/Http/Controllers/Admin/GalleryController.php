<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use DataTables;


class GalleryController extends Controller
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

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);


        //
        if ($request->ajax()) {
            $userAcess = session()->get('userAcess');

            $data = Gallery::query();
            return DataTables::eloquent($data)
                ->addColumn('action', function ($row) use ($userAcess) {
                    $buttonUpdate = '';
                    if ($userAcess['is_update'] == '1') {
                        $buttonUpdate = '
                        <a href="' . route('admin.gallery.edit', $row->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                        <i class="fa-solid fa-pencil"></i>
                        </a>
                        ';
                    }
                    $buttonDelete = '';
                    if ($userAcess['is_delete'] == '1') {
                        $buttonDelete = '
                        <form action=' . route('admin.gallery.destroy', $row->id) . ' class="d-inline">
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

                    return $button;
                })
                ->addColumn('gambar_gallery', function ($row) {
                    $url_gambar_gallery = asset('upload/gallery/' . $row->gambar_gallery);
                    $gambar_gallery = '<a class="photoviewer" href="' . $url_gambar_gallery . '" data-gallery="photoviewer" data-title="' . $row->gambar_gallery . '">
                        <img src="' . $url_gambar_gallery . '" width="100%;"></img>
                    </a>';

                    return $gambar_gallery;
                })
                ->addColumn('waktu_gallery', function ($row) {
                    $waktu_gallery = Check::waktuDateTimeView($row->waktu_gallery);
                    return $waktu_gallery;
                })
                ->rawColumns(['action', 'gambar_gallery', 'waktu_gallery'])
                ->toJson();
        }
        return view('admin.gallery.index');
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
            'judul_gallery' => 'required',
            'waktu_gallery' => 'required',
            'gambar_gallery' => 'required|image|max:2048',

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

        $waktuGallery = $request->input('waktu_gallery');
        $waktu_gallery = Check::waktuDateTime($waktuGallery);

        $file = $request->file('gambar_gallery');
        $gambar_gallery = $this->uploadFile($file);


        $data = [
            'judul_gallery' => $request->input('judul_gallery'),
            'keterangan_gallery' => $request->input('keterangan_gallery'),
            'waktu_gallery' => $waktu_gallery,
            'gambar_gallery' => $gambar_gallery,
        ];
        $insert = Gallery::create($data);
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
        $Gallery = Gallery::find($id);
        if ($Gallery) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $Gallery,
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
            'judul_gallery' => 'required',
            'waktu_gallery' => 'required',
            'gambar_gallery' => 'image|max:2048',
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

        $file = $request->file('gambar_gallery');
        $gambar_gallery = $this->uploadFile($file, $id);


        $data = [
            'judul_gallery' => $request->input('judul_gallery'),
            'keterangan_gallery' => $request->input('keterangan_gallery'),
            'waktu_gallery' => $request->input('waktu_gallery'),
            'gambar_gallery' => $gambar_gallery,
        ];
        $insert = Gallery::find($id)->update($data);
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
        $delete = Gallery::destroy($id);
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
            $tujuan_upload =  public_path() . '/upload/gallery/';

            // upload file
            $file->move($tujuan_upload, $name);
        } else {
            if ($id == null) {
                $name = 'default.png';
            } else {
                $gallery = Gallery::where('id', $id)->first();
                $name = $gallery->gambar_gallery;
            }
        }

        return $name;
    }

    private function deleteFile($id = null)
    {
        if ($id != null) {
            $gallery = Gallery::where('id', '=', $id)->first();
            $gambar = public_path() . '/upload/gallery/' . $gallery->gambar_gallery;
            if (file_exists($gambar)) {
                if ($gallery->gambar_gallery != 'default.png') {
                    File::delete($gambar);
                }
            }
        }
    }
}
