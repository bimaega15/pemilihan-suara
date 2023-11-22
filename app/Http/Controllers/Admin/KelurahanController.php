<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;


class KelurahanController extends Controller
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
            if ($request->input('xhr') == 'getKelurahan') {
                $district_id = $request->input('district_id');
                $search = $request->input('search');

                $limit = 10;
                $page = $request->input('page');
                $endPage = $page * $limit;
                $firstPage = $endPage - $limit;

                $village = Village::select('*');
                $countVillages = Village::where('district_id', $district_id)->get()->count();
                if ($search != null) {
                    $village->where('name', 'like', '%' . $search . '%');
                }
                if ($district_id != null) {
                    $village->where('district_id', '=', $district_id);
                }
                $village = $village->offset($firstPage)
                    ->limit($limit)
                    ->get();

                if ($search != null) {
                    $countVillages = $village->count();
                }

                $result = [];
                foreach ($village as $key => $v_village) {
                    $result['results'][] =
                        [
                            'id' => $v_village->id,
                            'text' => $v_village->name,
                        ];
                }
                $result['count_filtered'] = $countVillages;
                return response()->json($result, 200);
            }

            $userAcess = session()->get('userAcess');
            $data = Village::query()->select('villages.*', 'districts.name as districts_name')->join('districts', 'villages.district_id', '=', 'districts.id');

            return DataTables::eloquent($data)
                ->addColumn('action', function ($row) use ($userAcess) {
                    $buttonUpdate = '';
                    if ($userAcess['is_update'] == '1') {
                        $buttonUpdate = '
                        <a href="' . route('admin.kelurahan.edit', $row->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                        <i class="fa-solid fa-pencil"></i>
                        </a>
                        ';
                    }
                    $buttonDelete = '';
                    if ($userAcess['is_delete'] == '1') {
                        $buttonDelete = '
                        <form action=' . route('admin.kelurahan.destroy', $row->id) . ' class="d-inline">
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
        return view('admin.kelurahan.index');
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
            'district_id' => 'required',
            'name' => 'required',

        ], [
            'required' => ':attribute wajib diisi',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'invalid form validation',
                'result' => $validator->errors()
            ], 400);
        }



        $data = [
            'district_id' => $request->input('district_id'),
            'name' => $request->input('name'),
        ];
        $insert = Village::create($data);
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
        $Village = Village::with('district')->where('id', $id)->first();
        if ($Village) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $Village,
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
            'district_id' => 'required',
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
            'district_id' => $request->input('district_id'),
            'name' => $request->input('name'),

        ];
        $insert = Village::find($id)->update($data);
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
        $delete = Village::destroy($id);
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
