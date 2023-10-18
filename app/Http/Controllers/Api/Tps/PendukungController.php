<?php

namespace App\Http\Controllers\Api\Tps;

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
use Exception;

class PendukungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $tps_id = $request->input('tps_id');
            $data = PendukungTps::query()->with(['tps' => function ($query) use ($tps_id) {
                $query->where('id', $tps_id);
            }, 'users', 'users.profile'])
                ->where('tps_id', $tps_id)->paginate(10);
            return response()->json($data);
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
        //
        try {
            $validator = Validator::make($request->all(), [
                'users_id' => [function ($attribute, $value, $fail) use ($request) {
                    if (!$request->input('save_pendukung')) {
                        return $fail('User pendukung belum dipilih');
                    }

                    $savePendukung = $request->input('save_pendukung');

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
            $users_id =  $request->input('save_pendukung');
            $users_id = explode(',', $users_id);

            $data = [];
            foreach ($users_id as $key => $value) {
                $getUsers = User::with('profile')->find(trim($value));

                $getUsers->is_registps = true;
                $getUsers->save();

                $data[] = [
                    'users_id' => $value,
                    'tps_id' => $tps_id
                ];
            }

            $pendukungTps = PendukungTps::insert($data);

            if ($pendukungTps) {
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
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
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
        try {
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
        //
        try {
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
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }

    public function usersPendukung(Request $request)
    {
        try {
            $roles = 'pendukung';
            $searchValue =  $request->input('search');

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

            $result = $data->paginate(10);

            return response()->json([
                'status' => 200,
                'message' => "Berhasil ambil data",
                'result' => $result
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }

    public function selectPendukung(Request $request)
    {
        try {
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
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $result
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }


    // ======== yang belum
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
