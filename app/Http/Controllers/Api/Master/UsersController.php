<?php

namespace App\Http\Controllers\Api\Master;

use App\Events\SuaraBroadcast;
use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\KoordinatorTps;
use App\Models\PendukungTps;
use App\Models\Profile;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Tps;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $roles = (request()->input('roles'));
            $getRoles = explode('-', $roles);
            $getRoles = implode(' ', $getRoles);
            $rolesDb = Role::where('nama_roles', 'like', '%' . $getRoles . '%')->first();
            $searchValue =  $request->input('search');

            $data = User::query()
                ->select('users.*', 'roles.nama_roles', 'profile.*')
                ->join('profile', 'profile.users_id', 'users.id')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->where('roles.nama_roles', '=', $rolesDb->nama_roles);


            if ($searchValue != null) {
                $data->where('profile.nama_profile', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('profile.email_profile', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('profile.nohp_profile', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('roles.nama_roles', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('users.username', 'LIKE', '%' . $searchValue . '%');
            }

            $getData = $data->paginate(10);
            return response()->json([
                'status' => 200,
                'message' => "Berhasil ambil data",
                'result' => $getData
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }


    public function tps()
    {
        try {
            $getData = Tps::with('provinces', 'regencies', 'districts', 'villages')->paginate(10);
            return response()->json([
                'status' => 200,
                'message' => "Berhasil ambil data",
                'result' => $getData
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //
            $validator = Validator::make($request->all(), [
                'username' => [
                    function ($attribute, $value, $fail) use ($request) {
                        $role_id = $request->input('role_id');
                        $roles = Role::where('nama_roles', 'like', '%' . $role_id . '%')->first();
                        if ($roles->nama_roles != 'pendukung') {
                            if ($value == '' || $value == null) {
                                $fail('Username wajib diisi');
                            }
                        }
                        $username = $_POST['username'];
                        $checkusername = User::where('username', $username)->count();
                        if ($checkusername > 0) {
                            $fail('Username sudah digunakan');
                        }
                    }
                ],
                'password' => [function ($attribute, $value, $fail) use ($request) {
                    $role_id = $request->input('role_id');
                    $roles = Role::where('nama_roles', 'like', '%' . $role_id . '%')->first();
                    if ($roles->nama_roles != 'pendukung') {
                        if ($value == '' || $value == null) {
                            $fail('Password wajib diisi');
                        }
                    }

                    $password = $_POST['password'];
                    $password_confirm = $_POST['password_confirm'];
                    if ($password_confirm != $password) {
                        $fail('Password tidak sama dengan password confirmation');
                    }
                },],
                'password_confirm' => [function ($attribute, $value, $fail) use ($request) {
                    $role_id = $request->input('role_id');
                    $roles = Role::where('nama_roles', 'like', '%' . $role_id . '%')->first();
                    if ($roles->nama_roles != 'pendukung') {
                        if ($value == '' || $value == null) {
                            $fail('Password Confirm wajib diisi');
                        }
                    }

                    $password = $_POST['password'];
                    $password_confirm = $_POST['password_confirm'];
                    if ($password_confirm != $password) {
                        $fail('Password tidak sama dengan password confirmation');
                    }
                },],
                'nama_profile' => 'required',
                'email_profile' => [function ($attribute, $value, $fail) use ($request) {
                    $role_id = $request->input('role_id');
                    $roles = Role::where('nama_roles', 'like', '%' . $role_id . '%')->first();
                    if ($roles->nama_roles != 'pendukung') {
                        if ($value == '' || $value == null) {
                            $fail('Email wajib diisi');
                        }
                    }

                    $email_profile = $_POST['email_profile'];
                    $checkEmailProfile = Profile::where('email_profile', $email_profile)->count();
                    if ($checkEmailProfile > 0) {
                        $fail('Email sudah digunakan');
                    }
                }],
                'nohp_profile' => 'required|numeric',
                'jenis_kelamin_profile' => 'required',
                'nik_profile' => 'required',
                'jabatan_id' => 'required',
                'gambar_profile' => 'image|max:2048',

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

            $getRoles = Role::where('nama_roles', 'like', '%pendukung%')->first();
            $rolesId =  $request->input('role_id');
            $rolesId = Role::where('nama_roles', 'like', '%' . $rolesId . '%')->first()->id;


            $username = $request->input('username');
            $password = Hash::make($request->input('password'));

            if ($getRoles->id == $rolesId) {
                $username = $request->input('email_profile');
                $password = Hash::make('123456');
            }

            // users
            $isAktif = $request->input('is_aktif') != null ? 1 : 0;
            $isRegisTps = null;
            if (Auth::user()->roles[0]->nama_roles == 'koordinator') {
                $isRegisTps = 1;
            }
            $dataUsers = [
                'username' => $username,
                'password' => $password,
                'is_aktif' => $isAktif,
                'is_registps' => $isRegisTps
            ];
            $user_id = User::create($dataUsers);

            // roles
            $dataRoles = [
                'role_id' => $rolesId,
                'user_id' => $user_id->id,
            ];
            $roleUser = RoleUser::create($dataRoles);

            // biodata
            $file = $request->file('gambar_profile');
            $gambar_profile = $this->uploadFile($file);

            $dataBiodata = [
                'users_id' => $user_id->id,
                'nik_profile' => $request->input('nik_profile'),
                'jabatan_id' => $request->input('jabatan_id'),
                'nama_profile' => $request->input('nama_profile'),
                'email_profile' => $request->input('email_profile'),
                'alamat_profile' => $request->input('alamat_profile'),
                'nohp_profile' => $request->input('nohp_profile'),
                'jenis_kelamin_profile' => $request->input('jenis_kelamin_profile'),
                'gambar_profile' => $gambar_profile,
            ];
            $profile = Profile::create($dataBiodata);

            if (Auth::user()->roles[0]->nama_roles == 'koordinator') {
                PendukungTps::create([
                    'tps_id' => $request->input('tps_id'),
                    'users_id' => $user_id->id,
                    'users_id_koordinator' => Auth::id(),
                ]);
            }

            if ($user_id || $roleUser || $profile) {
                return response()->json([
                    'status' => 201,
                    'message' => 'Berhasil insert data',
                    'result' => $request->all(),
                ], 201);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Gagal insert data',
                ], 400);
            }
        } catch (Exception $e) {
            //throw $th;
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            $users = User::with('profile', 'roles')->find($id);
            if ($users) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil ambil data',
                    'result' => $users,
                ], 200);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Gagal ambil data',
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $_POST['id'] = $id;
            $validator = Validator::make($request->all(), [
                'username' => [
                    function ($attribute, $value, $fail) use ($request, $id) {
                        $role_id = $request->input('role_id');
                        $roles = Role::where('nama_roles', 'like', '%' . $role_id . '%')->first();
                        if ($roles->nama_roles != 'pendukung') {
                            if ($value == '' || $value == null) {
                                $fail('Username wajib diisi');
                            }
                        }

                        $username = $request->input('username');
                        $checkusername = User::where('username', $username)
                            ->where('id', '!=', $id)
                            ->count();
                        if ($checkusername > 0) {
                            $fail('Username sudah digunakan');
                        }
                    }
                ],
                'password' => [function ($attribute, $value, $fail) {
                    $password = $_POST['password'];
                    $password_confirm = $_POST['password_confirm'];
                    if ($password != null && $password_confirm != null) {
                        if ($password_confirm != $password) {
                            $fail('Password tidak sama dengan password confirmation');
                        }
                    }
                },],
                'password_confirm' => [function ($attribute, $value, $fail) {
                    $password = $_POST['password'];
                    $password_confirm = $_POST['password_confirm'];
                    if ($password != null && $password_confirm != null) {
                        if ($password_confirm != $password) {
                            $fail('Password tidak sama dengan password confirmation');
                        }
                    }
                },],
                'nik_profile' => 'required',
                'jabatan_id' => 'required',
                'nama_profile' => 'required',
                'email_profile' => [function ($attribute, $value, $fail) use ($id, $request) {
                    $role_id = $request->input('role_id');
                    $roles = Role::where('nama_roles', 'like', '%' . $role_id . '%')->first();
                    if ($roles->nama_roles != 'pendukung') {
                        if ($value == '' || $value == null) {
                            $fail('Email wajib diisi');
                        }
                    }

                    $email_profile = $request->input('email_profile');
                    $checkEmailProfile = Profile::where('email_profile', $email_profile)
                        ->where('users_id', '<>', $id)
                        ->count();
                    if ($checkEmailProfile > 0) {
                        $fail('Email sudah digunakan');
                    }
                }],
                'nohp_profile' => 'required|numeric',
                'jenis_kelamin_profile' => 'required',
                'gambar_profile' => 'image|max:2048',

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

            $getRoles = Role::where('nama_roles', 'like', '%pendukung%')->first();
            $rolesId =  $request->input('role_id');
            $rolesId = Role::where('nama_roles', 'like', '%' . $rolesId . '%')->first()->id;

            // users
            $password_db = $request->input('password_old');
            $password = $request->input('password');
            if ($password != null) {
                $password_db = Hash::make($password);
            }
            $isAktif = $request->input('is_aktif') != null ? 1 : 0;

            $username = $request->input('username');
            if ($getRoles->id == $rolesId) {
                $username = $request->input('email_profile');
                $password_db = Hash::make('123456');
            }

            $dataUsers = [
                'username' => $username,
                'password' => $password_db,
                'is_aktif' => $isAktif,
            ];
            $user_id = User::find($id)->update($dataUsers);

            // roles
            $dataRoles = [
                'role_id' => $rolesId,
                'user_id' => $id,
            ];
            $roleUser = RoleUser::where('user_id', $id)->update($dataRoles);

            // biodata
            $file = $request->file('gambar_profile');
            $gambar_profile = $this->uploadFile($file, $id);

            $dataBiodata = [
                'users_id' => $id,
                'nik_profile' => $request->input('nik_profile'),
                'jabatan_id' => $request->input('jabatan_id'),
                'nama_profile' => $request->input('nama_profile'),
                'email_profile' => $request->input('email_profile'),
                'alamat_profile' => $request->input('alamat_profile'),
                'nohp_profile' => $request->input('nohp_profile'),
                'jenis_kelamin_profile' => $request->input('jenis_kelamin_profile'),
                'gambar_profile' => $gambar_profile,
            ];
            $profile = Profile::where('users_id', $id)->update($dataBiodata);

            $data = array_merge($dataUsers, $dataRoles, $dataBiodata);
            if ($user_id || $roleUser || $profile) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil update data',
                    'result' => $request->all(),
                ], 200);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Gagal update data',
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //
            $getTpsKoordinator = KoordinatorTps::where('users_id', $id);
            if ($getTpsKoordinator->get()->count() > 0) {
                $getTpsCo = $getTpsKoordinator->first();
                $tps_id = $getTpsCo->tps_id;

                $getTps = Tps::find($tps_id);
                $getTps->totalco_tps = $getTps->totalco_tps - 1;
                $getTps->save();
            }

            $pendukung = PendukungTps::where('users_id', $id);
            if ($pendukung->get()->count() > 0) {
                $pendukung = PendukungTps::where('users_id', $id)->first();

                if ($pendukung->verificationcoblos_tps == 1) {
                    $getUsers = User::with('profile')->find($pendukung->users_id);

                    $getTps = Tps::find($pendukung->tps_id);
                    if ($getUsers->profile->jenis_kelamin_profile == 'L') {
                        $getTps->totallk_tps = $getTps->totallk_tps - 1;
                    } else {
                        $getTps->totalpr_tps = $getTps->totalpr_tps - 1;
                    }

                    $getTps->totalsemua_tps = $getTps->totalsemua_tps - 1;
                    $getTps->save();
                    SuaraBroadcast::dispatch();
                }
            }

            $this->deleteFile($id);
            $delete = User::destroy($id);
            if ($delete) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil delete data',
                ], 200);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Gagal delete data',
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
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
            $tujuan_upload =  public_path() . '/upload/profile/';

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

    public function setAktif()
    {
        try {
            $id = request()->input('id');
            $is_aktif = request()->input('is_aktif');

            User::find($id)->update([
                'is_aktif' => intval($is_aktif)
            ]);

            return response()->json([
                'status' => 200,
                'message' => "Berhasil update aktif users"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }

    public function getRoles()
    {
        $admin = Role::where("nama_roles", 'like', '%admin%')->first();
        $koordinator = Role::where("nama_roles", 'like', '%koordinator%')->first();
        $kepalaKepegawaian = Role::where("nama_roles", 'like', '%caleg%')->first();
        $pendukung = Role::where("nama_roles", 'like', '%pendukung%')->first();

        return response()->json([
            'role' => Role::all(),
            'jabatan' => Jabatan::all(),
            'admin' => $admin->id,
            'koordinator' => $koordinator->id,
            'kepalaKepegawaian' => $kepalaKepegawaian->id,
            'pendukung' => $pendukung->id,
        ], 200);
    }
}
