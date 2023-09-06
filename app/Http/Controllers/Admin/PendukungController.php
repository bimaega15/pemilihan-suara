<?php

namespace App\Http\Controllers\Admin;

use App\Events\SuaraBroadcast;
use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\KoordinatorTps;
use App\Models\Tps;
use App\Models\PendukungTps;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;

use DataTables;

class PendukungController extends Controller
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
            $data = PendukungTps::query()->with(['tps' => function ($query) use ($tps_id) {
                $query->where('id', $tps_id);
            }, 'users', 'users.profile'])
                ->where('tps_id', $tps_id);

            return DataTables::eloquent($data)
                ->addColumn('collapse_primary', function ($row) use ($userAcess) {
                    $button = '
            <button type="button" class="btn btn-outline-dark m-b-xs btn-show-users btn-sm" style="border-color: #141E46 !important;" data-type="plus"
            >
            <i class="fas fa-plus text-dark"></i>
        </button>
            ';
                    return $button;
                })
                ->addColumn('action', function ($row) use ($userAcess) {
                    $buttonUpdate = '';
                    if ($userAcess['is_update'] == '1') {
                        $buttonUpdate = '
                    <a href="' . route('admin.pendukung.edit', $row->id) . '" class="btn btn-outline-dark m-b-xs btn-edit" style="border-color: #141E46 !important;">
                    <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                    }
                    $buttonDelete = '';
                    if ($userAcess['is_delete'] == '1') {
                        $buttonDelete = '
                    <form action=' . route('admin.pendukung.destroy', $row->id) . ' class="d-inline">
                        <button type="submit" class="btn-delete btn btn-outline-dark m-b-xs" style="border-color: #141E46 !important;">
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

                ->rawColumns(['action', 'gambar_profile', 'collapse_primary'])
                ->toJson();
        }

        $tps_id = $request->input('tps_id');
        $tps = Tps::find($tps_id);

        return view('admin.pendukung.index', [
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
                if (!$request->session()->has('save_pendukung')) {
                    return $fail('User pendukung belum dipilih');
                }

                $savePendukung = $request->session()->get('save_pendukung');

                $mesage = '';
                foreach ($savePendukung as $key => $value) {
                    if ($value == '') {
                        $mesage = 'User pendukung belum dipilih';
                    }
                }

                if ($mesage != '') {
                    return  $fail($mesage);
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


        $users_id =  $request->session()->get('save_pendukung');

        $data = [];
        foreach ($users_id as $key => $value) {
            $getUsers = User::with('profile')->find($value);

            $getUsers->is_registps = true;
            $getUsers->save();

            $data[] = [
                'users_id' => $value,
                'tps_id' => $tps_id
            ];
        }

        $pendukungTps = PendukungTps::insert($data);

        if ($pendukungTps) {
            session()->forget('save_pendukung');

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
        $pendukung =  PendukungTps::with('tps', 'users', 'users.profile')->find($id);
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
            'users_id_select' => 'required',
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
        $getPendukungTps = PendukungTps::find($id);

        $getUsers = User::find($getPendukungTps->users_id);
        $getUsers->is_registps = null;
        $getUsers->save();

        $users_id = $request->input('users_id_select');
        $pendukungTps = PendukungTps::find($id)->update([
            'users_id' => $users_id
        ]);;

        if ($pendukungTps) {
            $getUsers = User::find($users_id);
            $getUsers->is_registps = true;
            $getUsers->save();

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
        $pendukung = PendukungTps::find($id);
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


        $users_id = $pendukung->users_id;
        $getUsers = User::with('profile')->find($users_id);
        $getUsers->is_registps = null;
        $getUsers->save();

        $delete = PendukungTps::destroy($id);
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

    public function usersPendukung(Request $request)
    {
        $getCurrentUrl = '/admin/tps';
        if (!isset(Check::getMenu($getCurrentUrl)[0])) {
            abort(403, 'Cannot access page');
        }
        $getMenu = Check::getMenu($getCurrentUrl)[0];

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);

        $roles = 'pendukung';
        $searchValue =  $request->input('search')['value'];


        $data = User::query()
            ->select('users.*', 'roles.nama_roles', 'profile.nama_profile', 'profile.email_profile', 'profile.nohp_profile', 'profile.gambar_profile', 'profile.nik_profile', 'profile.alamat_profile', 'profile.jenis_kelamin_profile')
            ->join('profile', 'profile.users_id', 'users.id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.nama_roles', '=', $roles)
            ->where('users.is_aktif', '=', 1)
            ->where('users.is_registps', '=', null);

        if ($searchValue != null) {
            $data->where('profile.nama_profile', 'LIKE', '%' . $searchValue . '%')
                ->orWhere('profile.email_profile', 'LIKE', '%' . $searchValue . '%')
                ->orWhere('profile.nohp_profile', 'LIKE', '%' . $searchValue . '%')
                ->orWhere('roles.nama_roles', 'LIKE', '%' . $searchValue . '%')
                ->orWhere('users.username', 'LIKE', '%' . $searchValue . '%');
        }
        $userAcess = session()->get('userAcess');


        return DataTables::eloquent($data)
            ->addColumn('check-input', function ($row) use ($userAcess, $roles, $request) {
                $checked = '';
                $savePendukung = $request->session()->get('save_pendukung');
                if ($savePendukung != null) {
                    if (in_array($row->id, $savePendukung)) {
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

    public function selectPendukung(Request $request)
    {

        $getCurrentUrl = '/admin/tps';
        if (!isset(Check::getMenu($getCurrentUrl)[0])) {
            abort(403, 'Cannot access page');
        }
        $getMenu = Check::getMenu($getCurrentUrl)[0];

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);

        $roles = 'pendukung';
        $users_id = $request->input('users_id');

        $search = $request->input('search');

        $limit = 10;
        $page = $request->input('page');
        $endPage = $page * $limit;
        $firstPage = $endPage - $limit;

        $users = User::query()
            ->select('users.*', 'roles.nama_roles', 'profile.nama_profile', 'profile.email_profile', 'profile.nohp_profile', 'profile.gambar_profile', 'profile.nik_profile', 'profile.alamat_profile', 'profile.jenis_kelamin_profile')
            ->join('profile', 'profile.users_id', 'users.id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.nama_roles', '=', $roles)
            ->where('users.is_aktif', '=', 1)
            ->where('users.is_registps', '=', null);

        $countUsers = $users->get()->count();
        if ($search != null) {
            $users->orWhere('users.username', 'like', '%' . $search . '%')
                ->orWhere('roles.nama_role', 'like', '%' . $search . '%')
                ->orWhere('profile.nama_profile', 'like', '%' . $search . '%')
                ->orWhere('profile.email_profile', 'like', '%' . $search . '%')
                ->orWhere('profile.nohp_profile', 'like', '%' . $search . '%')
                ->orWhere('profile.nik_profile', 'like', '%' . $search . '%')
                ->orWhere('profile.alamat_profile', 'like', '%' . $search . '%')
                ->orWhere('profile.jenis_kelamin_profile', 'like', '%' . $search . '%');
        }
        if ($users_id != null) {
            $users->orWhere('users.id', '=', $users_id);
        }

        $users = $users->offset($firstPage)
            ->limit($limit)
            ->get();

        if ($search != null) {
            $countUsers = $users->count();
        }

        $result = [];
        foreach ($users as $key => $v_users) {
            $result['results'][] =
                [
                    'id' => $v_users->id,
                    'text' => $v_users->nik_profile . ' ' . $v_users->nama_profile,
                ];
        }
        $result['count_filtered'] = $countUsers;
        return response()->json($result, 200);
    }

    public function selectPendukungTps(Request $request)
    {

        $getCurrentUrl = '/admin/dataPendukung';
        if (!isset(Check::getMenu($getCurrentUrl)[0])) {
            abort(403, 'Cannot access page');
        }
        $getMenu = Check::getMenu($getCurrentUrl)[0];

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);

        $tps_id = $request->input('tps_id');
        $search = $request->input('search');

        $limit = 10;
        $page = $request->input('page');
        $endPage = $page * $limit;
        $firstPage = $endPage - $limit;

        $users = PendukungTps::query()
            ->select('pendukung_tps.*', 'profile.nik_profile', 'profile.nama_profile', 'profile.email_profile')
            ->join('users', 'users.id', '=', 'pendukung_tps.users_id')
            ->join('profile', 'users.id', '=', 'profile.users_id')
            ->where('pendukung_tps.tps_id', $tps_id);

        if ($search != null) {
            $users
                ->where('profile.nama_profile', 'like', '%' . $search . '%')
                ->orWhere('profile.nik_profile', 'like', '%' . $search . '%')
                ->orWhere('profile.email_profile', 'like', '%' . $search . '%')
                ->where('pendukung_tps.tps_id', $tps_id);
        }

        $countUsers = $users->get()->count();
        $users = $users->offset($firstPage)
            ->limit($limit)
            ->get();

        if ($search != null) {
            $countUsers = $users->count();
        }

        $result = [];
        foreach ($users as $key => $v_users) {
            $result['results'][] =
                [
                    'id' => $v_users->id,
                    'text' => $v_users->nama_profile . ' / ' . $v_users->nik_profile . ' / ' . $v_users->email_profile . ' ',
                ];
        }
        $result['count_filtered'] = $countUsers;
        return response()->json($result, 200);
    }

    public function saveSession(Request $request)
    {
        $checked = request()->input('checked');
        $all_data = request()->input('all_data');
        $not_checked = request()->input('not_checked');

        if (session()->has('save_pendukung')) {
            $savePendukung = session()->get('save_pendukung');
            if ($not_checked != null) {
                foreach ($not_checked as $key2 => $value) {
                    unset($savePendukung[$value]);
                }

                session()->put('save_pendukung', $savePendukung);
            }

            if ($checked != null) {
                foreach ($checked as $key => $value) {
                    if ($value != null) {
                        if (!in_array($value, $savePendukung)) {
                            $savePendukung[$value] = $value;
                        }
                    }
                }
            }

            if (count($savePendukung) > 0) {
                session()->put('save_pendukung', $savePendukung);
            } else {
                session()->forget('save_pendukung');
            }
        } else {
            $saveCo = $request->input('checked');
            $pushValue = [];
            foreach ($saveCo as $key => $value) {
                $pushValue[$value] = $value;
            }

            session()->put('save_pendukung', $pushValue);
        }

        $saveSession = session()->get('save_pendukung');
        return response()->json($saveSession);
    }

    public function verify(Request $request)
    {
        $id = $request->input('id');
        $verificationcoblos_tps = $request->input('verificationcoblos_tps');

        $updatePendukung = PendukungTps::find($id)->update([
            'verificationcoblos_tps' => $verificationcoblos_tps,
        ]);
        if ($updatePendukung) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil verifikasi pendukung'
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal verifikasi pendukung'
            ], 400);
        }
    }

    public function coblos(Request $request)
    {
        $id = $request->input('id');
        $this->deleteFileCoblos($id);

        Check::voteCounting($id);

        $updatePendukung = PendukungTps::find($id)->update([
            'tps_status' => 0,
            'tps_coblos' => 'default.png'
        ]);

        if ($updatePendukung) {
            SuaraBroadcast::dispatch();

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil verifikasi pendukung'
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal verifikasi pendukung'
            ], 400);
        }
    }

    private function deleteFileCoblos($id = null)
    {
        if ($id != null) {
            $pendukungTps = PendukungTps::where('id', '=', $id)->first();
            $gambar = public_path() . '/upload/coblos/' . $pendukungTps->tps_coblos;
            if (file_exists($gambar)) {
                if ($pendukungTps->tps_coblos != 'default.png' && $pendukungTps->tps_coblos != null) {
                    File::delete($gambar);
                }
            }
        }
    }
}
