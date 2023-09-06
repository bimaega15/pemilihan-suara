<?php

namespace App\Http\Controllers\Admin;

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

        $getCurrentUrl = '/admin/dataPendukung';
        if (!isset(Check::getMenu($getCurrentUrl)[0])) {
            abort(403, 'Cannot access page');
        }
        $getMenu = Check::getMenu($getCurrentUrl)[0];

        session()->put('userAcess.is_create', $getMenu->is_create);
        session()->put('userAcess.is_update', $getMenu->is_update);
        session()->put('userAcess.is_delete', $getMenu->is_delete);

        $usersId = Auth::id();
        $getCo = KoordinatorTps::where('users_id', $usersId)->first();
        $tps_id = $getCo->tps_id;

        if ($request->ajax()) {
            $userAcess = session()->get('userAcess');

            $tps_id = $request->input('tps_id');
            $data = PendukungTps::query()->with(['tps' => function ($query) use ($tps_id) {
                $query->where('id', $tps_id);
            }, 'users', 'users.profile'])
                ->where('tps_id', $tps_id);

            return DataTables::eloquent($data)
                ->addColumn('collapse_primary', function ($row) use ($userAcess) {
                    $button = '
            <button type="button" class="btn btn-outline-info m-b-xs btn-show-users btn-sm" style="border-color: #4477CE !important;" data-type="plus"
            >
            <i class="fas fa-plus"></i>
        </button>
            ';
                    return $button;
                })
                ->addColumn('action', function ($row) use ($userAcess) {
                    if (strval($row->verificationcoblos_tps) == null && $row->users_id_koordinator == null) {
                        $buttonVerification = '
                        <a href="' . route('admin.dataPendukung.uploadBukti', $row->id) . '" class="btn btn-outline-info m-b-xs btn-upload" style="border-color: #279EFF !important;" title="upload bukti pendukung">
                        <i class="fas fa-image"></i>
                        </a>
                        ';
                    }

                    if (strval($row->verificationcoblos_tps) == null && $row->users_id_koordinator != null) {
                        $buttonVerification = '
                        <span class="badge bg-info">
                            <i class="fas fa-clock"></i> Menunggu verifikasi
                        </span>
                        ';
                    }


                    if (strval($row->verificationcoblos_tps) == '1') {
                        $buttonVerification = '
                        <span class="badge bg-success">
                            <i class="fas fa-check"></i> Diverifikasi
                        </span>
                        ';
                    }

                    if (strval($row->verificationcoblos_tps) == '0') {
                        $buttonVerification = '
                        <span class="badge bg-danger">
                            <i class="fas fa-times"></i> Ditolak
                        </span>
                        ';
                    }


                    $button = '
                <div class="text-center">
                    ' . $buttonVerification . '
                </div>
                ';

                    return $button;
                })
                ->addColumn('tps_status_view', function ($row) use ($userAcess) {
                    $buttonVerification = '';
                    if (strval($row->verificationcoblos_tps) == '1' && strval($row->tps_status) == '0') {
                        $buttonVerification = '
                        <a href="' . route('admin.dataPendukung.uploadCoblos', $row->id) . '" class="btn btn-outline-info m-b-xs btn-coblos" data-id="' . $row->id . '" style="border-color: #279EFF !important;" title="coblos bukti pendukung">
                        <i class="fas fa-image"></i>
                        </a>
                        ';
                    }

                    if (strval($row->verificationcoblos_tps) != '1' && strval($row->tps_status) == '0') {
                        $buttonVerification = '
                        <span class="badge bg-warning">
                            <i class="fas fa-clock"></i>  Belum Verifikasi
                        </span>
                        ';
                    }

                    if (strval($row->verificationcoblos_tps) == '1' && strval($row->tps_status) == '1') {
                        $buttonVerification = '
                        <span class="badge bg-success">
                            <i class="fas fa-check"></i> Sudah Mencoblos
                        </span>
                        ';
                    }

                    $button = '
                <div class="text-center">
                    ' . $buttonVerification . '
                </div>
                ';

                    return $button;
                })
                ->addColumn('gambar_profile', function ($row) use ($userAcess) {
                    $url_gambar_profile = asset('upload/profile/' . $row->users->profile->gambar_profile);
                    $gambar_profile = '<a class="photoviewer" href="' . $url_gambar_profile . '" data-gallery="photoviewer" data-title="' . $row->users->profile->gambar_profile . '">
                        <img src="' . $url_gambar_profile . '" width="100%;"></img>
                    </a>';

                    return $gambar_profile;
                })
                ->addColumn('jenis_kelamin_profile', function ($row) {
                    $jenisKelamin = $row->users->profile->jenis_kelamin_profile;
                    return $jenisKelamin == 'L' ? 'Laki-laki' : 'Perempuan';
                })

                ->rawColumns(['action', 'gambar_profile', 'collapse_primary', 'tps_status_view'])
                ->toJson();
        }

        $tps = Tps::find($tps_id);

        return view('admin.dataPendukung.index', [
            'tps_id' => $tps_id,
            'tps' => Tps::with('provinces', 'regencies', 'districts', 'villages')->find($tps->id),
            'jabatan' => Jabatan::all()
        ]);
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
                $statusPencapaian = '<span class="badge bg-success" title="Sudah Tercapai">
                    ' . $countPendukung . ' pendukung
                </span>';
            } else {
                $statusPencapaian = '<span class="badge bg-warning" title="Belum Tercapai">
                    ' . $countPendukung . ' pendukung
                </span>';
            }

            $detailStatus = '
            <span class="me-1 badge bg-success">Disetujui: ' . $detailPendukungSetuju . ' </span>
            <span class="me-1 badge bg-danger">Ditolak: ' . $detailPendukungDitolak . ' </span>
            <span class="badge bg-info">Menunggu: ' . $detailPendukungMenunggu . ' </span>
            ';
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
