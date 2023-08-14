<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        config('fortify.remember_me_lifetime', 120) * 60;

        $username = $request->input('username');
        $password = $request->input('password');
        $remember = $request->input('remember');


        $getUsers = User::where('username', $username)->first();
        $checkUsername = User::where('username', $username)->get()->count();
        if ($checkUsername > 0) {
            if (Hash::check($password, $getUsers->password)) {
                if ($getUsers->is_aktif == 1) {
                    $setRemember = false;
                    if ($remember != null) {
                        $setRemember = true;
                    }

                    if (Auth::attempt($request->only('username', 'password'), $setRemember)) {
                        return redirect()->intended('/admin/home');
                    }
                } else {
                    session()->flash('error', 'Account anda belum diverifikasi oleh admin, silahkan check secara berkala dihalaman check status pendaftaran');
                    return redirect()->intended('/login');
                }
            } else {
                session()->flash('error', 'Password anda salah');
                return redirect()->intended('/login');
            }
        } else {
            session()->flash('error', 'Username anda salah');
            return redirect()->intended('/login');
        }

        // if (Auth::attempt($request->only('email', 'password'))) {
        //     // Jika otentikasi berhasil
        //     return redirect()->intended('/'); // Ganti '/` dengan URL tujuan setelah login berhasil
        // }

        // // Jika otentikasi gagal, kembali ke halaman login dengan pesan error
        // return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }
}
