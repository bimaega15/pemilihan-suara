<?php

namespace App\Http\Controllers\Api\Tps;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\PendukungTps;
use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Exception;

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

        try {
            $data = Tps::query()->with('villages')->paginate(10);
            return response()->json([
                'status' => 200,
                'message' => "Berhasil ambil data",
                'result' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
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
        try {
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

                return response()->json([
                    'status' => 201,
                    'message' => 'Berhasil insert data',
                    'result' => $request->all(),
                ], 201);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Gagal insert data',
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
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
        try {
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
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
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
        try {
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
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
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
        try {
            $delete = Tps::destroy($id);
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
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }
}
