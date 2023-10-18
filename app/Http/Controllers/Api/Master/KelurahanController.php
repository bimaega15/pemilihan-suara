<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Village;
use Exception;
use Illuminate\Http\Request;


class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
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
