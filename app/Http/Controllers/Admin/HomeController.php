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
use Illuminate\Http\Request;


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
}
