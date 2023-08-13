<?php

namespace App\Http\Controllers\Admin;

use App\Events\TpsDetail as EventsTpsDetail;
use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Profile;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Tps;
use App\Models\TpsDetail;
use App\Models\TpsPendukung;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PendukungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $getCurrentUrl = '/admin/pendukung';
        if (!isset(Check::getMenu($getCurrentUrl)[0])) {
            abort(403, 'Cannot access page');
        }
        $getMenu = Check::getMenu($getCurrentUrl)[0];

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);

        $users_id = Auth::id();
        $tps = Tps::where('users_id', 'like', '%' . strval($users_id) . '%')->first();
        $getJabatan = Jabatan::where('nama_jabatan', 'like', '%Koordinator%')->first();


        if ($request->ajax()) {
            $userAcess = session()->get('userAcess');


            $data = TpsDetail::select('tps_detail.*', 'users.username', 'users.is_aktif', 'profile.nama_profile', 'profile.email_profile', 'profile.nohp_profile', 'profile.gambar_profile', 'tps.provinces_id', 'tps.regencies_id', 'tps.districts_id', 'tps.villages_id')
                ->join('tps', 'tps.id', '=', 'tps_detail.tps_id')
                ->join('users', 'tps_detail.users_id', '=', 'users.id')
                ->join('profile', 'profile.users_id', '=', 'users.id')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->where('roles.nama_roles', '=', 'relawan')
                ->where('tps_detail.tps_id', $tps->id);

            $data = $data->get();

            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonUpdate = '';
                if ($userAcess['is_update'] == '1') {
                    $buttonUpdate = '
                    <a href="' . route('admin.pendukung.edit', $v_data->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                }
                $buttonDelete = '';
                if ($userAcess['is_delete'] == '1') {
                    $buttonDelete = '
                    <form action=' . route('admin.pendukung.destroy', $v_data->id) . ' class="d-inline">
                    <button type="submit" class="btn-delete btn btn-outline-danger m-b-xs" style="border-color: #f75d6fd8 !important;">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
                    ';
                }


                $buttonVerification = '';
                $spanVerification = '';
                if (strval($v_data->detail_verification) == null) {

                    $buttonVerification = '
                    <a href="' . route('admin.pendukung.verificationCoblos', $v_data->id) . '" class="btn btn-outline-danger m-b-xs btn-verification" data-detail_verification="0" style="border-color: #EA1179 !important;" title="Ditolak">
                        <i class="fas fa-times"></i>
                    </a>
                    ';

                    $buttonVerification .= '
                    <a href="' . route('admin.pendukung.verificationCoblos', $v_data->id) . '" class="btn btn-outline-info m-b-xs btn-verification" data-detail_verification="1"  style="border-color: #4477CE !important;" title="Verifikasi">
                        <i class="fas fa-check"></i>
                    </a>
                    ';
                    $span = '<span class="badge bg-info">Menunggu Verifikasi</span>';
                }

                if (strval($v_data->detail_verification) == '1') {

                    $buttonVerification = '
                    <a href="' . route('admin.pendukung.verificationCoblos', $v_data->id) . '" class="btn btn-outline-danger m-b-xs btn-verification" data-detail_verification="0" style="border-color: #EA1179 !important;" title="Ditolak">
                        <i class="fas fa-times"></i>
                    </a>
                    ';

                    $span = '<span class="badge bg-success">Diverifikasi</span>';
                }
                if (strval($v_data->detail_verification) == '0') {
                    $buttonVerification = '
                    <a href="' . route('admin.pendukung.verificationCoblos', $v_data->id) . '" class="btn btn-outline-info m-b-xs btn-verification" data-detail_verification="1"  style="border-color: #4477CE !important;" title="Verifikasi">
                        <i class="fas fa-check"></i>
                    </a>
                    ';

                    $span = '<span class="badge bg-danger">Ditolak</span>';
                }

                $outputVerification = '
                <div class="text-center">
                    ' . $buttonVerification . ' <br>
                    ' . $span . '
                </div>
                ';


                $users_id_koordinator = Auth::id();
                $buttonDetail = '
                <a href="' . route('admin.pendukung.edit', $v_data->id) . '" class="btn btn-outline-info m-b-xs btn-detail" style="border-color: #4477CE !important;" data-id="' . $v_data->id . '" data-tps_detail_id="' . $v_data->id . '" data-users_id="' . $v_data->users_id . '" data-tps_id="' . $v_data->tps_id . '" data-users_id_koordinator="' . $users_id_koordinator . '">
                    <i class="fas fa-eye"></i>
                </a>
                ';


                $button = '
            <div class="text-center">
            ' . $buttonUpdate . '               
            ' . $buttonDelete . '
            ' . $buttonDetail . '
            ' . $outputVerification . '               
            </div>
            ';

                $url_gambar_profile = asset('upload/profile/' . $v_data->gambar_profile);
                $gambar_profile = '<a class="photoviewer" href="' . $url_gambar_profile . '" data-gallery="photoviewer" data-title="' . $v_data->gambar_profile . '">
                    <img src="' . $url_gambar_profile . '" width="100%;"></img>
                </a>';

                $gambarCoblos = $v_data->bukticoblos_detail;
                if ($gambarCoblos == null) {
                    $gambarCoblos = 'default.png';
                }

                $url_bukticoblos_detail = asset('upload/tps/' . $gambarCoblos);
                $bukticoblos_detail = '
                <div style="width: 100%">
                    <a class="photoviewer" href="' . $url_bukticoblos_detail . '" data-gallery="photoviewer" data-title="' . $gambarCoblos . '" class="d-block">
                        <img src="' . $url_bukticoblos_detail . '" width="100%;"></img>
                    </a>
                    <button type="button" class="btn btn-dark text-center text-white w-100 btn-upload-bukti" data-id="' . $v_data->id . '" data-bukticoblos_detail="' . $v_data->bukticoblos_detail . '">
                    <i class="fas fa-upload"></i>
                    </button>
                </div>
                ';


                $result['data'][] = [
                    $no++,
                    $v_data->nama_profile,
                    $v_data->email_profile,
                    $v_data->nohp_profile,
                    $gambar_profile,
                    $bukticoblos_detail,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
        $users_id = Auth::id();
        $tps = Tps::where('users_id', 'like', '%' . strval($users_id) . '%')->first();

        return view('admin.pendukung.index', [
            'tps_id' => $tps->id,
            'tps' => Tps::with('provinces', 'regencies', 'districts', 'villages')->find($tps->id),
            'getJabatan' => $getJabatan
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
        $data = $request->all();
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
            'alamat_profile' => 'required',
            'gambar_profile' => 'image|max:2048',
            'tps_id' => 'required',
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

        // pendukung
        $dataUsers = [
            'username' => $request->input('email_profile'),
            'password' => Hash::make('123456'),
        ];
        $user_id = User::create($dataUsers);

        // roles
        $getRoles = Role::where('nama_roles', 'like', '%relawan%')->first();
        $dataRoles = [
            'role_id' => $getRoles->id,
            'user_id' => $user_id->id,
        ];
        $roleUser = RoleUser::create($dataRoles);

        $getJabatan = Jabatan::where('nama_jabatan', 'like', '%relawan%')->first();
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

        // pendukung
        $data = [
            'users_id' => $user_id->id,
            'tps_id' => $request->input('tps_id')
        ];
        $tpsDetail = TpsDetail::create($data);

        $tps_id = $request->input('tps_id');
        $this->updateCountTps($tps_id);

        // tps pendukung
        $dataTpsPendukung = [
            'tps_detail_id' => $tpsDetail->id,
            'users_id_koordinator' => Auth::id(),
            'users_id_pendukung' => $user_id->id,
            'tps_id' => $tps_id
        ];
        $tpsPendukung = TpsPendukung::create($dataTpsPendukung);

        if ($user_id || $roleUser || $profile || $tpsDetail || $tpsPendukung) {
            EventsTpsDetail::dispatch();
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
        $pendukung =  TpsDetail::with('users', 'users.profile', 'users.roles', 'tps', 'tps.provinces', 'tps.regencies', 'tps.districts', 'tps.villages')->find($id);
        if ($pendukung) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $pendukung,
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
                $pendukung = TpsDetail::find($id);
                $email_profile = $_POST['email_profile'];
                $checkEmailProfile = Profile::where('email_profile', $email_profile)
                    ->where('users_id', '<>', $pendukung->users_id)
                    ->count();
                if ($checkEmailProfile > 0) {
                    $fail('Email sudah digunakan');
                }
            }],
            'nohp_profile' => 'required|numeric',
            'jenis_kelamin_profile' => 'required',
            'nik_profile' => 'required',
            'alamat_profile' => 'required',
            'gambar_profile' => 'image|max:2048',
            'tps_id' => 'required',
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

        $getJabatan = Jabatan::where('nama_jabatan', 'like', '%relawan%')->first();

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

        // tps pendukung 
        $tps_detail_id = $tpsDetail->id;
        $users_id_koordinator = Auth::id();
        $users_id_pendukung = $users_id;
        $tps_id = $tps_id;

        $data = TpsPendukung::where('tps_detail_id', $tps_detail_id)
            ->where('users_id_koordinator', $users_id_koordinator)
            ->where('users_id_pendukung', $users_id_pendukung)
            ->where('tps_id', $tps_id)
            ->with('tpsDetail', 'TpsDetail.tps', 'TpsDetail.tps.provinces', 'TpsDetail.tps.regencies', 'TpsDetail.tps.districts', 'TpsDetail.tps.villages')
            ->first();
        $tps_pendukung_id = $data->id;
        $dataSet = [
            'tps_id' => $request->input('tps_id')
        ];
        TpsPendukung::find($tps_pendukung_id)->update($dataSet);

        if ($profile) {
            EventsTpsDetail::dispatch();

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
        $pendukung = TpsDetail::find($id);
        $tps_id = $pendukung->tps_id;

        $users_id = $pendukung->users_id;
        $this->deleteFile($users_id);
        $this->deleteFileBukti($id);

        $delete = TpsDetail::destroy($id);
        User::destroy($users_id);
        if ($delete) {
            EventsTpsDetail::dispatch();

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
            'totallk_pendukung' => $hitungLK,
            'totalpr_pendukung' => $hitungPR,
            'totalsemua_pendukung' => $totalAll
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

    private function uploadFileBukti($file, $id = null)
    {
        if ($file != null) {
            // delete file
            $this->deleteFileBukti($id);
            // nama file
            $fileExp =  explode('.', $file->getClientOriginalName());
            $name = $fileExp[0];
            $ext = $fileExp[1];
            $name = time() . '-' . str_replace(' ', '-', $name) . '.' . $ext;

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload =  public_path() . '/upload/tps/';

            // upload file
            $file->move($tujuan_upload, $name);
        } else {
            if ($id == null) {
                $name = 'default.png';
            } else {
                $user = TpsDetail::where('id', $id)->first();
                $name = $user->bukticoblos_detail;
            }
        }

        return $name;
    }

    private function deleteFileBukti($id = null)
    {
        if ($id != null) {
            $pendukung = TpsDetail::where('id', '=', $id)->first();
            $gambar = public_path() . '/upload/tps/' . $pendukung->bukticoblos_detail;
            if (file_exists($gambar)) {
                if ($pendukung->bukticoblos_detail != 'default.png') {
                    File::delete($gambar);
                }
            }
        }
    }

    public function uploadBuktiCoblos(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'bukticoblos_detail' => 'required|image|max:3048',
        ], [
            'required' => ':attribute wajib diisi',
            'image' => ':attribute harus berupa gambar',
            'max' => ':attribute tidak boleh lebih dari :max kb',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'invalid form validation',
                'result' => $validator->errors()
            ], 400);
        }

        // biodata
        $file = $request->file('bukticoblos_detail');
        $bukticoblos_detail = $this->uploadFileBukti($file, $id);

        $update =  TpsDetail::find($id)->update([
            'bukticoblos_detail' => $bukticoblos_detail
        ]);
        if ($update) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil upload bukti coblos',
                'result' => $request->all(),
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal upload bukti coblos',
            ], 400);
        }
    }

    public function verificationCoblos(Request $request, $id)
    {
        $detail_verification = $request->input('detail_verification');
        $pendukung = TpsDetail::find($id);
        TpsDetail::find($id)->update([
            'detail_verification' => $detail_verification
        ]);

        return response()->json([
            'message' => 'Berhasil verifikasi relawan ini'
        ], 200);
    }

    public function tpsPendukung(Request $request)
    {

        if ($request->ajax()) {
            $provinces_id = $request->input('provinces_id');
            $regencies_id = $request->input('regencies_id');
            $districts_id = $request->input('districts_id');
            $villages_id = $request->input('villages_id');

            $data = Tps::select('*');
            if ($provinces_id != null) {
                $data->where('provinces_id', $provinces_id);
            }
            if ($regencies_id != null) {
                $data->where('regencies_id', $regencies_id);
            }
            if ($districts_id != null) {
                $data->where('districts_id', $districts_id);
            }
            if ($villages_id != null) {
                $data->where('villages_id', $villages_id);
            }
            $data = $data->get();

            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonDetail = '
                <a href="#" class="btn btn-outline-info m-b-xs btn-choose-tps" style="border-color: #91C8E4 !important;" data-id="' . $v_data->id . '">
                    <i class="fas fa-arrow-right"></i> Pilih TPS
                </a>
                ';
                $button = '
                <div class="text-center">
                    ' . $buttonDetail . '
                </div>
                ';

                $daerah = '
                <div class="row">
                    <div class="col-lg-6">
                    Provinsi: <br> <strong class="text-success">' . $v_data->provinces->name . ' </strong>
                    </div>
                    <div class="col-lg-6">
                    Kabupaten: <br> <strong class="text-success">' . $v_data->regencies->name . ' </strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                    Kecamatan: <br> <strong class="text-success">' . $v_data->districts->name . ' </strong>
                    </div>
                    <div class="col-lg-6">
                    Kelurahan: <br> <strong class="text-success">' . $v_data->villages->name . ' </strong>
                    </div>
                </div>
                ';

                $terdaftar = $v_data->users_id;
                $countTerdaftar = count(explode(',', $terdaftar));


                $capaianTps = '
                <div>
                    <strong class="text-dark">Kuota TPS: </strong> <strong>' . $v_data->kuota_tps . '</strong> <br>
                    <strong class="text-dark">Sudah terdaftar: </strong> <strong><i class="fas fa-users"></i> ' . $countTerdaftar . '</strong>
                </div>
                ';

                $result['data'][] = [
                    $no++,
                    $v_data->nama_tps,
                    $v_data->alamat_tps,
                    $daerah,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
    }

    public function getTps($tps_id)
    {
        $data = Tps::with('provinces', 'regencies', 'districts', 'villages')->find($tps_id);
        return response()->json($data, 200);
    }

    public function getTpsPendukung(Request $request)
    {
        $tps_detail_id = $request->input('tps_detail_id');
        $users_id_koordinator = $request->input('users_id_koordinator');
        $users_id_pendukung = $request->input('users_id');
        $tps_id = $request->input('tps_id');

        $data = TpsPendukung::where('tps_detail_id', $tps_detail_id)
            ->where('users_id_koordinator', $users_id_koordinator)
            ->where('users_id_pendukung', $users_id_pendukung)
            ->where('tps_id', $tps_id)
            ->with('tpsDetail', 'TpsDetail.tps', 'TpsDetail.tps.provinces', 'TpsDetail.tps.regencies', 'TpsDetail.tps.districts', 'TpsDetail.tps.villages')
            ->first();

        return response()->json($data, 200);
    }
}
