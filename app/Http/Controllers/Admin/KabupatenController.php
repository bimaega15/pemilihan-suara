<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Regencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;


class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $getCurrentUrl = Check::getCurrentUrl();
        // if (!isset(Check::getMenu($getCurrentUrl)[0])) {
        //     abort(403, 'Cannot access page');
        // }
        // $getMenu = Check::getMenu($getCurrentUrl)[0];

        // session()->put('userAcess.is_create', $getMenu->is_create);
        // session()->put('userAcess.is_update', $getMenu->is_update);
        // session()->put('userAcess.is_delete', $getMenu->is_delete);

        //
        if ($request->ajax()) {
            if ($request->input('xhr') == 'getKabupaten') {
                $search = $request->input('search');
                $provinces_id = $request->input('provinces_id');
                $limit = 10;
                $page = $request->input('page');
                $endPage = $page * $limit;
                $firstPage = $endPage - $limit;

                $regencies = Regencies::select('*');
                $countRegencies = Regencies::where('province_id', $provinces_id)->get()->count();
                if ($search != null) {
                    $regencies->where('name', 'like', '%' . $search . '%');
                }
                if ($provinces_id != null) {
                    $regencies->where('province_id', '=',  $provinces_id);
                }
                $regencies = $regencies->offset($firstPage)
                    ->limit($limit)
                    ->get();
                if ($search != null) {
                    $countRegencies = $regencies->count();
                }

                $result = [];
                foreach ($regencies as $key => $v_regencies) {
                    $result['results'][] =
                        [
                            'id' => $v_regencies->id,
                            'text' => $v_regencies->name,
                        ];
                }
                $result['count_filtered'] = $countRegencies;
                return response()->json($result, 200);
            }

            $userAcess = session()->get('userAcess');

            $data = Regencies::query()->select('regencies.*', 'provinces.name as provinces_name')->join('provinces', 'provinces.id', '=', 'regencies.province_id');

            return DataTables::eloquent($data)
                ->addColumn('action', function ($row) use ($userAcess) {
                    $buttonUpdate = '';
                    if ($userAcess['is_update'] == '1') {
                        $buttonUpdate = '
                        <a href="' . route('admin.kabupaten.edit', $row->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                        <i class="fa-solid fa-pencil"></i>
                        </a>
                        ';
                    }
                    $buttonDelete = '';
                    if ($userAcess['is_delete'] == '1') {
                        $buttonDelete = '
                        <form action=' . route('admin.kabupaten.destroy', $row->id) . ' class="d-inline">
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
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.kabupaten.index');
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
            'province_id' => 'required',
            'name' => 'required',
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
            'province_id' => $request->input('province_id'),
            'name' => $request->input('name'),
        ];
        $insert = Regencies::create($data);
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
        $Kabupaten = Regencies::with('provinces')->where('id', $id)->first();
        if ($Kabupaten) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $Kabupaten,
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
            'name' => 'required',
            'province_id' => 'required',
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
            'province_id' => $request->input('province_id'),
            'name' => $request->input('name'),
        ];
        $insert = Regencies::find($id)->update($data);
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
        $delete = Regencies::destroy($id);
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
