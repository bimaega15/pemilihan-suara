<?php

namespace App\Http\Controllers\Admin;

use App\Events\SuaraBroadcast;
use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Profile;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Tps;
use App\Models\KoordinatorTps;
use App\Models\TpsPendukung;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DataTables;

class KoordinatorController extends Controller
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



        if ($request->ajax()) {
            $userAcess = session()->get('userAcess');

            $tps_id = $request->input('tps_id');
            $data = KoordinatorTps::query()->with(['tps' => function ($query) use ($tps_id) {
                $query->where('id', $tps_id);
            }, 'users', 'users.profile'])
                ->where('tps_id', $tps_id);

            return DataTables::eloquent($data)
                ->addColumn('action', function ($row) use ($userAcess) {
                    $buttonUpdate = '';
                    if ($userAcess['is_update'] == '1') {
                        $buttonUpdate = '
                    <a href="' . route('admin.koordinator.edit', $row->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                    <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                    }
                    $buttonDelete = '';
                    if ($userAcess['is_delete'] == '1') {
                        $buttonDelete = '
                    <form action=' . route('admin.koordinator.destroy', $row->id) . ' class="d-inline">
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


                    return $button;
                })
                ->addColumn('gambar_profile', function ($row) use ($userAcess) {
                    $url_gambar_profile = asset('upload/profile/' . $row->users->profile->gambar_profile);
                    $gambar_profile = '<a class="photoviewer" href="' . $url_gambar_profile . '" data-gallery="photoviewer" data-title="' . $row->users->profile->gambar_profile . '">
                        <img src="' . $url_gambar_profile . '" width="100%;"></img>
                    </a>';

                    return $gambar_profile;
                })
                ->addColumn('jenis_kelamin_profile', function ($row) {
                    $jenisKelamin = $row->users->profile->jenis_kelamin_profile;
                    return $jenisKelamin == 'L' ? 'Laki-laki' : 'Perempuan';
                })

                ->rawColumns(['action', 'gambar_profile'])
                ->toJson();
        }

        $tps_id = $request->input('tps_id');
        $tps = Tps::find($tps_id);

        return view('admin.koordinator.index', [
            'tps_id' => $tps->id,
            'tps' => Tps::with('provinces', 'regencies', 'districts', 'villages')->find($tps->id),
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
            'users_id' => [function ($attribute, $value, $fail) use ($request) {
                $saveKoordinator = $request->session()->get('save_koordinator');

                $mesage = '';
                foreach ($saveKoordinator as $key => $value) {
                    if ($value == '') {
                        $mesage = 'User koordinator belum dipilih';
                    }
                }

                if ($mesage != '') {
                    $fail($mesage);
                }
            }],
            'tps_id' => 'required',
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

        $tps_id = $request->input('tps_id');
        $users_id =  $request->session()->get('save_koordinator');

        $data = [];
        foreach ($users_id as $key => $value) {
            $getUsers = User::find($value);
            $getUsers->is_registps = true;
            $getUsers->save();

            $data[] = [
                'users_id' => $value,
                'tps_id' => $tps_id
            ];
        }

        $koordinatorTps = KoordinatorTps::insert($data);

        if ($koordinatorTps) {
            $getTps = Tps::find($tps_id);
            $getTps->totalco_tps = $getTps->totalco_tps + count($data);
            $getTps->save();

            session()->forget('save_koordinator');

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
        $pendukung =  KoordinatorTps::with('users', 'users.profile', 'users.roles', 'tps', 'tps.provinces', 'tps.regencies', 'tps.districts', 'tps.villages')->find($id);
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
                $pendukung = KoordinatorTps::find($id);
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
        $tpsDetail = KoordinatorTps::find($id);
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

        // tps pendukung 
        $tps_detail_id = $tpsDetail->id;
        $users_id_pendukung = $users_id;
        $tps_id = $tps_id;

        $data = TpsPendukung::where('tps_detail_id', $tps_detail_id)
            ->where('users_id_pendukung', $users_id_pendukung)
            ->with('tpsDetail', 'KoordinatorTps.tps', 'KoordinatorTps.tps.provinces', 'KoordinatorTps.tps.regencies', 'KoordinatorTps.tps.districts', 'KoordinatorTps.tps.villages')
            ->first();
        $tps_pendukung_id = $data->id;
        $dataSet = [
            'tps_id' => $request->input('tps_id')
        ];
        TpsPendukung::find($tps_pendukung_id)->update($dataSet);

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
        $koordinator = KoordinatorTps::find($id);
        $tps_id = $koordinator->tps_id;

        $getTps = Tps::find($tps_id);
        $getTps->totalco_tps = $getTps->totalco_tps - 1;
        $getTps->save();

        $users_id = $koordinator->users_id;
        $getUsers = User::find($users_id);
        $getUsers->is_registps = null;
        $getUsers->save();

        $delete = KoordinatorTps::destroy($id);
        if ($delete) {
            SuaraBroadcast::dispatch();
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
                $user = KoordinatorTps::where('id', $id)->first();
                $name = $user->bukticoblos_detail;
            }
        }

        return $name;
    }

    private function deleteFileBukti($id = null)
    {
        if ($id != null) {
            $pendukung = KoordinatorTps::where('id', '=', $id)->first();
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

        $update =  KoordinatorTps::find($id)->update([
            'bukticoblos_detail' => $bukticoblos_detail
        ]);
        if ($update) {
            $tpsDetail = KoordinatorTps::find($id);
            $tpsDetail->detail_verification = true;
            $tpsDetail->save();
            $this->updateCountTps($tpsDetail->tps_id);

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
        $pendukung = KoordinatorTps::find($id);
        KoordinatorTps::find($id)->update([
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

        $data = TpsPendukung::where('tps_detail_id', $tps_detail_id);
        if ($users_id_koordinator != null) {
            $data->where('users_id_koordinator', $users_id_koordinator);
        }
        if ($users_id_pendukung != null) {
            $data->where('users_id_pendukung', $users_id_pendukung);
        }
        if ($tps_detail_id != null) {
            $data->where('tps_detail_id', $tps_detail_id);
        }
        $data->join('tps', 'tps.id', '=', 'tps_pendukung.tps_id')
            ->join('provinces', 'provinces.id', '=', 'tps.provinces_id')
            ->join('regencies', 'regencies.id', '=', 'tps.regencies_id')
            ->join('districts', 'districts.id', '=', 'tps.districts_id')
            ->join('villages', 'villages.id', '=', 'tps.villages_id')
            ->select('tps_pendukung.*', 'tps.nama_tps', 'tps.alamat_tps', 'tps.kuota_tps', 'provinces.name as provinces_name', 'provinces.id as provinces_id', 'regencies.name as regencies_name', 'regencies.id as regencies_id', 'districts.name as districts_name', 'districts.id as districts_id', 'villages.name as villages_name', 'villages.id as villages_id');
        $data = $data->first();

        return response()->json($data, 200);
    }

    public function usersKoordinator(Request $request)
    {

        $getCurrentUrl = '/admin/tps';
        if (!isset(Check::getMenu($getCurrentUrl)[0])) {
            abort(403, 'Cannot access page');
        }
        $getMenu = Check::getMenu($getCurrentUrl)[0];

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);

        $roles = 'koordinator';
        $data = User::query()
            ->select('users.*', 'roles.nama_roles', 'profile.nama_profile', 'profile.email_profile', 'profile.nohp_profile', 'profile.gambar_profile', 'profile.nik_profile', 'profile.alamat_profile', 'profile.jenis_kelamin_profile')
            ->join('profile', 'profile.users_id', 'users.id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.nama_roles', '=', $roles)
            ->where('users.is_aktif', '=', 1)
            ->where('users.is_registps', '=', null);
        $userAcess = session()->get('userAcess');


        return DataTables::eloquent($data)
            ->addColumn('check-input', function ($row) use ($userAcess, $roles, $request) {
                $checked = '';
                $saveKoordinator = $request->session()->get('save_koordinator');
                if ($saveKoordinator != null) {
                    if (in_array($row->id, $saveKoordinator)) {
                        $checked = 'checked';
                    }
                }

                $button = '
                <div class="form-check">
                    <input class="form-check-input check-input" type="checkbox" value="' . $row->id . '" id="users-' . $row->id . '" style="width: 18px; height: 18px;" ' . $checked . '>
                    <label class="form-check-label" for="users-' . $row->id . '">
                    </label>
                </div>
                ';
                return $button;
            })
            ->addColumn('collapse', function ($row) use ($userAcess, $roles) {
                $button = '
                <button type="button" class="btn btn-outline-info m-b-xs btn-show-users btn-sm" style="border-color: #4477CE !important;" data-roles="' . $roles . '" data-type="plus"
                >
                <i class="fas fa-plus"></i>
            </button>
                ';
                return $button;
            })
            ->addColumn('gambar_profile', function ($row) use ($userAcess, $roles) {
                $url_gambar_profile = asset('upload/profile/' . $row->profile->gambar_profile);
                $gambar_profile = '<a class="photoviewer" href="' . $url_gambar_profile . '" data-gallery="photoviewer" data-title="' . $row->profile->gambar_profile . '">
                <img src="' . $url_gambar_profile . '" width="100%;"></img>
            </a>';

                return $gambar_profile;
            })
            ->rawColumns(['collapse', 'gambar_profile', 'check-input'])
            ->toJson();
    }

    public function saveSession(Request $request)
    {
        $checked = request()->input('checked');
        $all_data = request()->input('all_data');
        $not_checked = request()->input('not_checked');



        if (session()->has('save_koordinator')) {
            $saveKoordinator = session()->get('save_koordinator');
            if ($not_checked != null) {
                foreach ($not_checked as $key2 => $value) {
                    unset($saveKoordinator[$value]);
                }

                session()->put('save_koordinator', $saveKoordinator);
            }

            if ($checked != null) {
                foreach ($checked as $key => $value) {
                    if ($value != null) {
                        if (!in_array($value, $saveKoordinator)) {
                            $saveKoordinator[$value] = $value;
                        }
                    }
                }
            }

            if (count($saveKoordinator) > 0) {
                session()->put('save_koordinator', $saveKoordinator);
            } else {
                session()->forget('save_koordinator');
            }
        } else {
            $saveCo = $request->input('checked');
            $pushValue = [];
            foreach ($saveCo as $key => $value) {
                $pushValue[$value] = $value;
            }

            session()->put('save_koordinator', $pushValue);
        }

        $saveSession = session()->get('save_koordinator');
        return response()->json($saveSession);
    }
}
