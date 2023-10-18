<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Regencies;
use Exception;
use Illuminate\Http\Request;


class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
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
