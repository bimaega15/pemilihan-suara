<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\KoordinatorTps;
use App\Models\Profile;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Tps;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use File;

use DataTables;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $getJabatan = Jabatan::where('nama_jabatan', 'like', '%Koordinator%')->first();

        if ($request->ajax()) {
            $userAcess = session()->get('userAcess');
            $data = Tps::query()->with('villages');
            return DataTables::eloquent($data)
                ->addColumn('action', function ($row) use ($userAcess) {
                    $buttonDetail = '
                    <a href="#" class="btn btn-outline-info m-b-xs btn-choose-tps" style="border-color: #91C8E4 !important;" data-id="' . $row->id . '">
                        <i class="fas fa-arrow-right"></i> Pilih TPS
                    </a>
                    ';
                    $button = '
                    <div class="text-center">
                        ' . $buttonDetail . '
                    </div>
                    ';
                    return $button;
                })

                ->rawColumns(['action', 'gambar_profile'])
                ->toJson();
        }

        return view('auth.register', [
            'role' => Role::all(),
            'jabatan' => Jabatan::all(),
            'getJabatan' => $getJabatan
        ]);
    }

    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'tps_id' => 'required',
            'username' => [
                'required', function ($attribute, $value, $fail) {
                    $username = $_POST['username'];
                    $checkusername = User::where('username', $username)->count();
                    if ($checkusername > 0) {
                        $fail('Username sudah digunakan');
                    }
                }
            ],
            'password' => ['required',  function ($attribute, $value, $fail) {
                $password = $_POST['password'];
                $password_confirm = $_POST['password_confirm'];
                if ($password_confirm != $password) {
                    $fail('Password tidak sama dengan password confirmation');
                }
            },],
            'password_confirm' => ['required',  function ($attribute, $value, $fail) {
                $password = $_POST['password'];
                $password_confirm = $_POST['password_confirm'];
                if ($password_confirm != $password) {
                    $fail('Password tidak sama dengan password confirmation');
                }
            },],
            'nama_profile' => 'required',
            'email_profile' => 'required|email',
            'nohp_profile' => 'required|numeric',
            'jenis_kelamin_profile' => 'required',
            'logo_konfigurasi' => 'image|max:2048',

        ], [
            'required' => ':attribute wajib diisi',
            'numeric' => ':attribute harus berupa angka',
            'email' => ':attribute tidak valid',
            'image' => ':attribute harus berupa gambar',
            'max' => ':attribute tidak boleh lebih dari :max',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'invalid form validation',
                'result' => $validator->errors()
            ], 400);
        }

        // users
        $dataUsers = [
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('123456')),
            'is_aktif' => 0,
            'is_registps' => 1,
        ];
        $user_id = User::create($dataUsers);

        // roles
        $getRoles = Role::where('nama_roles', 'like', '%koordinator%')->first();
        $dataRoles = [
            'role_id' => $getRoles->id,
            'user_id' => $user_id->id,
        ];
        $roleUser = RoleUser::create($dataRoles);

        // biodata
        $file = $request->file('gambar_profile');
        $gambar_profile = $this->uploadFile($file);
        $dataBiodata = [
            'jabatan_id' => $request->input('jabatan_id'),
            'nik_profile' => $request->input('nik_profile'),
            'users_id' => $user_id->id,
            'nama_profile' => $request->input('nama_profile'),
            'email_profile' => $request->input('email_profile'),
            'alamat_profile' => $request->input('alamat_profile'),
            'nohp_profile' => $request->input('nohp_profile'),
            'jenis_kelamin_profile' => $request->input('jenis_kelamin_profile'),
            'gambar_profile' => $gambar_profile,
        ];
        $profile = Profile::create($dataBiodata);

        // tps
        $tps_id = $request->input('tps_id');
        KoordinatorTps::create([
            'tps_id' => $tps_id,
            'users_id' => $user_id->id,
        ]);

        $getTps = Tps::find($tps_id);
        $getTps->totalco_tps = $getTps->totalco_tps + 1;
        $getTps->save();

        $data = array_merge($dataUsers, $dataRoles, $dataBiodata);
        if ($user_id || $roleUser || $profile) {
            return response()->json([
                'status' => 200,
                'message' => '
                Berhasil tambah account data <br>
                <strong>Mohon disimpan informasi berikut, 
                untuk keperluan check status pendaftaran koordinator <br>
                </strong>
                <ul>
                    <li>Username: ' . $dataUsers['username'] . '</li>
                    <li>NIK: ' . $dataBiodata['nik_profile'] . '</li>
                    <li>Email: ' . $dataBiodata['email_profile'] . '</li>
                </ul>
                ',
                'result' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal tambah account data',
            ], 400);
        }
    }

    private function uploadFile($file, $users_id = null)
    {
        if ($file != null) {
            // delete file
            $this->deleteFile($users_id);
            // nama file
            $fileExp =  explode('.', $file->getClientOriginalName());
            $name = $fileExp[0];
            $ext = $fileExp[1];
            $name = time() . '-' . str_replace(' ', '-', $name) . '.' . $ext;

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'upload/profile/';

            // upload file
            $file->move($tujuan_upload, $name);
        } else {
            if ($users_id == null) {
                $name = 'default.png';
            } else {
                $user = Profile::where('users_id', $users_id)->first();
                $name = $user->gambar_profile;
            }
        }

        return $name;
    }

    private function deleteFile($users_id = null)
    {
        if ($users_id != null) {
            $profile = Profile::where('users_id', '=', $users_id)->first();
            $gambar = public_path() . '/upload/profile/' . $profile->gambar_profile;
            if (file_exists($gambar)) {
                if ($profile->gambar_profile != 'default.png') {
                    File::delete($gambar);
                }
            }
        }
    }

    public function getTps($tps_id)
    {
        $data = Tps::with('provinces', 'regencies', 'districts', 'villages')->find($tps_id);
        return response()->json($data, 200);
    }

    public function checkStatus()
    {
        return view('auth.checkStatus');
    }

    public function postCheckStatus(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'identitas' => 'required',
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

        $identitas = $request->input('identitas');
        $checkIdentitas = User::join('profile', 'profile.users_id', '=', 'users.id')
            ->where('users.username', $identitas)
            ->orWhere('profile.nik_profile', $identitas)
            ->orWhere('profile.email_profile', $identitas)
            ->first();

        $message = 'Account tidak terdaftar';
        if ($checkIdentitas != null) {
            if ($checkIdentitas->is_aktif == 1) {
                $message = 'Pendaftaran anda telah aktif, dan silahkan login';
            }
            if ($checkIdentitas->is_aktif == 0) {
                $message = 'Pendaftaran anda ditolak';
            }
            if ($checkIdentitas->is_aktif == null) {
                $message = 'Pendaftaran anda belum diverifikasi, silahkan check secara berkala';
            }
        }

        return response()->json([
            'message' => $message,
            'result' => $request->all()
        ]);
    }
}
