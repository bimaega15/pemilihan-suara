<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);


        //
        if ($request->ajax()) {
            $userAcess = session()->get('userAcess');

            $data = Banner::all();
            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonUpdate = '';
                if ($userAcess['is_update'] == '1') {
                    $buttonUpdate = '
                    <a href="' . route('admin.banner.edit', $v_data->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                    <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                }
                $buttonDelete = '';
                if ($userAcess['is_delete'] == '1') {
                    $buttonDelete = '
                    <form action=' . route('admin.banner.destroy', $v_data->id) . ' class="d-inline">
                        <button type="submit" class="btn-delete btn btn-outline-danger m-b-xs" style="border-color: #4682A9 !important;">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                    ';
                }

                $buttonDetail = '
                <a href="' . route('admin.banner.show', $v_data->id) . '" class="btn btn-outline-info m-b-xs btn-show" style="border-color: #f5af47ea !important;">
                <i class="fas fa-eye"></i>
                </a>
                ';

                $button = '
                <div class="text-center">
                    ' . $buttonUpdate . '
                    ' . $buttonDelete . '
                    ' . $buttonDetail . '
                </div>
                ';

                $result['data'][] = [
                    $no++,
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
            'logo_konfigurasi' => 'image|max:2048',

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

        $data = [
            'judul_banner' => $request->input('judul_banner'),
            'gambar_banner' => $request->input('gambar_banner'),
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
            'logo_konfigurasi' => 'image|max:2048',
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

        $data = [
            'judul_banner' => $request->input('judul_banner'),
            'gambar_banner' => $request->input('gambar_banner'),
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
}
