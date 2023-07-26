<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use Illuminate\Support\Facades\Hash;

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
            $userAcess = session()->get('userAcess');

            $data = User::all();
            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonUpdate = '';
                if ($userAcess['is_update'] == '1') {
                    $buttonUpdate = '
                    <a href="' . route('admin.users.edit', $v_data->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                }
                $buttonDelete = '';
                if ($userAcess['is_delete'] == '1') {
                    $buttonDelete = '
                    <form action=' . route('admin.users.destroy', $v_data->id) . ' class="d-inline">
                    <button type="submit" class="btn-delete btn btn-outline-danger m-b-xs" style="border-color: #f75d6fd8 !important;">
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

                $url_gambar_profile = asset('upload/profile/' . $v_data->profile->gambar_profile);
                $gambar_profile = '<a class="photoviewer" href="' . $url_gambar_profile . '" data-gallery="photoviewer" data-title="' . $v_data->profile->gambar_profile . '">
                    <img src="' . $url_gambar_profile . '" width="100%;"></img>
                </a>';
                $result['data'][] = [
                    $no++,
                    $v_data->username,
                    $v_data->profile->nama_profile,
                    $v_data->profile->email_profile,
                    $v_data->profile->nohp_profile,
                    $gambar_profile,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
        return view('admin.users.index', [
            'role' => Role::all()
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
            'role_id' => 'required',
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
            'password' => Hash::make($request->input('password')),
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
                'required', function ($attribute, $value, $fail) {
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
            'role_id' => 'required',
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
        $password_db = $request->input('password_old');
        $password = $request->input('password');
        if ($password != null) {
            $password_db = Hash::make($password);
        }
        $dataUsers = [
            'username' => $request->input('username'),
            'password' => $password_db,
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
}
