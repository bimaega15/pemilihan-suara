<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\JawabanKuisioner;
use App\Models\Kuisioner;
use App\Models\PernyataanDetail;

use App\Models\RangeBobot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PernyataanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $getData = PernyataanDetail::with('kuisioner', 'jawabanKuisioner', 'pernyataan')->where('pernyataan_id', $id)->get();

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $getData
            ]);
        }
        return view('admin.pernyataanDetail.index', [
            'id' => $id,
            'kuisioner' => Kuisioner::all(),
            'jawabanKuisioner' => JawabanKuisioner::all(),
            'count_kuisioner' => Kuisioner::all()->count(),
        ]);
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
            'kuisioner_jawaban' => ['required',  function ($attribute, $value, $fail) use ($request) {
                $pernyataan = $request->input('kuisioner_jawaban');
                $countKuisioner = $request->input('count_kuisioner');


                if (intval(count($pernyataan)) != intval($countKuisioner)) {
                    $fail("Jawaban pernyataan harus diisi semua");
                }
            }],
            'pernyataan_id' => 'required'
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

        $pernyataan_id = $request->input('pernyataan_id');
        $getPernyataanDetail = PernyataanDetail::where('pernyataan_id', $pernyataan_id)->count();

        if ($getPernyataanDetail > 0) {
            PernyataanDetail::where('pernyataan_id', $pernyataan_id)->delete();
        }

        $kuisioner_jawaban = $request->input('kuisioner_jawaban');

        $totalBobot = 0;
        foreach ($kuisioner_jawaban as $key => $value) {
            $getBobotJawabanKuisioner = JawabanKuisioner::find($value['jawaban_kuisioner_id'])->bobot_jawaban_kuisioner;

            $totalBobot += $getBobotJawabanKuisioner;

            $data[] = [
                'kuisioner_id' => $value['kuisioner_id'],
                'jawaban_kuisioner_id' => $value['jawaban_kuisioner_id'],
                'pernyataan_id' => $request->input('pernyataan_id'),
            ];
        }

        $rangeBobot = RangeBobot::all();
        $range_bobot_id = null;
        foreach ($rangeBobot as $key => $value) {
            if ($value->dari_range_bobot <= $totalBobot && $totalBobot <= $value->sampai_range_bobot) {
                $range_bobot_id = $value->id;
            }
        }


        PernyataanDetail::find($request->input('pernyataan_id'))->update([
            'range_bobot_id' => $range_bobot_id
        ]);

        $insert = PernyataanDetail::insert($data);
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
}
