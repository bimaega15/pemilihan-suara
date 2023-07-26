<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Hasil;
use App\Models\HasilDetail;
use App\Models\JawabanKuisioner;
use App\Models\Kuisioner;
use App\Models\RangeBobot;
use App\Models\UserDiagnosa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DataTestingController extends Controller
{

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

            $kuisioner = Kuisioner::paginate(5);
            $jawabanKuisioner = JawabanKuisioner::all();
            return response()->json([
                'kuisioner' => $kuisioner,
                'jawabanKuisioner' => $jawabanKuisioner
            ], 200);
        }
        return view('admin.dataTesting.index', [
            'count_kuisioner' => Kuisioner::all()->count()
        ]);
    }

    public function storeSession()
    {
        $kuisioner_id = request()->input('kuisioner_id');
        $jawaban_kuisioner_id = request()->input('jawaban_kuisioner_id');

        if (session()->has('storeSession')) {
            $storeSession = session()->get('storeSession');
            if (isset($storeSession[$kuisioner_id])) {
                $storeSession[$kuisioner_id] = $jawaban_kuisioner_id;
                session()->put('storeSession', $storeSession);
            } else {
                $storeSession[$kuisioner_id] = $jawaban_kuisioner_id;
                session()->put('storeSession', $storeSession);
            }
        } else {
            session()->put('storeSession', [
                $kuisioner_id => $jawaban_kuisioner_id,
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => "Berhasil simpan session"
        ], 200);
    }

    public function getStoreSession()
    {
        $data = session()->get('storeSession');
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        //

        $validator = Validator::make($request->all(), [
            'count_kuisioner' => [function ($attribute, $value, $fail) use ($request) {
                $countKuisioner = $request->input('count_kuisioner');
                $sessionKuisioner = $request->session()->get('storeSession');

                if (intval($countKuisioner) != intval(count($sessionKuisioner))) {
                    $fail("Semua inputan kuisioner wajib diisi");
                }
            }],
            'tanggal_user_diagnosa' => 'required',
            'judul_user_diagnosa' => 'required',
            'nama_user_diagnosa' => 'required',
            'jenis_kelamin_user_diagnosa' => 'required',
            'nomor_hp_user_diagnosa' => 'required',
            'alamat_user_diagnosa' => 'required',
            'usia_user_diagnosa' => 'required',
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

        $data = [
            'alamat_user_diagnosa' => $request->input('alamat_user_diagnosa'),
            'email_user_diagnosa' => $request->input('email_user_diagnosa'),
            'jenis_kelamin_user_diagnosa' => $request->input('jenis_kelamin_user_diagnosa'),
            'judul_user_diagnosa' => $request->input('judul_user_diagnosa'),
            'nama_user_diagnosa' => $request->input('nama_user_diagnosa'),
            'nomor_hp_user_diagnosa' => $request->input('nomor_hp_user_diagnosa'),
            'tanggal_user_diagnosa' => Check::convertDate($request->input('tanggal_user_diagnosa')),
            'usia_user_diagnosa' => $request->input('usia_user_diagnosa'),
        ];
        $userDiagnosa = UserDiagnosa::create($data);
        $user_diagnosa_id = $userDiagnosa->id;

        $hasil = Hasil::create([
            'user_diagnosa_id' => $user_diagnosa_id
        ]);

        $storeSession = session()->get('storeSession');
        $dataStoreSession = [];
        foreach ($storeSession as $kuisioner_id => $jawaban_kuisioner_id) {
            $dataStoreSession[] = [
                'hasil_id' => $hasil->id,
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
            ];
        }
        $insertHasil = HasilDetail::insert($dataStoreSession);

        if ($insertHasil) {
            session()->forget('storeSession');
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
}
