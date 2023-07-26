<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Hasil;
use App\Models\JawabanKuisioner;
use App\Models\Kuisioner;
use App\Models\PenilaianUser;
use App\Models\RangeBobot;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDiagnosa;
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


        $user = User::all()->count();
        $roles = Role::all()->count();
        $kuisioner = Kuisioner::all()->count();
        $jawabanKuisioner = JawabanKuisioner::all()->count();
        $rangeBobot = RangeBobot::all()->count();
        $userDiagnosa = UserDiagnosa::all()->count();

        return view('admin.home.index', [
            'users' => $user,
            'role' => $roles,
            'kuisioner' => $kuisioner,
            'jawabanKuisioner' => $jawabanKuisioner,
            'rangeBobot' => $rangeBobot,
            'userDiagnosa' => $userDiagnosa,
        ]);
    }
}
