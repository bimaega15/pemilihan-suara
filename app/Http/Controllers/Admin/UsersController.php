<?php

namespace App\Http\Controllers\Admin;

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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $getCurrentUrl = Check::getCurrentUrl();
        if (!isset(Check::getMenu($getCurrentUrl)[0])) {
            abort(403, 'Cannot access page');
        }
        $getMenu = Check::getMenu($getCurrentUrl)[0];

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);

        //
        if ($request->ajax()) {
            $roles = request()->input('roles');
            $getRoles = explode('-', $roles);
            $getRoles = implode(' ', $getRoles);
            $rolesDb = Role::where('nama_roles', 'like', '%' . $getRoles . '%')->first();

            $userAcess = session()->get('userAcess');

            $searchValue =  $request->input('search')['value'];

            $data = User::query()
                ->select('users.*', 'roles.nama_roles', 'profile.nama_profile', 'profile.email_profile', 'profile.nohp_profile', 'profile.gambar_profile', 'profile.jenis_kelamin_profile', 'profile.alamat_profile')
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

            return DataTables::eloquent($data)
                ->addColumn('action', function ($row) use ($userAcess, $roles) {
                    $buttonUpdate = '';
                    if ($userAcess['is_update'] == '1') {
                        $buttonUpdate = '
                        <a href="' . route('admin.users.edit', $row->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;" data-roles="' . $roles . '">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        ';
                    }
                    $buttonDelete = '';
                    if ($userAcess['is_delete'] == '1') {
                        $buttonDelete = '
                        <form action=' . route('admin.users.destroy', $row->id) . ' class="d-inline">
                        <button type="submit" class="btn-delete btn btn-outline-danger m-b-xs" style="border-color: #f75d6fd8 !important;" data-roles="' . $roles . '">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                        ';
                    }
                    $button = '
                <div class="text-center">
                ' . $buttonUpdate . '               
                ' . $buttonDelete . '               
                </div>
                ';
                    return $button;
                })
                ->addColumn('is_aktif', function ($row) use ($userAcess, $roles) {
                    $outputAktif = '';
                    $span = '';
                    if ((string) $row->is_aktif == '0') {
                        $outputAktif = '
                        <button type="button" data-roles="' . $roles . '" class="btn btn-success btn-sm check-input" data-is_aktif="1" data-id="' . $row->id . '" data-title="Verifikasi">
                            <i class="fas fa-check"></i>
                        </button>
                        ';
                        $span = '<span class="badge bg-danger">Ditolak</span>';
                    }
                    if ((string) $row->is_aktif == '1') {
                        $outputAktif = '
                        <button type="button" data-roles="' . $roles . '" class="btn btn-danger btn-sm check-input" data-is_aktif="0" data-id="' . $row->id . '" data-title="Tolak">
                            <i class="fas fa-times"></i>
                        </button>
                        ';
                        $span = '<span class="badge bg-success">Diverifikasi</span>';
                    }
                    if ((string) $row->is_aktif == null) {
                        $outputAktif = '
                        <button type="button" data-roles="' . $roles . '" class="btn btn-danger btn-sm check-input" data-is_aktif="0" data-id="' . $row->id . '" data-title="Tolak">
                            <i class="fas fa-times"></i>
                        </button>
                        <button type="button" data-roles="' . $roles . '" class="btn btn-success btn-sm check-input" data-is_aktif="1" data-id="' . $row->id . '" data-title="Verifikasi">
                            <i class="fas fa-check"></i>
                        </button>
                        ';
                        $span = '<span class="badge bg-info">Menunggu Verifikasi</span>';
                    }

                    $outputAktifSet = '
                    <div class="text-center">
                        ' . $outputAktif . ' <br>
                        ' . $span . '
                    </div>
                    ';
                    return $outputAktifSet;
                })
                ->addColumn('jenis_kelamin_profile', function ($row) use ($userAcess, $roles) {
                    $outputAktif = '';
                    if ($row->jenis_kelamin_profile == 'L') {
                        $outputAktif = 'Laki-laki';
                    }

                    if ($row->jenis_kelamin_profile == 'P') {
                        $outputAktif = 'Perempuan';
                    }

                    return $outputAktif;
                })
                ->addColumn('gambar_profile', function ($row) use ($userAcess, $roles) {
                    $url_gambar_profile = asset('upload/profile/' . $row->profile->gambar_profile);
                    $gambar_profile = '<a class="photoviewer" href="' . $url_gambar_profile . '" data-gallery="photoviewer" data-title="' . $row->profile->gambar_profile . '">
                        <img src="' . $url_gambar_profile . '" width="100%;"></img>
                    </a>';

                    return $gambar_profile;
                })

                ->rawColumns(['action', 'is_aktif', 'gambar_profile'])
                ->toJson();
        }
        $admin = Role::where("nama_roles", 'like', '%admin%')->first();
        $koordinator = Role::where("nama_roles", 'like', '%koordinator%')->first();
        $kepalaKepegawaian = Role::where("nama_roles", 'like', '%caleg%')->first();
        $pendukung = Role::where("nama_roles", 'like', '%pendukung%')->first();



        return view('admin.users.index', [
            'role' => Role::all(),
            'jabatan' => Jabatan::all(),
            'admin' => $admin->id,
            'koordinator' => $koordinator->id,
            'kepalaKepegawaian' => $kepalaKepegawaian->id,
            'pendukung' => $pendukung->id,
        ]);
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
        //
        $validator = Validator::make($request->all(), [
            'username' => [
                function ($attribute, $value, $fail) use ($request) {
                    $roles = Role::find($request->input('role_id'));
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
                $roles = Role::find($request->input('role_id'));
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
                $roles = Role::find($request->input('role_id'));
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
                $roles = Role::find($request->input('role_id'));
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

        $username = $request->input('username');
        $password = Hash::make($request->input('password'));

        if ($getRoles->id == $rolesId) {
            $username = $request->input('email_profile');
            $password = Hash::make('123456');
        }

        // users
        $isAktif = $request->input('is_aktif') != null ? 1 : 0;
        if (Auth::user()->roles[0]->nama_roles == 'koordinator') {
            $isAktif = 0;
        }
        $dataUsers = [
            'username' => $username,
            'password' => $password,
            'is_aktif' => $isAktif,
        ];
        $user_id = User::create($dataUsers);

        // roles
        $dataRoles = [
            'role_id' => $request->input('role_id'),
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

        $data = array_merge($dataUsers, $dataRoles, $dataBiodata);
        if ($user_id || $roleUser || $profile) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil insert data',
                'result' => $request->all(),
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal insert data',
            ], 400);
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
        $validator = Validator::make($request->all(), [
            'username' => [
                function ($attribute, $value, $fail) use ($request) {
                    $roles = Role::find($request->input('role_id'));
                    if ($roles->nama_roles != 'pendukung') {
                        if ($value == '' || $value == null) {
                            $fail('Username wajib diisi');
                        }
                    }

                    $username = $_POST['username'];
                    $id = $_POST['id'];
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
                $roles = Role::find($request->input('role_id'));
                if ($roles->nama_roles != 'pendukung') {
                    if ($value == '' || $value == null) {
                        $fail('Email wajib diisi');
                    }
                }

                $email_profile = $_POST['email_profile'];
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
            'role_id' => $request->input('role_id'),
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
                'message' => 'Berhasil insert data',
                'result' => $request->all(),
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal insert data',
            ], 400);
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
        $id = request()->input('id');
        $is_aktif = request()->input('is_aktif');


        User::find($id)->update([
            'is_aktif' => intval($is_aktif)
        ]);

        return response()->json('Berhasil update is aktif');
    }

    public function import(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'file_import' => ['required', function ($attribute, $value, $fail) {
                // size
                $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

                if (!in_array($_FILES['file_import']['type'], $file_mimes)) {
                    $fail('Pastikan file yang anda import adalah excel');
                }
            },],
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

        $arr_file = explode('.', $_FILES['file_import']['name']);
        $extension = end($arr_file);

        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['file_import']['tmp_name']);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        $getJabatan = Jabatan::where('nama_jabatan', 'like', '%pendukung%')->first();
        $getRoles = Role::where('nama_roles', 'like', '%pendukung%')->first();

        $countUsers = [];
        for ($i = 1; $i < count($sheetData); $i++) {
            $no = $sheetData[$i][0];
            if ($no != null) {
                $countUsers[] = $i;
                // users
                $data = [
                    'username' => $sheetData[$i][3],
                    'password' => Hash::make('123456'),
                    'is_aktif' => 1,
                ];
                $insertUsers = User::create($data);
                $users_id = $insertUsers->id;

                // role user
                $dataRoles = [
                    'role_id' => $getRoles->id,
                    'user_id' => $users_id,
                ];
                RoleUser::create($dataRoles);

                // profile
                $dataProfile = [
                    'nik_profile' => $sheetData[$i][1],
                    'nama_profile' => $sheetData[$i][2],
                    'alamat_profile' => $sheetData[$i][3],
                    'nohp_profile' => $sheetData[$i][4],
                    'jenis_kelamin_profile' => $sheetData[$i][5],
                    'gambar_profile' => 'default.png',
                    'users_id' => $users_id,
                    'jabatan_id' => $getJabatan->id,
                ];
                $insertProfile = Profile::create($dataProfile);
            }
        }

        $countUsers = count($countUsers);
        if ($countUsers) {
            return response()->json([
                'status' => 200,
                'message' => "Berhasil import data sebanyak " . $countUsers,
                'result' => $request->all()
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => "Gagal import data"
            ], 400);
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
