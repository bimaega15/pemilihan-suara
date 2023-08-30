<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\District;
use App\Models\Gallery;
use App\Models\Konfigurasi;
use App\Models\Regencies;
use App\Models\Tps;
use App\Models\Village;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $banner = Banner::all();
        $about = About::where('about_aktif', 1)->first();
        $konfigurasi = Konfigurasi::first();
        $gallery = Gallery::limit(3)->get();
        $galleryPortfolio = Gallery::limit(6)->orderBy('id', 'desc')->get();
        $tps = Tps::all()->count();
        $regencies = Tps::join('regencies', 'regencies.id', '=', 'tps.regencies_id')
            ->groupBy('tps.regencies_id')
            ->get()->count();
        $districts = Tps::join('districts', 'districts.id', '=', 'tps.districts_id')
            ->groupBy('tps.districts_id')
            ->get()->count();
        $villages = Tps::join('villages', 'villages.id', '=', 'tps.villages_id')
            ->groupBy('tps.villages_id')
            ->get()->count();

        return view('frontend.home.index', compact('banner', 'about', 'konfigurasi', 'gallery', 'galleryPortfolio', 'tps', 'regencies', 'districts', 'villages'));
    }
}
