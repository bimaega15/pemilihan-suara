<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tps;
use App\Models\TpsDetail;

class MonitoringController extends Controller
{
    //
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

            $data = Tps::all();
            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {

                $buttonDetail = '
                <a href="' . route('admin.monitoring.detail', $v_data->id) . '" class="btn btn-outline-info m-b-xs" style="border-color: #91C8E4 !important;">
                    <i class="fas fa-eye"></i>
                </a>
                ';
                $button = '
                <div class="text-center">
                    ' . $buttonDetail . '
                </div>
                ';

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
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
        return view('admin.monitoring.index');
    }

    public function detail(Request $request, $id)
    {

        $getCurrentUrl = '/admin/monitoring';
        if (!isset(Check::getMenu($getCurrentUrl)[0])) {
            abort(403, 'Cannot access page');
        }
        $getMenu = Check::getMenu($getCurrentUrl)[0];

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);

        if ($request->ajax()) {
            $tps_id = $request->input('tps_id');
            $userAcess = session()->get('userAcess');

            $data = TpsDetail::select('tps_detail.*', 'users.username', 'users.is_aktif', 'profile.nama_profile', 'profile.email_profile', 'profile.nohp_profile', 'profile.gambar_profile')
                ->with('tps')
                ->join('users', 'tps_detail.users_id', '=', 'users.id')
                ->join('profile', 'profile.users_id', '=', 'users.id')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->where('roles.nama_roles', '=', 'relawan')
                ->where('tps_detail.tps_id', $tps_id)
                ->get();

            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {

                $button = '';

                $url_gambar_profile = asset('upload/profile/' . $v_data->gambar_profile);
                $gambar_profile = '<a class="photoviewer" href="' . $url_gambar_profile . '" data-gallery="photoviewer" data-title="' . $v_data->gambar_profile . '">
                    <img src="' . $url_gambar_profile . '" width="100%;"></img>
                </a>';

                $gambarCoblos = $v_data->bukticoblos_detail;
                if ($gambarCoblos == null) {
                    $gambarCoblos = 'default.png';
                }

                $url_bukticoblos_detail = asset('upload/tps/' . $gambarCoblos);
                $bukticoblos_detail = '
                <div style="width: 100%">
                    <a class="photoviewer" href="' . $url_bukticoblos_detail . '" data-gallery="photoviewer" data-title="' . $gambarCoblos . '" class="d-block">
                        <img src="' . $url_bukticoblos_detail . '" width="100%;"></img>
                    </a>
                </div>
                ';

                $detailVerification = $v_data->detail_verification;
                $buttonVerification = null;
                $outputVerification = null;
                if($detailVerification == 0){
                    $outputVerification = '
                    <span class="badge badge-danger" title="Belum">
                        <i class="fas fa-times"></i>
                    </span>
                    ';
                }


                $result['data'][] = [
                    $no++,
                    $v_data->nama_profile,
                    $v_data->email_profile,
                    $v_data->nohp_profile,
                    $gambar_profile,
                    $bukticoblos_detail,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
        $tps_id = $id;

        return view('admin.monitoring.detail', [
            'tps_id' => $tps_id,
            'tps' => Tps::with('provinces', 'regencies', 'districts', 'villages')->find($tps_id)
        ]);
    }
}
