<?php

namespace App\Http\Controllers\Api\Korlap;

use App\Events\SuaraBroadcast;
use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\KoordinatorTps;
use App\Models\Tps;
use App\Models\PendukungTps;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use File;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;

class DataPendukungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $usersId = Auth::id();
            $getCo = KoordinatorTps::where('users_id', $usersId)->first();
            $tps_id = $getCo->tps_id;

            $data = PendukungTps::query()->with(['tps' => function ($query) use ($tps_id) {
                $query->where('id', $tps_id);
            }, 'users', 'users.profile'])
                ->where('tps_id', $tps_id)
                ->where('users_id_koordinator', $usersId)
                ->orWhere('users_id_koordinator', null)
                ->paginate(10);

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil ambil data',
                'result' => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan data',
                'result' => $e->getMessage()
            ], 500);
        }
    }

    public function uploadBukti($id)
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

    public function uploadCoblos(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'tps_coblos' => 'required|image|max:5048',
        ], [
            'required' => ':attribute wajib diisi',
            'image' => ':attribute harus berupa gambar',
            'max' => ':attribute tidak boleh lebih dari :max',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'invalid form validation',
                'result' => $validator->errors()
            ], 400);
        }

        // vote counting
        $getPendukungTps = PendukungTps::find($id);
        if ($getPendukungTps->tps_status == 0) {
            Check::voteCounting($id);
        }

        // biodata
        $file = $request->file('tps_coblos');
        $tps_coblos = $this->uploadFileCoblos($file, $id);

        $dataPendukung = [
            'tps_coblos' => $tps_coblos,
            'tps_status' => true,
        ];
        $pendukung = PendukungTps::find($id)->update($dataPendukung);
        if ($pendukung) {
            SuaraBroadcast::dispatch();

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

    private function uploadFile($file, $id = null)
    {
        if ($file != null) {
            // delete file
            $this->deleteFile($id);
            // nama file
            $fileExp =  explode('.', $file->getClientOriginalName());
            $name = $fileExp[0];
            $ext = $fileExp[1];
            $name = time() . '-' . str_replace(' ', '-', $name) . '.' . $ext;

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload =  public_path() . '/upload/tps/';

            // upload file
            $file->move($tujuan_upload, $name);
        } else {
            if ($id == null) {
                $name = 'default.png';
            } else {
                $pendukung = PendukungTps::where('id', $id)->first();
                $name = $pendukung->pendukungcoblos_tps == null ? 'default.png' : $pendukung->pendukungcoblos_tps;
            }
        }

        return $name;
    }

    private function deleteFile($id = null)
    {
        if ($id != null) {
            $pendukungTps = PendukungTps::where('id', '=', $id)->first();
            $gambar = public_path() . '/upload/tps/' . $pendukungTps->pendukungcoblos_tps;
            if (file_exists($gambar)) {
                if ($pendukungTps->pendukungcoblos_tps != 'default.png' && $pendukungTps->pendukungcoblos_tps != null) {
                    File::delete($gambar);
                }
            }
        }
    }

    private function uploadFileCoblos($file, $id = null)
    {
        if ($file != null) {
            // delete file
            $this->deleteFileCoblos($id);
            // nama file
            $fileExp =  explode('.', $file->getClientOriginalName());
            $name = $fileExp[0];
            $ext = $fileExp[1];
            $name = time() . '-' . str_replace(' ', '-', $name) . '.' . $ext;

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload =  public_path() . '/upload/coblos/';

            // upload file
            $file->move($tujuan_upload, $name);
        } else {
            if ($id == null) {
                $name = 'default.png';
            } else {
                $pendukung = PendukungTps::where('id', $id)->first();
                $name = $pendukung->tps_coblos == null ? 'default.png' : $pendukung->tps_coblos;
            }
        }

        return $name;
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

    public function store(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'pendukungcoblos_tps' => 'required|image|max:5048',

        ], [
            'required' => ':attribute wajib diisi',
            'image' => ':attribute harus berupa gambar',
            'max' => ':attribute tidak boleh lebih dari :max',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'invalid form validation',
                'result' => $validator->errors()
            ], 400);
        }


        // biodata
        $file = $request->file('pendukungcoblos_tps');
        $pendukungcoblos_tps = $this->uploadFile($file, $id);

        $dataPendukung = [
            'pendukungcoblos_tps' => $pendukungcoblos_tps,
            'users_id_koordinator' => Auth::id(),
            'verificationcoblos_tps' => null
        ];
        $pendukung = PendukungTps::find($id)->update($dataPendukung);

        if ($pendukung) {
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

    public function getHeaderTps(Request $request)
    {
        $tps_id = $request->input('tps_id');
        $users_id_koordinator = Auth::id();

        $getTps = Tps::with('villages')->find($tps_id);
        $getKoordinator = PendukungTps::where('tps_id', $tps_id)->where('users_id_koordinator', $users_id_koordinator)->get();
        $outputKoordinator = null;
        $statusPencapaian = null;
        $detailStatus = null;
        if ($getKoordinator != null) {
            $outputKoordinator = $getKoordinator;
            $minimalPendukung = $getTps->pendukung_tps;

            $countPendukung = 0;
            $detailPendukungSetuju = 0;
            $detailPendukungDitolak = 0;
            $detailPendukungMenunggu = 0;

            foreach ($getKoordinator as $key => $value) {
                if (strval($value->verificationcoblos_tps) == '1' && $value->tps_status == 1) {
                    $countPendukung++;
                    $detailPendukungSetuju++;
                }
                if (strval($value->verificationcoblos_tps) == '0' && $value->tps_status == 0) {
                    $detailPendukungDitolak++;
                }
                if (strval($value->verificationcoblos_tps) == null && $value->tps_status == 0) {
                    $detailPendukungMenunggu++;
                }
            }
            if ($countPendukung >= $minimalPendukung) {
                $statusPencapaian = $countPendukung;
            } else {
                $statusPencapaian =  $countPendukung;
            }

            $detailStatus = [
                'disetujui' => $detailPendukungSetuju,
                'ditolak' => $detailPendukungDitolak,
                'menunggu' => $detailPendukungMenunggu,
            ];
        }
        return response()->json([
            'tps' => $getTps,
            'koordinator' => $outputKoordinator,
            'status_pencapaian' => $statusPencapaian,
            'detail_status' => $detailStatus
        ]);
    }

    public function getUserTps(Request $request)
    {
        $id = $request->input('id');
        $getPendukung = PendukungTps::where('id', $id)->with('tps', 'users', 'users.profile')->first();

        return response()->json($getPendukung);
    }
}
