<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\District;
use Exception;
use Illuminate\Http\Request;



class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            //
            $search = $request->input('search');
            $regency_id = $request->input('regency_id');

            $limit = 10;
            $page = $request->input('page');
            $endPage = $page * $limit;
            $firstPage = $endPage - $limit;

            $kecamatan = District::select('*');
            $countDistricts = District::where('regency_id', $regency_id)->get()->count();
            if ($search != null) {
                $kecamatan->where('name', 'like', '%' . $search . '%');
            }
            if ($regency_id != null) {
                $kecamatan->where('regency_id', '=', $regency_id);
            }
            $kecamatan = $kecamatan->offset($firstPage)
                ->limit($limit)
                ->get();

            if ($search != null) {
                $countDistricts = $kecamatan->count();
            }


            $result = [];
            foreach ($kecamatan as $key => $v_kecamatan) {
                $result['results'][] =
                    [
                        'id' => $v_kecamatan->id,
                        'text' => $v_kecamatan->name,
                    ];
            }
            $result['count_filtered'] = $countDistricts;

            return response()->json([
                'status' => 200,
                'message' => "Berhasil ambil data",
                'result' => $result
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }
}
