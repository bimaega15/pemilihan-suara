<?php

namespace App\Http\Controllers\User;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Kuisioner;
use App\Models\JawabanKuisioner;
use App\Models\UserDiagnosa;
use App\Models\Hasil;
use App\Models\HasilDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Cookie;

class DiagnosaController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userAcess = session()->get('userAcess');

            $kuisioner = Kuisioner::paginate(5);
            $jawabanKuisioner = JawabanKuisioner::all();
            return response()->json(
                [
                    'kuisioner' => $kuisioner,
                    'jawabanKuisioner' => $jawabanKuisioner,
                ],
                200,
            );
        }

        return view('user.diagnosa.index', [
            'count_kuisioner' => Kuisioner::all()->count(),
        ]);
    }

    public function storeSession()
    {
        $kuisioner_id = request()->input('kuisioner_id');
        $jawaban_kuisioner_id = request()->input('jawaban_kuisioner_id');

        if (session()->has('storeSessionUsers')) {
            $storeSession = session()->get('storeSessionUsers');
            if (isset($storeSession[$kuisioner_id])) {
                $storeSession[$kuisioner_id] = $jawaban_kuisioner_id;
                session()->put('storeSessionUsers', $storeSession);
            } else {
                $storeSession[$kuisioner_id] = $jawaban_kuisioner_id;
                session()->put('storeSessionUsers', $storeSession);
            }
        } else {
            session()->put('storeSessionUsers', [
                $kuisioner_id => $jawaban_kuisioner_id,
            ]);
        }

        return response()->json(
            [
                'status' => 200,
                'message' => 'Berhasil simpan session',
            ],
            200,
        );
    }

    public function getStoreSession()
    {
        $data = session()->get('storeSessionUsers');
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        //

        $validator = Validator::make(
            $request->all(),
            [
                'count_kuisioner' => [
                    function ($attribute, $value, $fail) use ($request) {
                        $countKuisioner = $request->input('count_kuisioner');
                        $sessionKuisioner = $request->session()->get('storeSessionUsers');

                        if (intval($countKuisioner) != intval(count($sessionKuisioner))) {
                            $fail('Semua inputan kuisioner wajib diisi');
                        }
                    },
                ],
                'tanggal_user_diagnosa' => 'required',
                'judul_user_diagnosa' => 'required',
                'nama_user_diagnosa' => 'required',
                'jenis_kelamin_user_diagnosa' => 'required',
                'nomor_hp_user_diagnosa' => 'required',
                'alamat_user_diagnosa' => 'required',
                'usia_user_diagnosa' => 'required',
            ],
            [
                'required' => ':attribute wajib diisi',
            ],
        );
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 400,
                    'message' => 'invalid form validation',
                    'result' => $validator->errors(),
                ],
                400,
            );
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
            'user_diagnosa_id' => $user_diagnosa_id,
        ]);

        $storeSession = session()->get('storeSessionUsers');
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
            session()->forget('storeSessionUsers');

            $getCookie = Cookie::get('historyDiagnosa');
            if ($getCookie != null && $getCookie != '') {
                $getCookie = explode(',', $getCookie);
                array_push($getCookie, $hasil->id);

                $pushCookie = implode(',', $getCookie);

                $minutes = 60 * 24;
                Cookie::queue('historyDiagnosa', $pushCookie, $minutes);
            } else {
                $pushCookie[] = $hasil->id;
                $pushCookie = implode(',', $pushCookie);

                $minutes = 60 * 24;
                Cookie::queue('historyDiagnosa', $pushCookie, $minutes);
            }

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Berhasil insert data',
                    'result' => $request->all(),
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'status' => 400,
                    'message' => 'Gagal insert data',
                ],
                400,
            );
        }
    }
}
