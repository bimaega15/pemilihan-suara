<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Jabatan;
use App\Models\Pengumuman;
use App\Models\Role;
use App\Models\Tps;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //
        $getCurrentUrl = Check::getCurrentUrl();
        if (!isset(Check::getMenu($getCurrentUrl)[0])) {
            abort(403, 'Cannot access page');
        }
        $getMenu = Check::getMenu($getCurrentUrl)[0];

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);


        $admin = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.nama_roles', 'like', '%' . 'admin' . '%')
            ->get()->count();
        $koordinator = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.nama_roles', 'like', '%' . 'koordinator' . '%')
            ->get()->count();
        $kepalaKepegawaian = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.nama_roles', 'like', '%' . 'caleg' . '%')
            ->get()->count();
        $relawan = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.nama_roles', 'like', '%' . 'Relawan' . '%')
            ->get()->count();
        $jabatan = Jabatan::all()->count();
        $banner = Banner::all()->count();
        $gallery = Gallery::all()->count();
        $pengumuman = Pengumuman::all()->count();
        $tps = Tps::all()->count();
        $dataTps = Tps::all();

        return view('admin.home.index', [
            'admin' => $admin,
            'koordinator' => $koordinator,
            'kepalaKepegawaian' => $kepalaKepegawaian,
            'relawan' => $relawan,
            'jabatan' => $jabatan,
            'banner' => $banner,
            'gallery' => $gallery,
            'pengumuman' => $pengumuman,
            'tps' => $tps,
            'dataTps' => $dataTps
        ]);
    }

    public function fetchGrafik(Request $request)
    {
        $limit = 6;
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
        return view('admin.home.fetchGrafik', [
            'data' => $data
        ]);
    }

    public function fetchDisplayGrafik(Request $request)
    {
        $limit = 6;
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

    public function semuaSuara()
    {
        $provinsi = Tps::select(DB::raw('count(*) as provinces_all'))
            ->groupBy('provinces_id')
            ->get()
            ->count();
        $kabupaten = Tps::select(DB::raw('count(*) as regencies_all'))
            ->groupBy('regencies_id')
            ->get()
            ->count();
        $kecamatan = Tps::select(DB::raw('count(*) as districts_all'))
            ->groupBy('districts_id')
            ->get()
            ->count();
        $kelurahan = Tps::select(DB::raw('count(*) as villages_all'))
            ->groupBy('villages_id')
            ->get()
            ->count();
        $totalDukungan = Tps::select('*')->sum('totalsemua_tps');
        $totalDukunganLk = Tps::select('*')->sum('totallk_tps');
        $totalDukunganPr = Tps::select('*')->sum('totalpr_tps');

        $totalKoordinator = Tps::all();
        $calcCo = 0;
        foreach ($totalKoordinator as $key => $item) {
            $getUsersId = $item->users_id;
            $explode = explode(',', $getUsersId);
            $countExplode = count($explode);
            $calcCo += $countExplode;
        }

        $getConfig = Check::getKonfigurasi();
        $volunter = $getConfig->volminimal_konfigurasi;
        $koordinator = $getConfig->cominimal_konfigurasi;
        $totalTps = Tps::all()->count();

        $targetPemenangan = $volunter * $koordinator * $totalTps;

        $presentaseKemenangan = $totalDukungan / $targetPemenangan * 100;
        return view('admin.home.fetchSemuaSuara', [
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'totalDukungan' => $totalDukungan,
            'totalkoordinator' => $calcCo,
            'targetPemenangan' => $targetPemenangan,
            'presentasePemenangan' => $presentaseKemenangan,
            'totalDukunganLk' => $totalDukunganLk,
            'totalDukunganPr' => $totalDukunganPr
        ])->render();
    }

    public function semuaSuaraGrafik()
    {

        $totalDukunganLk = Tps::select('*')->sum('totallk_tps');
        $totalDukunganPr = Tps::select('*')->sum('totalpr_tps');
        return response()->json([
            'totalDukunganLk' => $totalDukunganLk,
            'totalDukunganPr' => $totalDukunganPr
        ]);
    }

    public function wilayah(Request $request)
    {
        //
        $wilayah_all = $request->input('wilayah_all');
        $whereWilayah = $wilayah_all;
        if ($wilayah_all == '') {
            $whereWilayah = 'villages';
        }
        $data = Tps::select('tps.id', $whereWilayah . '.name as wilayah_name', DB::raw('sum(totalsemua_tps) as total_semua_dukungan'))
            ->join($whereWilayah, $whereWilayah . '.id', '=', 'tps.' . $whereWilayah . '_id')
            ->groupBy($whereWilayah . '_id')
            ->orderBy('id', 'asc')
            ->get();

        $result = [];
        $no = 1;
        if ($data->count() == 0) {
            $result['data'] = [];
        }
        foreach ($data as $index => $v_data) {

            $result['data'][] = [
                $no++,
                $v_data->wilayah_name,
                $v_data->total_semua_dukungan,
            ];
        }

        return response()->json($result, 200);
    }
}
