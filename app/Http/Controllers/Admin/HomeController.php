<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Jabatan;
use App\Models\KoordinatorTps;
use App\Models\Tps;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

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
        $tps = Tps::all()->count();
        $dataTps = Tps::all();

        $roles = Auth::user()->roles[0]->nama_roles;
        return view('admin.home.index', [
            'admin' => $admin,
            'koordinator' => $koordinator,
            'kepalaKepegawaian' => $kepalaKepegawaian,
            'relawan' => $relawan,
            'jabatan' => $jabatan,
            'banner' => $banner,
            'gallery' => $gallery,
            'tps' => $tps,
            'dataTps' => $dataTps,
            'nama_roles' => $roles
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

        $totalKoordinator = Tps::select('*')->sum('totalco_tps');

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
            'totalkoordinator' => $totalKoordinator,
            'targetPemenangan' => $targetPemenangan,
            'presentasePemenangan' => $presentaseKemenangan,
            'totalDukunganLk' => $totalDukunganLk,
            'totalDukunganPr' => $totalDukunganPr
        ])->render();
    }

    public function suaraKoordinator()
    {
        $users_id = Auth::id();
        $koordinatorTps = KoordinatorTps::where('users_id', $users_id)
            ->with('tps', 'tps.villages')
            ->first();


        $totalDukungan = $koordinatorTps->tps->totalsemua_tps;
        $totalDukunganLk = $koordinatorTps->tps->totallk_tps;
        $totalDukunganPr = $koordinatorTps->tps->totalpr_tps;
        $totalKoordinator = $koordinatorTps->tps->totalco_tps;

        $volunter = $koordinatorTps->tps->pendukung_tps;
        $koordinator = $koordinatorTps->tps->minimal_tps;
        $totalTps = 1;

        $targetPemenangan = $volunter * $koordinator * $totalTps;

        $presentaseKemenangan = $totalDukungan / $targetPemenangan * 100;
        return view('admin.home.fetchSuaraKoordinator', [
            'koordinatorTps' => $koordinatorTps,
            'totalDukungan' => $totalDukungan,
            'totalkoordinator' => $totalKoordinator,
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

    public function suaraKoordinatorGrafik()
    {
        $users_id = Auth::id();
        $koordinatorTps = KoordinatorTps::where('users_id', $users_id)
            ->with('tps', 'tps.villages')
            ->first();



        $totalDukunganLk = $koordinatorTps->tps->totallk_tps;
        $totalDukunganPr = $koordinatorTps->tps->totalpr_tps;
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
        $data = Tps::query()->select('tps.id', $whereWilayah . '.name as wilayah_name', DB::raw('sum(totalsemua_tps) as total_semua_dukungan'), DB::raw('count(nama_tps) as total_tps'))
            ->join($whereWilayah, $whereWilayah . '.id', '=', 'tps.' . $whereWilayah . '_id')
            ->groupBy($whereWilayah . '_id')
            ->orderBy('id', 'asc');

        return DataTables::eloquent($data)
            ->toJson();
    }
}
