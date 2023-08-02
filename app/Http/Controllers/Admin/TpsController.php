<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Tps;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TpsController extends Controller
{
    public $validation = [
        'provinces_id' => 'required',
        'regencies_id' => 'required',
        'districts_id' => 'required',
        'villages_id' => 'required',
        'nama_tps' => 'required',
        'minimal_tps' => 'required',
        'users_id' => 'required',
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

            $data = Tps::all();
            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonUpdate = '';
                if ($userAcess['is_update'] == '1') {
                    $buttonUpdate = '
                    <a href="' . route('admin.tps.edit', $v_data->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                    <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                }
                $buttonDelete = '';
                if ($userAcess['is_delete'] == '1') {
                    $buttonDelete = '
                    <form action=' . route('admin.tps.destroy', $v_data->id) . ' class="d-inline">
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

                $result['data'][] = [
                    $no++,
                    $v_data->nama_tps,
                    $v_data->minimal_tps,
                    $v_data->totallk_tps == null ? 0 : $v_data->totallk_tps,
                    $v_data->totalpr_tps == null ? 0 : $v_data->totalpr_tps,
                    $v_data->totalsemua_tps == null ? 0 : $v_data->totalsemua_tps,
                    $v_data->users_id,
                    $daerah,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
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
            'users_id' => $request->input('users_id'),
            'minimal_tps' => $request->input('minimal_tps'),
        ];
        $insert = Tps::create($data);
        if ($insert) {
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
        $Tps = Tps::find($id);
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
            'nama_tps' => $request->input('nama_tps'),
            'keterangan_tps' => $request->input('keterangan_tps'),
            'membawahi_tps' => $request->input('membawahi_tps'),
        ];
        $insert = Tps::find($id)->update($data);
        if ($insert) {
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

        $usersKoordinator = User::join('profile', 'profile.users_id', '=', 'users.id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.nama_roles', 'koordinator');
        $countDistricts = User::join('profile', 'profile.users_id', '=', 'users.id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.nama_roles', 'koordinator')->get()->count();

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

        $result = [];
        foreach ($usersKoordinator as $key => $v_usersKoordinator) {
            $result['results'][] =
                [
                    'id' => $v_usersKoordinator->id,
                    'text' => $v_usersKoordinator->nama_profile,
                ];
        }
        $result['count_filtered'] = $countDistricts;
        return response()->json($result, 200);
    }
}
