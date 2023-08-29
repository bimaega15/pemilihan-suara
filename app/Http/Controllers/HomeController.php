<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Konfigurasi;
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
        return view('frontend.home.index', compact('banner', 'about', 'konfigurasi', 'gallery', 'galleryPortfolio'));
    }
}
