<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use App\Models\User;
use Illuminate\Http\Request;

class StatusRegisController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('frontend.statusRegis.index');
    }
}
