<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Helper\Metode;
use App\Http\Controllers\Controller;
use App\Models\Hasil;
use Exception;
use Illuminate\Http\Request;


class HasilController extends Controller
{
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

            $data = Hasil::with('userDiagnosa')->get();
            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonDelete = '';
                if ($userAcess['is_delete'] == '1') {
                    $buttonDelete = '
                    <form action=' . route('admin.hasil.destroy', $v_data->id) . ' class="d-inline">
                        <button type="submit" class="btn-delete btn btn-outline-danger m-b-xs" style="border-color: #f75d6fd8 !important;">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                    ';
                }
                $buttonDetail = '
                <a href="' . route('admin.hasil.detail', $v_data->id) . '" class="btn btn-outline-info m-b-xs btn-detail" style="border-color: #4751f5ea !important;">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                ';
                $button = '
                <div class="text-center">
                    ' . $buttonDelete . '
                    ' . $buttonDetail . '
                </div>
                ';
                $result['data'][] = [
                    $no++,
                    $v_data->userDiagnosa->tanggal_user_diagnosa,
                    $v_data->userDiagnosa->judul_user_diagnosa,
                    $v_data->userDiagnosa->nama_user_diagnosa,
                    $v_data->userDiagnosa->jenis_kelamin_user_diagnosa == 'L' ? 'Laki-laki' : 'Perempuan',
                    $v_data->userDiagnosa->nomor_hp_user_diagnosa,
                    $v_data->userDiagnosa->email_user_diagnosa,
                    $v_data->userDiagnosa->alamat_user_diagnosa,
                    $v_data->userDiagnosa->usia_user_diagnosa,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
        return view('admin.hasil.index');
    }

    public function destroy($id)
    {
        //
        $delete = Hasil::destroy($id);
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

    public function detail($id)
    {
        $naiveBayes = new Metode();
        $metode = $naiveBayes->naiveBayes($id);

        // dd($metode);
        return view('admin.hasil.detail', [
            'metode' => $metode,
            'id' => $id,
        ]);
    }
}
