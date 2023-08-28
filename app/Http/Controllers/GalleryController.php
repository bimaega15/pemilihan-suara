<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    //
    public function index(Request $request)
    {
        $limit = 6;
        $data = Gallery::paginate($limit);


        return view('frontend.gallery.index', [
            'gallery' => $data
        ])->render();
    }
}
