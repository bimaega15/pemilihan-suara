<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginController;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            //
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ], [
                'required' => ':attribute wajib diisi',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'invalid form validation',
                    'result' => $validator->errors()
                ], 400);
            }

            $username = $request->input('username');
            $password = $request->input('password');

            $checkUsername = User::where('username', $username)->first();
            if ($checkUsername) {
                if (Hash::check($password, $checkUsername->password)) {
                    $token = $checkUsername->createToken($checkUsername->id)->plainTextToken;
                    $result = [
                        'data' => $checkUsername,
                        'token' => $token
                    ];

                    return response()->json([
                        'status' => 200,
                        'message' => "Berhasil login",
                        "result" => $result
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Password anda salah'
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Username anda salah'
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                "result" => $e->getMessage()
            ], 500);
        }
    }
}
