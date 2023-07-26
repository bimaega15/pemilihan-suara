<?php

namespace App\Http\Controllers\User;

use App\Helper\Check;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    //
    public function index()
    {
        if (request()->ajax()) {
            return response()->json([
                'status' => 200,
                'message' => "Berhasil ambil data",
                'result' => Check::getKonfigurasi(),
            ]);
        }

        return view('user.contacts.index');
    }
}
