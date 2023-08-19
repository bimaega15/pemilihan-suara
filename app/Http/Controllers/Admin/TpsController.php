<?php

namespace App\Http\Controllers\Admin;

use App\Events\TpsCreated;
use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Tps;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;


class TpsController extends Controller
{
    public $validation = [
        'provinces_id' => 'required',
        'regencies_id' => 'required',
        'districts_id' => 'required',
        'villages_id' => 'required',
        'nama_tps' => 'required',
        'alamat_tps' => 'required',
        'minimal_tps' => 'required',
        'pendukung_tps' => 'required',
        'kuota_tps' => 'required',
    ];
    public $customValidation = [
        'required' => ':attribute wajib diisi',
    ];
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

            $data = Tps::query()->with('villages');

            return DataTables::eloquent($data)
                ->addColumn('action', function ($row) use ($userAcess) {
                    $buttonUpdate = '';
                    if ($userAcess['is_update'] == '1') {
                        $buttonUpdate = '
                        <a href="' . route('admin.tps.edit', $row->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                        <i class="fa-solid fa-pencil"></i>
                        </a>
                        ';
                    }
                    $buttonDelete = '';
                    if ($userAcess['is_delete'] == '1') {
                        $buttonDelete = '
                        <form action=' . route('admin.tps.destroy', $row->id) . ' class="d-inline">
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
                ->addColumn('koordinator', function ($row) use ($userAcess) {
                    $countCo = $row->totalco_tps == null ? 0 : $row->totalco_tps;
                    $buttonCo = '
                    <a href="' . url('admin/koordinator?tps_id=' . $row->id) . '" class="badge bg-success" style="border-color: #5B9A8B !important;">
                        <i class="fas fa-list"></i> ' . $countCo . ' Koordinator
                    </a>';
                    return $buttonCo;
                })
                ->addColumn('pendukung', function ($row) use ($userAcess) {
                    $countPendukung = $row->totalsemua_tps == null ? 0 : $row->totalsemua_tps;
                    $buttonCo = '
                    <a href="' . url('admin/pendukung?tps_id=' . $row->id) . '" class="badge bg-success" style="border-color: #5B9A8B !important;">
                        <i class="fas fa-list"></i> ' . $countPendukung . ' Pendukung
                    </a>';
                    return $buttonCo;
                })
                ->rawColumns(['action', 'koordinator', 'pendukung'])
                ->toJson();
        }
        return view('admin.tps.index');
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
        $validator = Validator::make($request->all(), $this->validation, $this->customValidation);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'invalid form validation',
                'result' => $validator->errors()
            ], 400);
        }

        $data = [
            'provinces_id' => $request->input('provinces_id'),
            'regencies_id' => $request->input('regencies_id'),
            'districts_id' => $request->input('districts_id'),
            'villages_id' => $request->input('villages_id'),
            'nama_tps' => $request->input('nama_tps'),
            'alamat_tps' => $request->input('alamat_tps'),
            'minimal_tps' => $request->input('minimal_tps'),
            'pendukung_tps' => $request->input('pendukung_tps'),
            'kuota_tps' => $request->input('kuota_tps'),
        ];
        $insert = Tps::create($data);
        if ($insert) {
            TpsCreated::dispatch();

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
        $Tps = Tps::with('provinces', 'regencies', 'districts', 'villages')->find($id);
        if ($Tps) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $Tps,
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
        $validator = Validator::make($request->all(), $this->validation, $this->customValidation);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'invalid form validation',
                'result' => $validator->errors()
            ], 400);
        }

        $data = [
            'provinces_id' => $request->input('provinces_id'),
            'regencies_id' => $request->input('regencies_id'),
            'districts_id' => $request->input('districts_id'),
            'villages_id' => $request->input('villages_id'),
            'nama_tps' => $request->input('nama_tps'),
            'alamat_tps' => $request->input('alamat_tps'),
            'minimal_tps' => $request->input('minimal_tps'),
            'pendukung_tps' => $request->input('pendukung_tps'),
            'kuota_tps' => $request->input('kuota_tps'),
        ];
        $insert = Tps::find($id)->update($data);
        if ($insert) {
            TpsCreated::dispatch();

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
        $delete = Tps::destroy($id);
        if ($delete) {
            TpsCreated::dispatch();

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

    public function getProvinsi()
    {
        $data = Province::all();
        return response()->json([
            'status' => 200,
            'message' => "Berhasil ambil data",
            "result" => $data
        ], 200);
    }

    public function getKoordinator(Request $request)
    {
        $search = $request->input('search');

        $limit = 10;
        $page = $request->input('page');
        $endPage = $page * $limit;
        $firstPage = $endPage - $limit;

        $usersKoordinator = User::select('users.*', 'profile.nama_profile')->join('profile', 'profile.users_id', '=', 'users.id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.nama_roles', 'koordinator')
            ->where('users.is_aktif', 1);

        $countKoordinator =  User::select('users.*', 'profile.nama_profile')
            ->join('profile', 'profile.users_id', '=', 'users.id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.nama_roles', 'koordinator')
            ->where('users.is_aktif', 1)
            ->get()->count();

        if ($search != null) {
            $usersKoordinator
                ->where('nik_profile', 'like', '%' . $search . '%')
                ->orWhere('nama_profile', 'like', '%' . $search . '%')
                ->orWhere('email_profile', 'like', '%' . $search . '%')
                ->orWhere('alamat_profile', 'like', '%' . $search . '%')
                ->orWhere('nohp_profile', 'like', '%' . $search . '%');
        }
        $usersKoordinator = $usersKoordinator->offset($firstPage)
            ->limit($limit)
            ->get();

        if ($search != null) {
            $countKoordinator = $usersKoordinator->count();
        }

        $result = [];
        foreach ($usersKoordinator as $key => $v_usersKoordinator) {
            $result['results'][] =
                [
                    'id' => $v_usersKoordinator->id,
                    'text' => $v_usersKoordinator->nama_profile,
                ];
        }
        $result['count_filtered'] = $countKoordinator;
        return response()->json($result, 200);
    }

    public function getAddKoordinator(Request $request, $id)
    {
        $users_id = $id;
        $getData = Tps::find($users_id);

        $explodeUsersId = explode(',', $getData->users_id);
        $joinUsers = User::join('profile', 'users.id', '=', 'profile.users_id')
            ->whereIn('users.id', $explodeUsersId)
            ->get();


        if ($getData) {
            return response()->json($joinUsers, 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Gagal update data',
            ], 400);
        }
    }

    public function addKoordinator(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'users_id' => [function ($attribute, $value, $fail) use ($request, $id) {
                $users_id = $request->input('users_id');
                $countUsers = count($users_id);

                $getTps = Tps::find($id);
                if ($countUsers > $getTps->kuota_tps) {
                    $fail('Kuota untuk Koordinator TPS = ' . $getTps->kuota_tps);
                }

                $users_id = $request->input('users_id');
                $message = '';
                foreach ($users_id as $key => $value) {
                    $checkTps = Tps::where('users_id', 'like', '%' . $value . '%')->get()->count();
                    if ($checkTps > 0) {
                        $getTps = Tps::where('users_id', 'like', '%' . $value . '%')
                            ->first();
                        $checkProfile = Check::getUserProfile($value);
                        $message .= 'Koordinator: ' . $checkProfile->profile->nama_profile . ' terdaftar pada tps: ' . $getTps->nama_tps . '<br>';
                    }
                }
                if ($message != '') {
                    $fail($message);
                }
            }]
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

        $users_id = $request->input('users_id');
        if ($users_id != null) {
            $set_users_id = implode(',', $users_id);
            Tps::find($id)->update([
                'users_id' => $set_users_id
            ]);
        } else {
            Tps::find($id)->update([
                'users_id' => null
            ]);
        }

        TpsCreated::dispatch();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil update data',
            'result' => $request->all(),
        ], 200);
    }
}
