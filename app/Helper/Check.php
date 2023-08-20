<?php

namespace App\Helper;

use App\Models\Hasil;
use App\Models\Konfigurasi;
use App\Models\Kuisioner;
use App\Models\ManagementMenu;
use App\Models\Pernyataan;
use App\Models\RangeBobot;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Check
{
    public static function getKonfigurasi()
    {
        $konfigurasi = Konfigurasi::first();
        return $konfigurasi;
    }
    public static function getMenu($currentUrl = null)
    {
        $getUserProfile = Check::getUserProfile();
        $menu = ManagementMenu::leftJoin('management_menu_roles', 'management_menu.id', '=', 'management_menu_roles.management_menu_id')
            ->where('management_menu_roles.roles_id', $getUserProfile->roles[0]->id);
        if ($currentUrl != null) {
            $menu->where('management_menu.link_management_menu', $currentUrl);
        }
        $menu
            ->orderByRaw('management_menu.no_management_menu asc')
            ->select('management_menu.*', 'management_menu_roles.is_create', 'management_menu_roles.is_update', 'management_menu_roles.is_delete');
        $menu = $menu->get();
        return $menu;
    }
    public static function getMenuInId($arr_id = [])
    {
        $menu =  ManagementMenu::whereIn('id', $arr_id)->get();
        return $menu;
    }
    public static function getUserProfile($users_id = null)
    {
        if ($users_id == null) {
            $users_id = Auth::id();
        }
        $myProfile = User::with('profile', 'roles')->where('users.id', $users_id)->first();
        return $myProfile;
    }

    public static function getRolesUsers()
    {
        $usersLogin = Auth::user()->roles()->get()->toArray();
        return $usersLogin[0];
    }
    public static function getCurrentUrl()
    {
        $urlCurrent = url()->current();
        $explodeCurrent = explode('/', $urlCurrent);
        unset($explodeCurrent[0]);
        unset($explodeCurrent[1]);
        unset($explodeCurrent[2]);
        // unset($explodeCurrent[3]);
        $currentUrl = '/' . implode('/', $explodeCurrent);
        return $currentUrl;
    }

    public static function convertDate($tanggal)
    {
        $explode = explode('-', $tanggal);
        $arr = [];
        $arr[0] = $explode[2];
        $arr[1] = $explode[1];
        $arr[2] = $explode[0];
        $getDate = implode('-', $arr);
        return $getDate;
    }

    public static function waktuDateTime($dateTime)
    {
        $explodeWaktu = explode('/', $dateTime);
        $endExplode = end($explodeWaktu);
        $explodeEnd = explode(' ', $endExplode);
        $firstExplode = $explodeEnd[0];

        $mergeTime[] = $firstExplode;
        $mergeTime[] = $explodeWaktu[1];
        $mergeTime[] = $explodeWaktu[0];

        $implodeTime = implode('-', $mergeTime);

        $timeMerge[] = $implodeTime;
        $timeMerge[] = $explodeEnd[1];
        $implodeTime = implode(' ', $timeMerge);
        return $implodeTime;
    }

    public static function waktuDateTimeView($dateTime)
    {
        $explodeWaktu = explode('-', $dateTime);
        $endExplode = end($explodeWaktu);
        $explodeEnd = explode(' ', $endExplode);
        $firstExplode = $explodeEnd[0];

        $mergeTime[] = $firstExplode;
        $mergeTime[] = $explodeWaktu[1];
        $mergeTime[] = $explodeWaktu[0];

        $implodeTime = implode('/', $mergeTime);

        $timeMerge[] = $implodeTime;
        $timeMerge[] = $explodeEnd[1];
        $implodeTime = implode(' ', $timeMerge);
        return $implodeTime;
    }

    public static function getUsersId($users_id = null)
    {
        $output = '-';
        if ($users_id != null) {
            $dataUsers = '<ul>';
            $explodeUsersId = explode(',', $users_id);
            $joinUsers = User::join('profile', 'users.id', '=', 'profile.users_id')
                ->whereIn('users.id', $explodeUsersId)
                ->get();

            foreach ($joinUsers as $key => $value) {
                $dataUsers .= '<li>' . $value->nama_profile . ' / ' . $value->nik_profile . '</li>';
            }

            $dataUsers .= '</ul>';

            $output = $dataUsers;
        }

        return $output;
    }
    public static function countUsersTps($users_id)
    {
        $data = explode(',', $users_id);
        return count($data);
    }
    public static function targetPemenangan($tps)
    {
        $hitung = $tps->minimal_tps * $tps->pendukung_tps * $tps->totalsemua_tps;
        return $hitung;
    }
    public static function presentasePemenangan($tps)
    {
        $targetPemenangan = Check::targetPemenangan($tps);
        $totalSuara = $tps->totalsemua_tps;
        if ($targetPemenangan == 0) {
            $presentase = 0;
        } else {
            $presentase = ($totalSuara / $targetPemenangan) * 100;
        }
        return $presentase;
    }
}
