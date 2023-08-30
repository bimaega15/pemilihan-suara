<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $limit = 6;
            $data = Gallery::paginate($limit);
            return response()->json($data, 200);
        }
    }
}
