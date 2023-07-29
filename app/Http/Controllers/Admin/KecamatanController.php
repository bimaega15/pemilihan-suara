<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class KecamatanController extends Controller
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

            $draw = $request->input('draw');
            $order = $request->input('order');
            $start = $request->input('start');
            $length = $request->input('length');
            $search = $request->input('search')['value'];

            $orderColumn = ["districts.id", "regencies.name", "districts.name", "districts.id"];
            $indexColumn = intval($order[0]['column']);
            $dir = $order[0]['dir'];
            $sortDir = $dir == "asc" ? 'asc' : 'desc';
            $sortColumn = $orderColumn[$indexColumn];

            $data = District::select('districts.*')->join('regencies', 'districts.regency_id', '=', 'regencies.id');
            if ($search != '' && $search != null) {
                $data->where('districts.name', 'like', '%' . $search . '%')
                    ->orWhere('regencies.name', 'like', '%' . $search . '%');
            }

            $data = $data
                ->offset($start)
                ->limit($length)
                ->orderBy($sortColumn, $sortDir)
                ->get();

            $countDocuments = District::join('regencies', 'districts.regency_id', '=', 'regencies.id')->get()->count();
            $countAllData = $countDocuments;

            if ($search != null && $search != '') {
                $countAllData = $data->count();
            }

            $result = [];
            $result['draw'] = $draw;
            $result['recordsTotal'] = $countAllData;
            $result['recordsFiltered'] = $countAllData;

            $no = intval($start) + 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }

            foreach ($data as $index => $v_data) {
                $buttonUpdate = '';
                if ($userAcess['is_update'] == '1') {
                    $buttonUpdate = '
                    <a href="' . route('admin.kecamatan.edit', $v_data->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                    <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                }
                $buttonDelete = '';
                if ($userAcess['is_delete'] == '1') {
                    $buttonDelete = '
                    <form action=' . route('admin.kecamatan.destroy', $v_data->id) . ' class="d-inline">
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

                $result['data'][] = [
                    $no++,
                    $v_data->regencies->name,
                    $v_data->name,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
        return view('admin.kecamatan.index');
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
            'regency_id' => 'required',
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
            'regency_id' => $request->input('regency_id'),
            'name' => $request->input('name'),
        ];
        $insert = District::create($data);
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
        $District = District::with('regencies')->where('id', $id)->first();
        if ($District) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $District,
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
            'regency_id' => 'required',
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
            'regency_id' => $request->input('regency_id'),
            'name' => $request->input('name'),

        ];
        $insert = District::find($id)->update($data);
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
        $delete = District::destroy($id);
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
