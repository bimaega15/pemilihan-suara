<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Tps;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    public function index()
    {
        $about = About::where('about_aktif', 1)->first();
        $countTps = Tps::all()->count();
        return view('frontend.about.index', compact('about','countTps'));
    }
}
