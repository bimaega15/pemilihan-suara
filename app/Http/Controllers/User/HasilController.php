<?php

namespace App\Http\Controllers\User;

use App\Helper\Check;
use App\Helper\Metode;
use App\Http\Controllers\Controller;
use App\Models\Hasil;
use Exception;
use Illuminate\Http\Request;
use Cookie;


class HasilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $getCookie = Cookie::get('historyDiagnosa');
            $getCookie = explode(',', $getCookie);

            $data = Hasil::with('userDiagnosa')
                ->whereIn('id', $getCookie)
                ->get();

            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonDetail =
                    '
                <a href="' .
                    route('users.hasil.detail', $v_data->id) .
                    '" class="btn btn-outline-info m-b-xs btn-detail" style="border-color: #4751f5ea !important; min-width: 80px; !important">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                ';
                $button =
                    '
                <div class="text-center">
                    ' .
                    $buttonDetail .
                    '
                </div>
                ';
                $result['data'][] = [$no++, $v_data->userDiagnosa->tanggal_user_diagnosa, $v_data->userDiagnosa->judul_user_diagnosa, $v_data->userDiagnosa->nama_user_diagnosa, $v_data->userDiagnosa->jenis_kelamin_user_diagnosa == 'L' ? 'Laki-laki' : 'Perempuan', $v_data->userDiagnosa->nomor_hp_user_diagnosa, $v_data->userDiagnosa->email_user_diagnosa, $v_data->userDiagnosa->alamat_user_diagnosa, $v_data->userDiagnosa->usia_user_diagnosa, trim($button)];
            }

            return response()->json($result, 200);
        }
        return view('user.hasil.index');
    }

    public function destroy($id)
    {
        //
        $delete = Hasil::destroy($id);
        if ($delete) {
            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Berhasil delete data',
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'status' => 400,
                    'message' => 'Gagal delete data',
                ],
                400,
            );
        }
    }

    public function detail($id)
    {
        $naiveBayes = new Metode();
        $metode = $naiveBayes->naiveBayes($id);

        // dd($metode);
        return view('user.hasil.detail', [
            'metode' => $metode,
            'id' => $id,
        ]);
    }
}
