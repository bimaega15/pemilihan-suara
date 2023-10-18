<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Exception;
use Illuminate\Http\Request;



class ProvinsiController extends Controller
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
            $limit = 10;
            $page = $request->input('page');
            $endPage = $page * $limit;
            $firstPage = $endPage - $limit;

            $province = Province::select('*');
            $countProvince = Province::all()->count();
            if ($search != null) {
                $province->where('name', 'like', '%' . $search . '%');
            }
            $province = $province->offset($firstPage)
                ->limit($limit)
                ->get();

            if ($search != null && $search != '') {
                $countProvince = $province->count();
            }

            $result = [];
            foreach ($province as $key => $v_province) {
                $result['results'][] =
                    [
                        'id' => $v_province->id,
                        'text' => $v_province->name,
                    ];
            }
            $result['count_filtered'] = $countProvince;
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
