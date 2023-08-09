<?php

namespace App\Http\Controllers;

use App\Helper\Check;
use App\Models\About;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $getData = Check::getKonfigurasi();
            return response()->json($getData, 200);
        }
        $konfigurasi = Check::getKonfigurasi();
        $about = About::where('about_aktif', 1)->first();
        return view('frontend.contact.index', compact('konfigurasi', 'about'));
    }
}
