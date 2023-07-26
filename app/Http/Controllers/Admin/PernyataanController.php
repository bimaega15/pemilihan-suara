<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Pernyataan;
use App\Models\RangeBobot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;


class PernyataanController extends Controller
{
    public $validation = [
        'kode_pernyataan' => 'required',
        'nama_pernyataan' => 'required',
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
            $data = Pernyataan::all();

            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonUpdate = '';
                if ($userAcess['is_update'] == '1') {
                    $buttonUpdate = '
                    <a href="' . route('admin.pernyataan.edit', $v_data->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                    <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                }
                $buttonDelete = '';
                if ($userAcess['is_delete'] == '1') {
                    $buttonDelete = '
                    <form action=' . route('admin.pernyataan.destroy', $v_data->id) . ' class="d-inline">
                        <button type="submit" class="btn-delete btn btn-outline-danger m-b-xs" style="border-color: #f75d6fd8 !important;">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                    ';
                }
                $buttonDetail = '
                <a href="' . route('admin.pernyataanDetail.index', $v_data->id) . '" class="btn btn-outline-info m-b-xs btn-detail" style="border-color: #5547f5ea !important;">
                <i class="fa-solid fa-eye"></i>
                </a>
                ';
                $button = '
                <div class="text-center">
                    ' . $buttonUpdate . '
                    ' . $buttonDelete . '
                    ' . $buttonDetail . '
                </div>
                ';
                $rangeBobot = $v_data->range_bobot_id;
                $diagnosa = '-';
                if ($rangeBobot != null) {
                    $diagnosa = RangeBobot::find($rangeBobot)->nama_range_bobot;
                }
                $result['data'][] = [
                    $no++,
                    $v_data->kode_pernyataan,
                    $v_data->nama_pernyataan,
                    $diagnosa,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
        return view('admin.pernyataan.index');
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
            'kode_pernyataan' => $request->input('kode_pernyataan'),
            'nama_pernyataan' => $request->input('nama_pernyataan'),
        ];
        $insert = Pernyataan::create($data);
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
        $pernyataan = Pernyataan::find($id);
        if ($pernyataan) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $pernyataan,
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
            'kode_pernyataan' => $request->input('kode_pernyataan'),
            'nama_pernyataan' => $request->input('nama_pernyataan'),
        ];
        $update = Pernyataan::find($id)->update($data);
        if ($update) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil update data',
                'result' => $request->all(),
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal update data',
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
        $delete = Pernyataan::destroy($id);
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

    public function autoNumber()
    {
        try {
            //code...
            $number = Pernyataan::select(DB::raw('max(kode_pernyataan) as kode_pernyataan'))->first();
            if ($number != '' && $number != null) {
                $getKodeKuisioner = ($number->kode_pernyataan);
                $getKodeKuisioner = str_replace('KJ', '', $getKodeKuisioner);
                $getKodeKuisioner = (int)  $getKodeKuisioner;
                $getKodeKuisioner++;
                $getAutoNumber = 'KJ' . sprintf("%03s", $getKodeKuisioner);
            } else {
                $getAutoNumber = 'KJ001';
            }
            if ($number) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil ambil data',
                    'result' => $getAutoNumber
                ], 200);
            } else {
                return response()->json([
                    'status' => 200,
                    'message' => 'Gagal ambil data',
                ], 200);
            }
        } catch (Exception $e) {
            //throw $th;
            return response()->json([
                'status' => 400,
                'message' => 'Terjadi kesalahan data',
                'result' => $e->getMessage()
            ], 400);
        }
    }

    public function detail($id)
    {
        return response()->json($id);
    }
}
