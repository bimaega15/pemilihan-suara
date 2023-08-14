<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tps;
use App\Models\TpsDetail;
use App\Models\User;

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

                $dataUsers = '<ul>';
                $explodeUsersId = explode(',', $v_data->users_id);
                $joinUsers = User::join('profile', 'users.id', '=', 'profile.users_id')
                    ->whereIn('users.id', $explodeUsersId)
                    ->get();

                foreach ($joinUsers as $key => $value) {
                    $dataUsers .= '<li>' . $value->nama_profile . ' / ' . $value->nik_profile . '</li>';
                }

                $dataUsers .= '</ul>';

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
                    <strong class="text-dark">Minimal Pendukung: </strong> <strong>' . $v_data->pendukung_tps . '</strong>
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

            $data = TpsDetail::select('tps_detail.*', 'users.username', 'users.is_aktif', 'profile.nama_profile', 'profile.email_profile', 'profile.nohp_profile', 'profile.gambar_profile', 'profile.nik_profile', 'profile.alamat_profile')
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
                $buttonVerification = '-';
                if ($detailVerification == 0) {
                    $buttonVerification = '
                    <div class="text-center">
                        <span class="badge bg-danger">
                            <i class="fas fa-times"></i>
                        </span>
                    </div>
                    ';
                }


                if ($detailVerification == 1) {
                    $buttonVerification = '
                    <div class="text-center">
                        <span class="badge bg-success">
                            <i class="fas fa-check"></i>
                        </span>
                    </div>
                    ';
                }

                $button = '
                ' . $buttonVerification . '
               ';


                $result['data'][] = [
                    $no++,
                    $v_data->nik_profile,
                    $v_data->nama_profile,
                    $v_data->jenis_kelamin_profile == 'L' ? 'Laki-laki' : 'Perempuan',
                    $v_data->email_profile,
                    $v_data->nohp_profile,
                    $v_data->alamat_profile,
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

    public function fetchDukungan(Request $request)
    {
        $limit = 10;
        $provinces_id = $request->input('provinces_id');
        $regencies_id = $request->input('regencies_id');
        $districts_id = $request->input('districts_id');
        $villages_id = $request->input('villages_id');

        $data = Tps::select('*');
        if ($provinces_id != null) {
            $data->where('provinces_id', $provinces_id);
        }
        if ($regencies_id != null) {
            $data->where('regencies_id', $regencies_id);
        }
        if ($districts_id != null) {
            $data->where('districts_id', $districts_id);
        }
        if ($villages_id != null) {
            $data->where('villages_id', $villages_id);
        }

        $data = $data->paginate($limit);
        return view('admin.monitoring.pagination_data', compact('data'))->render();
    }

    public function fetchProgres(Request $request)
    {
        $limit = 10;
        $provinces_id = $request->input('provinces_id');
        $regencies_id = $request->input('regencies_id');
        $districts_id = $request->input('districts_id');
        $villages_id = $request->input('villages_id');

        $data = Tps::select('*');
        if ($provinces_id != null) {
            $data->where('provinces_id', $provinces_id);
        }
        if ($regencies_id != null) {
            $data->where('regencies_id', $regencies_id);
        }
        if ($districts_id != null) {
            $data->where('districts_id', $districts_id);
        }
        if ($villages_id != null) {
            $data->where('villages_id', $villages_id);
        }

        $data = $data->paginate($limit);
        return view('admin.monitoring.pagination_data_progres', compact('data'))->render();
    }

    public function fetchGrafik(Request $request)
    {
        $limit = 3;
        $provinces_id = $request->input('provinces_id');
        $regencies_id = $request->input('regencies_id');
        $districts_id = $request->input('districts_id');
        $villages_id = $request->input('villages_id');

        $data = Tps::select('*');
        if ($provinces_id != null) {
            $data->where('provinces_id', $provinces_id);
        }
        if ($regencies_id != null) {
            $data->where('regencies_id', $regencies_id);
        }
        if ($districts_id != null) {
            $data->where('districts_id', $districts_id);
        }
        if ($villages_id != null) {
            $data->where('villages_id', $villages_id);
        }

        $data = $data->paginate($limit);
        return view('admin.monitoring.pagination_data_grafik', compact('data'))->render();
    }

    public function fetchDisplayGrafik(Request $request)
    {
        $limit = 10;
        $provinces_id = $request->input('provinces_id');
        $regencies_id = $request->input('regencies_id');
        $districts_id = $request->input('districts_id');
        $villages_id = $request->input('villages_id');

        $data = Tps::select('*');
        if ($provinces_id != null) {
            $data->where('provinces_id', $provinces_id);
        }
        if ($regencies_id != null) {
            $data->where('regencies_id', $regencies_id);
        }
        if ($districts_id != null) {
            $data->where('districts_id', $districts_id);
        }
        if ($villages_id != null) {
            $data->where('villages_id', $villages_id);
        }

        $data = $data->paginate($limit);
        return response()->json($data, 200);
    }
}
