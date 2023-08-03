<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Profile;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Tps;
use App\Models\TpsDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use Illuminate\Support\Facades\Hash;

class TpsDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $getCurrentUrl = '/admin/tps';
        if (!isset(Check::getMenu($getCurrentUrl)[0])) {
            abort(403, 'Cannot access page');
        }
        $getMenu = Check::getMenu($getCurrentUrl)[0];

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);

        //
        if ($request->ajax()) {
            $tps_id = $request->input('tps_id');
            $userAcess = session()->get('userAcess');

            $data = TpsDetail::with('tps', 'users', 'users.profile')->where('tps_id', $tps_id)->get();
            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonUpdate = '';
                if ($userAcess['is_update'] == '1') {
                    $buttonUpdate = '
                    <a href="' . route('admin.tpsDetail.edit', $v_data->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                }
                $buttonDelete = '';
                if ($userAcess['is_delete'] == '1') {
                    $buttonDelete = '
                    <form action=' . route('admin.tpsDetail.destroy', $v_data->id) . ' class="d-inline">
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

                $url_gambar_profile = asset('upload/profile/' . $v_data->users->profile->gambar_profile);
                $gambar_profile = '<a class="photoviewer" href="' . $url_gambar_profile . '" data-gallery="photoviewer" data-title="' . $v_data->users->profile->gambar_profile . '">
                    <img src="' . $url_gambar_profile . '" width="100%;"></img>
                </a>';

                $gambarCoblos = $v_data->bukticoblos_detail;
                if ($gambarCoblos == null) {
                    $gambarCoblos = 'default.png';
                }
                $url_bukticoblos_detail = asset('upload/tps/' . $gambarCoblos);
                $bukticoblos_detail = '<a class="photoviewer" href="' . $url_bukticoblos_detail . '" data-gallery="photoviewer" data-title="' . $gambarCoblos . '">
                    <img src="' . $url_bukticoblos_detail . '" width="100%;"></img>
                </a>';

                $result['data'][] = [
                    $no++,
                    $v_data->users->profile->nama_profile,
                    $v_data->users->profile->email_profile,
                    $v_data->users->profile->nohp_profile,
                    $gambar_profile,
                    $bukticoblos_detail,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
        $tps_id = $request->input('tps_id');

        return view('admin.tpsDetail.index', [
            'tps_id' => $tps_id,
            'tps' => Tps::with('provinces', 'regencies', 'districts', 'villages')->find($tps_id)
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
            'nama_profile' => 'required',
            'email_profile' => ['required', 'email', function ($attribute, $value, $fail) {
                $email_profile = $_POST['email_profile'];
                $checkEmailProfile = Profile::where('email_profile', $email_profile)->count();
                if ($checkEmailProfile > 0) {
                    $fail('Email sudah digunakan');
                }
            }],
            'nohp_profile' => 'required|numeric',
            'jenis_kelamin_profile' => 'required',
            'nik_profile' => 'required',
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

        // tpsDetail
        $dataUsers = [
            'username' => $request->input('email_profile'),
            'password' => Hash::make('123456'),
        ];
        $user_id = User::create($dataUsers);

        // roles
        $getRoles = Role::where('nama_roles', 'like', '%Relawan%')->first();
        $dataRoles = [
            'role_id' => $getRoles->id,
            'user_id' => $user_id->id,
        ];
        $roleUser = RoleUser::create($dataRoles);

        $getJabatan = Jabatan::where('nama_jabatan', 'like', '%Relawan%')->first();
        // biodata
        $file = $request->file('gambar_profile');
        $gambar_profile = $this->uploadFile($file);
        $dataBiodata = [
            'nik_profile' => $request->input('nik_profile'),
            'jabatan_id' => $getJabatan->id,
            'nama_profile' => $request->input('nama_profile'),
            'email_profile' => $request->input('email_profile'),
            'alamat_profile' => $request->input('alamat_profile'),
            'nohp_profile' => $request->input('nohp_profile'),
            'jenis_kelamin_profile' => $request->input('jenis_kelamin_profile'),
            'gambar_profile' => $gambar_profile,
            'users_id' => $user_id->id
        ];
        $profile = Profile::create($dataBiodata);

        // tps
        $data = [
            'users_id' => $user_id->id,
            'tps_id' => $request->input('tps_id')
        ];
        $tps = TpsDetail::create($data);

        $tps_id = $request->input('tps_id');
        $this->updateCountTps($tps_id);
        if ($user_id || $roleUser || $profile || $tps) {
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
        $tpsDetail =  TpsDetail::with('users', 'users.profile', 'users.roles')->find($id);
        if ($tpsDetail) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $tpsDetail,
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
            'nama_profile' => 'required',
            'email_profile' => ['required', 'email', function ($attribute, $value, $fail) use ($id) {
                $tpsDetail = TpsDetail::find($id);
                $email_profile = $_POST['email_profile'];
                $checkEmailProfile = Profile::where('email_profile', $email_profile)
                    ->where('users_id', '<>', $tpsDetail->users_id)
                    ->count();
                if ($checkEmailProfile > 0) {
                    $fail('Email sudah digunakan');
                }
            }],
            'nohp_profile' => 'required|numeric',
            'jenis_kelamin_profile' => 'required',
            'nik_profile' => 'required',
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

        $getJabatan = Jabatan::where('nama_jabatan', 'like', '%Relawan%')->first();

        // biodata
        $tpsDetail = TpsDetail::find($id);
        $users_id = $tpsDetail->users_id;
        $file = $request->file('gambar_profile');
        $gambar_profile = $this->uploadFile($file, $users_id);
        $dataBiodata = [
            'nik_profile' => $request->input('nik_profile'),
            'jabatan_id' => $getJabatan->id,
            'nama_profile' => $request->input('nama_profile'),
            'email_profile' => $request->input('email_profile'),
            'alamat_profile' => $request->input('alamat_profile'),
            'nohp_profile' => $request->input('nohp_profile'),
            'jenis_kelamin_profile' => $request->input('jenis_kelamin_profile'),
            'gambar_profile' => $gambar_profile,
            'users_id' => $users_id,
        ];
        $profile = Profile::where('users_id', $users_id)->update($dataBiodata);

        $tps_id = $tpsDetail->tps_id;
        $this->updateCountTps($tps_id);

        if ($profile) {
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
        $tpsDetail = TpsDetail::find($id);
        $tps_id = $tpsDetail->tps_id;

        $users_id = $tpsDetail->users_id;
        $this->deleteFile($users_id);
        $delete = TpsDetail::destroy($id);
        User::destroy($users_id);
        if ($delete) {
            $this->updateCountTps($tps_id);
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

    private function updateCountTps($tps_id)
    {
        $totalLK = [];
        $totalPR = [];
        $getTpsDetail = TpsDetail::with('users', 'users.profile')->where('tps_id', $tps_id)->get();
        foreach ($getTpsDetail as $key => $value) {
            if ($value->users->profile->jenis_kelamin_profile == 'L') {
                $totalLK[$value->users->profile->jenis_kelamin_profile][] = $value->users->profile->jenis_kelamin_profile;
            }
            if ($value->users->profile->jenis_kelamin_profile == 'P') {
                $totalPR[$value->users->profile->jenis_kelamin_profile][] = $value->users->profile->jenis_kelamin_profile;
            }
        }
        $hitungLK = 0;
        if (isset($totalLK['L'])) {
            $hitungLK = count($totalLK['L']);
        }

        $hitungPR = 0;
        if (isset($totalPR['P'])) {
            $hitungPR = count($totalPR['P']);
        }
        $totalAll = $hitungLK + $hitungPR;
        $tps_id = $tps_id;
        Tps::find($tps_id)->update([
            'totallk_tps' => $hitungLK,
            'totalpr_tps' => $hitungPR,
            'totalsemua_tps' => $totalAll
        ]);
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
