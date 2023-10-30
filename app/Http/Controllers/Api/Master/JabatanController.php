<?php

namespace App\Http\Controllers\Api\Master;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Exception;

class JabatanController extends Controller
{
    public $validation = [
        'nama_jabatan' => 'required',
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
            $data = Jabatan::query()->get();
            return response()->json([
                'status' => 200,
                'message' => "Berhasil ambil data",
                'result' => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }
}
