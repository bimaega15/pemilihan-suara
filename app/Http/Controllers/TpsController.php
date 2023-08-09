<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use Illuminate\Http\Request;

class TpsController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userAcess = session()->get('userAcess');

            $data = Tps::all();
            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $daerah = '
                <div class="row">
                    <div class="col-lg-6">
                    Provinsi: <br> <strong class="text-success">' . $v_data->provinces->name . ' </strong>
                    </div>
                    <div class="col-lg-6">
                    Kabupaten: <br> <strong class="text-success">' . $v_data->regencies->name . ' </strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                    Kecamatan: <br> <strong class="text-success">' . $v_data->districts->name . ' </strong>
                    </div>
                    <div class="col-lg-6">
                    Kelurahan: <br> <strong class="text-success">' . $v_data->villages->name . ' </strong>
                    </div>
                </div>
                ';

                $dataUsers = '
                <div class="row">
                    <div class="col-12">
                     <span>Nama / No. Induk</span><br>
                     <strong class="text-success">' . $v_data->users->profile->nama_profile . ' / ' . ' ' . $v_data->users->profile->nik_profile . '</strong>
                    </div>
                    <div class="col-12">
                     <span>Jabatan / No. HP</span><br>
                     <strong class="text-success">' . $v_data->users->profile->jabatan->nama_jabatan . ' / ' . ' ' . $v_data->users->profile->nohp_profile . '</strong>
                    </div>
                </div>
                ';

                $totalLKTps =  $v_data->totallk_tps == null ? 0 : $v_data->totallk_tps;
                $totalPrTps =  $v_data->totalpr_tps == null ? 0 : $v_data->totalpr_tps;
                $totalSemua =  $v_data->totalsemua_tps == null ? 0 : $v_data->totalsemua_tps;

                $totalTps = '
                <div>
                    <strong class="text-dark">Total LK: </strong> <strong>' . $totalLKTps . '</strong>
                </div>
                <div>
                    <strong class="text-dark">Total PR: </strong> <strong>' . $totalPrTps . '</strong>
                </div>
                <div>
                    <strong class="text-dark">Total Semua: </strong> <strong>' . $totalSemua . '</strong>
                </div>
                ';


                $capaianTps = '
                <div>
                    <strong class="text-dark">Minimal TPS: </strong> <strong>' . $v_data->minimal_tps . '</strong>
                </div>
                <div>
                    <strong class="text-dark">Target TPS: </strong> <strong>' . $v_data->target_tps . '</strong>
                </div>
                ';

                $result['data'][] = [
                    $no++,
                    $v_data->nama_tps,
                    $v_data->alamat_tps,
                    $capaianTps,
                    $totalTps,
                    $dataUsers,
                    $daerah,
                ];
            }

            return response()->json($result, 200);
        }
        return view('frontend.tps.index');
    }
}
