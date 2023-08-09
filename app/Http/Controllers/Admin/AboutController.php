<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Check;
use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;


class AboutController extends Controller
{
    public $validation = [
        'keterangan_about' => 'required',
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

            $data = About::all();
            $result = [];
            $no = 1;
            if ($data->count() == 0) {
                $result['data'] = [];
            }
            foreach ($data as $index => $v_data) {
                $buttonUpdate = '';
                if ($userAcess['is_update'] == '1') {
                    $buttonUpdate = '
                    <a href="' . route('admin.about.edit', $v_data->id) . '" class="btn btn-outline-warning m-b-xs btn-edit" style="border-color: #f5af47ea !important;">
                    <i class="fa-solid fa-pencil"></i>
                    </a>
                    ';
                }
                $buttonDelete = '';
                if ($userAcess['is_delete'] == '1') {
                    $buttonDelete = '
                    <form action=' . route('admin.about.destroy', $v_data->id) . ' class="d-inline">
                        <button type="submit" class="btn-delete btn btn-outline-danger m-b-xs" style="border-color: #EA1179 !important;">
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

                $url_gambar_about = asset('upload/about/gambar/' . $v_data->gambar_about);
                $gambar_about = '<a class="photoviewer" href="' . $url_gambar_about . '" data-gallery="photoviewer" data-title="' . $v_data->gambar_about . '">
                    <img src="' . $url_gambar_about . '" width="100%;"></img>
                </a>';

                $checkedStatus = '';
                if ($v_data->about_aktif == 1) {
                    $checkedStatus = 'checked';
                }

                $outputAktif = '
                <div class="text-center">
                    <div class="form-check form-switch">
                        <input data-url="' . route("admin.about.setAktif") . '" class="form-check-input check-input" data-id="' . $v_data->id . '" type="checkbox" id="is_aktif_' . $v_data->id . '" style="height: 20px; width: 40px;" ' . $checkedStatus . '>
                        <label class="form-check-label" for="is_aktif_' . $v_data->id . '"></label>
                    </div>
                </div>
              ';

                $result['data'][] = [
                    $no++,
                    $v_data->project_about,
                    $v_data->customers_about,
                    $v_data->team_about,
                    $v_data->awards_about,
                    $gambar_about,
                    $outputAktif,
                    trim($button)
                ];
            }

            return response()->json($result, 200);
        }
        return view('admin.about.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page = 'add';
        return view('admin.about.form', compact('page'));
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

        $file = $this->uploadFile($_FILES, null, 'teamdetail_about', 'team');
        $teamdetail_about = ['default.png'];
        if (is_array($file)) {
            if (!empty($file[0])) {
                $teamdetail_about = $file;
            }
        }
        $teamdetail_about = json_encode($teamdetail_about);

        $file = $this->uploadFile($_FILES, null, 'gambarsponsor_about', 'sponsor');
        $gambarsponsor_about = ['default.png'];
        if (is_array($file)) {
            if (!empty($file[0])) {
                $gambarsponsor_about = $file;
            }
        }
        $gambarsponsor_about = json_encode($gambarsponsor_about);

        $file = $request->file('gambar_about');
        $gambar_about = $this->uploadFileSingle($file);

        $data = [
            'keterangan_about' => $request->input('keterangan_about'),
            'gambar_about' => $gambar_about,
            'project_about' => $request->input('project_about'),
            'customers_about' => $request->input('customers_about'),
            'team_about' => $request->input('team_about'),
            'awards_about' => $request->input('awards_about'),
            'teamdetail_about' => $teamdetail_about,
            'gambarsponsor_about' => $gambarsponsor_about,
        ];
        $insert = About::create($data);
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
        $page = 'edit';
        $about = About::find($id);
        return view('admin.about.form', compact('page', 'about'));
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

        $file = $this->uploadFile($_FILES, $id, 'teamdetail_about', 'team');
        $teamdetail_about = ['default.png'];
        if (is_array($file)) {
            if (!empty($file[0])) {
                $teamdetail_about = $file;
            }
        }
        $teamdetail_about = json_encode($teamdetail_about);

        $file = $this->uploadFile($_FILES, $id, 'gambarsponsor_about', 'sponsor');
        $gambarsponsor_about = ['default.png'];
        if (is_array($file)) {
            if (!empty($file[0])) {
                $gambarsponsor_about = $file;
            }
        }
        $gambarsponsor_about = json_encode($gambarsponsor_about);

        $file = $request->file('gambar_about');
        $gambar_about = $this->uploadFileSingle($file, $id);

        $data = [
            'keterangan_about' => $request->input('keterangan_about'),
            'gambar_about' => $gambar_about,
            'project_about' => $request->input('project_about'),
            'customers_about' => $request->input('customers_about'),
            'team_about' => $request->input('team_about'),
            'awards_about' => $request->input('awards_about'),
            'teamdetail_about' => $teamdetail_about,
            'gambarsponsor_about' => $gambarsponsor_about,
        ];

        $update = About::find($id)->update($data);
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
        $this->deleteFileSingle($id);
        $this->deleteFile($id, 'sponsor');
        $this->deleteFile($id, 'team');

        $delete = About::destroy($id);
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

    private function uploadFileSingle($file, $id = null)
    {
        if ($file != null) {
            // delete file
            $this->deleteFileSingle($id);
            // nama file
            $fileExp =  explode('.', $file->getClientOriginalName());
            $name = $fileExp[0];
            $ext = $fileExp[1];
            $name = time() . '-' . str_replace(' ', '-', $name) . '.' . $ext;

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload =  public_path() . '/upload/about/gambar';

            // upload file
            $file->move($tujuan_upload, $name);
        } else {
            if ($id == null) {
                $name = 'default.png';
            } else {
                $user = About::where('id', $id)->first();
                $name = $user->gambar_about;
            }
        }

        return $name;
    }

    private function uploadFile($file, $id = null, $nameFile, $lokasi)
    {
        if ($file != null && floatval($file[$nameFile]['size'][0]) > 0) {
            // delete file
            $this->deleteFile($id, $lokasi);

            if (!empty($file[$nameFile])) {
                foreach ($file[$nameFile]['name'] as $index => $item) {
                    // nama file
                    $name = str_replace(' ', '-', $item);
                    $name = time() . '-' . $name;

                    // isi dengan nama folder tempat kemana file diupload
                    $tujuan_upload = 'upload/about/' . $lokasi . '/';

                    // upload file
                    $target_file = $tujuan_upload . $name;
                    if (move_uploaded_file($file[$nameFile]['tmp_name'][$index], $target_file)) {
                        $namePush[] = $name;
                    }
                }
                $name = $namePush;
            }
        } else {
            $name = ['default.png'];
            if ($id != null) {
                $gambar_detail = About::find($id);
                if ($lokasi == 'sponsor') {
                    $gambarsponsor_about = json_decode($gambar_detail->gambarsponsor_about, true);
                    $name = $gambarsponsor_about;
                }
                if ($lokasi == 'team') {
                    $teamdetail_about = json_decode($gambar_detail->teamdetail_about, true);
                    $name = $teamdetail_about;
                }
            }
        }

        return $name;
    }

    private function deleteFileSingle($id = null)
    {
        if ($id != null) {
            $about = About::where('id', '=', $id)->first();
            $gambar = public_path() . '/upload/about/gambar/' . $about->gambar_about;
            if (file_exists($gambar)) {
                if ($about->gambar_about != 'default.png') {
                    File::delete($gambar);
                }
            }
        }
    }

    private function deleteFileName($name = null, $lokasi = null)
    {
        $gambar = public_path() . '/upload/about/' . $lokasi . '/' . $name;
        if (file_exists($gambar)) {
            if ($name != 'default.png') {
                File::delete($gambar);
            }
        }
    }

    private function deleteFile($id = null, $lokasi = null)
    {
        if ($id != null && $lokasi != null) {
            $about = About::find($id);
            if ($lokasi == 'sponsor') {
                $gambar_detail = json_decode($about->gambarsponsor_about, true);
            }
            if ($lokasi == 'team') {
                $gambar_detail = json_decode($about->teamdetail_about, true);
            }

            foreach ($gambar_detail as $key => $value) {
                $gambar = public_path() . '/upload/about/' . $lokasi . '/' . $value;
                if (file_exists($gambar)) {
                    if ($value != 'default.png') {
                        File::delete($gambar);
                    }
                }
            }
        }
    }

    public function deleteMultipleImage()
    {
        $value = request()->input('value');
        $id = request()->input('id');
        $type = request()->input('type');

        $getData = About::find($id);
        $pushGambar = [];
        if ($type == 'team') {
            $parseJson = json_decode($getData->teamdetail_about, true);
        }
        if ($type == 'sponsor') {
            $parseJson = json_decode($getData->gambarsponsor_about, true);
        }

        foreach ($parseJson as $key => $item) {
            if ($item != $value) {
                $pushGambar[] = $item;
            }
        }

        $this->deleteFileName($value, $type);
        $setGambarTeam = json_encode($pushGambar);

        if ($type == 'team') {
            $getData->teamdetail_about = $setGambarTeam;
        }
        if ($type == 'sponsor') {
            $getData->gambarsponsor_about = $setGambarTeam;
        }
        $getData->save();

        $dataOutput =  About::find($id);
        return response()->json([
            'message' => 'Berhasil hapus gambar team',
            'result' => request()->all(),
            'output' => [
                'teamdetail_about' => json_decode($dataOutput->teamdetail_about, true),
                'gambarsponsor_about' => json_decode($dataOutput->gambarsponsor_about, true),
                'about' => $dataOutput
            ]
        ]);
    }

    public function setAktif()
    {
        $id = request()->input('id');
        About::query()->update([
            'about_aktif' => false
        ]);
        About::find($id)->update([
            'about_aktif' => true
        ]);

        return response()->json(['status' => 200, 'message' => 'Berhasil update data']);
    }
}
