<?php

namespace App\Http\Controllers\Admin;

use App\Events\TpsCreated;
use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;


class TpsController extends Controller
{
    public $validation = [
        'provinces_id' => 'required',
        'regencies_id' => 'required',
        'districts_id' => 'required',
        'villages_id' => 'required',
        'nama_tps' => 'required',
        'alamat_tps' => 'required',
        'minimal_tps' => 'required',
        'pendukung_tps' => 'required',
        'kuota_tps' => 'required',
    ];
    public $customValidation = [
        'required' => ':attribute wajib diisi',
    ];
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

            $data = Tps::query()->with('villages');

            return DataTables::eloquent($data)
                ->addColumn('action', function ($row) use ($userAcess) {
                    $buttonUpdate = '';
                    if ($userAcess['is_update'] == '1') {
                        $buttonUpdate = '
                        <a href="' . route('admin.tps.edit', $row->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                        <i class="fa-solid fa-pencil"></i>
                        </a>
                        ';
                    }
                    $buttonDelete = '';
                    if ($userAcess['is_delete'] == '1') {
                        $buttonDelete = '
                        <form action=' . route('admin.tps.destroy', $row->id) . ' class="d-inline">
                            <button type="submit" class="btn-delete btn btn-outline-danger m-b-xs" style="border-color: #f75d6fd8 !important;">
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
                ->addColumn('koordinator', function ($row) use ($userAcess) {
                    $countCo = $row->totalco_tps == null ? 0 : $row->totalco_tps;
                    $buttonCo = '
                    <a href="' . url('admin/koordinator?tps_id=' . $row->id) . '" class="badge bg-success" style="border-color: #5B9A8B !important;">
                        <i class="fas fa-list"></i> ' . $countCo . ' Koordinator
                    </a>';
                    return $buttonCo;
                })
                ->addColumn('pendukung', function ($row) use ($userAcess) {
                    $countPendukung = $row->totalsemua_tps == null ? 0 : $row->totalsemua_tps;
                    $buttonCo = '
                    <a href="' . url('admin/pendukung?tps_id=' . $row->id) . '" class="badge bg-success" style="border-color: #5B9A8B !important;">
                        <i class="fas fa-list"></i> ' . $countPendukung . ' Pendukung
                    </a>';
                    return $buttonCo;
                })
                ->rawColumns(['action', 'koordinator', 'pendukung'])
                ->toJson();
        }
        return view('admin.tps.index');
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
        $validator = Validator::make($request->all(), $this->validation, $this->customValidation);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'invalid form validation',
                'result' => $validator->errors()
            ], 400);
        }

        $data = [
            'provinces_id' => $request->input('provinces_id'),
            'regencies_id' => $request->input('regencies_id'),
            'districts_id' => $request->input('districts_id'),
            'villages_id' => $request->input('villages_id'),
            'nama_tps' => $request->input('nama_tps'),
            'alamat_tps' => $request->input('alamat_tps'),
            'minimal_tps' => $request->input('minimal_tps'),
            'pendukung_tps' => $request->input('pendukung_tps'),
            'kuota_tps' => $request->input('kuota_tps'),
        ];
        $insert = Tps::create($data);
        if ($insert) {
            TpsCreated::dispatch();

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
        $Tps = Tps::with('provinces', 'regencies', 'districts', 'villages')->find($id);
        if ($Tps) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $Tps,
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
        $validator = Validator::make($request->all(), $this->validation, $this->customValidation);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'invalid form validation',
                'result' => $validator->errors()
            ], 400);
        }

        $data = [
            'provinces_id' => $request->input('provinces_id'),
            'regencies_id' => $request->input('regencies_id'),
            'districts_id' => $request->input('districts_id'),
            'villages_id' => $request->input('villages_id'),
            'nama_tps' => $request->input('nama_tps'),
            'alamat_tps' => $request->input('alamat_tps'),
            'minimal_tps' => $request->input('minimal_tps'),
            'pendukung_tps' => $request->input('pendukung_tps'),
            'kuota_tps' => $request->input('kuota_tps'),
        ];
        $insert = Tps::find($id)->update($data);
        if ($insert) {
            TpsCreated::dispatch();

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
        $delete = Tps::destroy($id);
        if ($delete) {
            TpsCreated::dispatch();

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
