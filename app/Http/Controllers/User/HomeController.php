<?php

namespace App\Http\Controllers\User;

use App\Helper\Check;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function index()
    {

        return view('user.home.index');
    }
}
