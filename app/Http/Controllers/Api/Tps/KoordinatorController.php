<?php

namespace App\Http\Controllers\Api\Tps;

use App\Helper\Check;
use App\Http\Controllers\Controller;

use App\Models\Tps;
use App\Models\KoordinatorTps;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DataTables;
use Exception;

class KoordinatorController extends Controller
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
            $data = KoordinatorTps::query()->with(['tps' => function ($query) use ($tps_id) {
                $query->where('id', $tps_id);
            }, 'users', 'users.profile'])
                ->where('tps_id', $tps_id)->paginate(10);

            return response()->json([
                'status' => 200,
                'message' => "Berhasil ambil data",
                'result' => $data
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
                'users_id' => [function ($attribute, $value, $fail) use ($request) {
                    if (!$request->input('save_koordinator')) {
                        return $fail('User koordinator belum dipilih');
                    }
                    $saveKoordinator = $request->input('save_koordinator');

                    $mesage = '';
                    foreach ($saveKoordinator as $key => $value) {
                        if ($value == '') {
                            $mesage = 'User koordinator belum dipilih';
                        }
                    }

                    if ($mesage != '') {
                        return  $fail($mesage);
                    }

                    $tpsId = $request->input('tps_id');
                    $getTps = Tps::find($tpsId);
                    if (count($saveKoordinator) > $getTps->kuota_tps) {
                        $fail('Kuota koordinator adalah: ' . $getTps->kuota_tps . ' sedang anda memilih ' . count($saveKoordinator) . ' Koordinator');
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
            $users_id =  $request->input('save_koordinator');
            $users_id = explode(',', $users_id);

            $data = [];
            foreach ($users_id as $key => $value) {
                $getUsers = User::find(trim($value));
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
        $koordinator =  KoordinatorTps::with('tps', 'users', 'users.profile')->find($id);
        if ($koordinator) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $koordinator,
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
            $getKoordinatorTps = KoordinatorTps::find($id);

            $getUsers = User::find($getKoordinatorTps->users_id);
            $getUsers->is_registps = null;
            $getUsers->save();

            $users_id = $request->input('users_id_select');
            $koordinatorTps = KoordinatorTps::find($id)->update([
                'users_id' => $users_id
            ]);;

            if ($koordinatorTps) {
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

    public function usersKoordinator(Request $request)
    {
        try {
            $roles = 'koordinator';
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

    public function selectKoordinator(Request $request)
    {
        try {
            $roles = 'koordinator';
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
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Terjadi kesalahan data",
                'result' => $e->getMessage()
            ], 500);
        }
    }
}
