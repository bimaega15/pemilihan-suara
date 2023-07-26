<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Kuisioner;
use App\Models\GambarKuisionerDetail;
use App\Models\Jenis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use function GuzzleHttp\Promise\all;

class KuisionerController extends Controller
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
            $data = Kuisioner::all();
            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonUpdate = '';
                if ($userAcess['is_update'] == '1') {
                    $buttonUpdate = '
                    <a href="' . route('admin.kuisioner.edit', $v_data->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                    <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                }
                $buttonDelete = '';
                if ($userAcess['is_delete'] == '1') {
                    $buttonDelete = '
                    <form action=' . route('admin.kuisioner.destroy', $v_data->id) . ' class="d-inline">
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


                $result['data'][] = [
                    $no++,
                    $v_data->kode_kuisioner,
                    $v_data->soal_kuisioner,
                    $v_data->definisi_kuisioner,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
        return view('admin.kuisioner.index');
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
            'kode_kuisioner' => ['required', function ($attribute, $value, $fail) use ($request) {
                $kodeKuisioner = $request->kode_kuisioner;
                $checkKodeKuisioner = Kuisioner::where('kode_kuisioner', $kodeKuisioner)->count();
                if ($checkKodeKuisioner > 0) {
                    $fail('Kode kuisioner sudah digunakan');
                }
            }],
            'soal_kuisioner' => ['required'],
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
            'kode_kuisioner' => $request->input('kode_kuisioner'),
            'soal_kuisioner' => $request->input('soal_kuisioner'),
            'definisi_kuisioner' => $request->input('definisi_kuisioner'),
        ];
        $insert = Kuisioner::create($data);


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
        $kuisioner = Kuisioner::find($id);
        if ($kuisioner) {
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $kuisioner,
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
            'kode_kuisioner' => ['required', function ($attribute, $value, $fail) use ($request, $id) {
                $kodeKuisioner = $request->kode_kuisioner;
                $checkKodeKuisioner = Kuisioner::where('kode_kuisioner', $kodeKuisioner)->where('id', '!=', $id)->count();
                if ($checkKodeKuisioner > 0) {
                    $fail('Kode kuisioner sudah digunakan');
                }
            }],
            'soal_kuisioner' => ['required'],
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
            'kode_kuisioner' => $request->input('kode_kuisioner'),
            'soal_kuisioner' => $request->input('soal_kuisioner'),
            'definisi_kuisioner' => $request->input('definisi_kuisioner'),
        ];
        $update = Kuisioner::find($id)->update($data);


        if ($update) {
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
        $delete = Kuisioner::destroy($id);
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

    public function autoNumber()
    {
        try {
            //code...
            $number = Kuisioner::select(DB::raw('max(kode_kuisioner) as kode_kuisioner'))->first();
            if ($number != '' && $number != null) {
                $getKodeKuisioner = ($number->kode_kuisioner);
                $getKodeKuisioner = str_replace('K', '', $getKodeKuisioner);
                $getKodeKuisioner = (int)  $getKodeKuisioner;
                $getKodeKuisioner++;
                $getAutoNumber = 'K' . sprintf("%03s", $getKodeKuisioner);
            } else {
                $getAutoNumber = 'K001';
            }
            if ($number) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil ambil data',
                    'result' => $getAutoNumber
                ], 200);
            } else {
                return response()->json([
                    'status' => 200,
                    'message' => 'Gagal ambil data',
                ], 200);
            }
        } catch (Exception $e) {
            //throw $th;
            return response()->json([
                'status' => 400,
                'message' => 'Terjadi kesalahan data',
                'result' => $e->getMessage()
            ], 400);
        }
    }
}
