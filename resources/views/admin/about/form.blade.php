@extends('layouts.admin')
@section('title')
Form About
@endsection
@section('content')
@push('css')
<style>
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }
</style>

@push('css')
<style>
    .photoviewer-modal {
        background-color: transparent;
        border: none;
        border-radius: 0;
        box-shadow: 0 0 6px 2px rgba(0, 0, 0, .3);
    }

    .photoviewer-header .photoviewer-toolbar {
        background-color: rgba(0, 0, 0, .5);
    }

    .photoviewer-stage {
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, .85);
        border: none;
    }

    .photoviewer-footer .photoviewer-toolbar {
        background-color: rgba(0, 0, 0, .5);
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .photoviewer-header,
    .photoviewer-footer {
        border-radius: 0;
        pointer-events: none;
    }

    .photoviewer-title {
        color: #ccc;
    }

    .photoviewer-button {
        color: #ccc;
        pointer-events: auto;
    }

    .photoviewer-header .photoviewer-button:hover,
    .photoviewer-footer .photoviewer-button:hover {
        color: white;
    }
</style>
@endpush
@endpush
<?php
$isCreate = session()->get('userAcess.is_create');
?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i data-feather="settings"></i> <strong>Form about</strong>
                            </div>
                            <div>
                                {{ Breadcrumbs::render('formAbout') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ 
                            $page == 'add' ? route('admin.about.store') : 
                            url('admin/about/'.$about->id.'?_method=put') }}" class="form-submit" method="post">
                            <input type="hidden" name="type_submit" value="{{ $page == 'add' ? 'post' : 'put' }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <a href="{{ url('/admin/about') }}" class="btn btn-primary btn-add">
                                            <i data-feather="arrow-left"></i> kembali
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <textarea name="keterangan_about" class="form-control keterangan_about" id="editor" placeholder="Keterangan">
                                        {{ isset($about) ? $about->keterangan_about ?? '' : '' }}
                                        </textarea>
                                        <small class="error_keterangan_about text-danger"></small>
                                    </div>
                                    <div style="height: 10px;"></div>
                                    <div class="form-group">
                                        <label for="">Gambar</label>
                                        <input type="file" class="form-control gambar_about" name="gambar_about">
                                        <div id="load_gambar_about">
                                            @php
                                            $gambarAbout = isset($about) ? $about->gambar_about ?? 'default.png' : '';

                                            $url_gambar_about = asset('upload/about/gambar/' . $gambarAbout);
                                            @endphp
                                            @if (isset($about))
                                            <a class="photoviewer" href="{{ $url_gambar_about }}" data-gallery="photoviewer" data-title="{{ $about->gambar_about }}">
                                                <img src="{{ $url_gambar_about }}" style="height: 150px;"></img>
                                            </a>
                                            @endif

                                        </div>
                                        <small class="error_gambar_about text-danger"></small>

                                    </div>
                                    <div style="height: 10px;"></div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">Banyak Project</label>
                                                <input type="number" class="form-control project_about" name="project_about" placeholder="Project..." value="{{ isset($about) ? $about->project_about ?? '' : '' }}">
                                                <small class="error_project_about text-danger"></small>

                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">Banyak Customers</label>
                                                <input type="number" class="form-control customers_about" name="customers_about" placeholder="Customers..." value="{{ isset($about) ? $about->customers_about ?? '' : '' }}">
                                                <small class="error_customers_about text-danger"></small>

                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">Banyak Pencapaian</label>
                                                <input type="number" class="form-control awards_about" name="awards_about" placeholder="Awards..." value="{{ isset($about) ? $about->awards_about ?? '' : '' }}">
                                                <small class="error_awards_about text-danger"></small>

                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">Banyak Team</label>
                                                <input type="number" class="form-control team_about" name="team_about" placeholder="Awards..." value="{{ isset($about) ? $about->team_about ?? '' : '' }}">
                                                <small class="error_team_about text-danger"></small>

                                            </div>
                                        </div>
                                    </div>
                                    <div style="height: 10px;"></div>
                                    <div class="form-group">
                                        <label for="">Gambar Team</label>
                                        <div class="input-teamdetail_about"></div>
                                        @php
                                        if(isset($about)){
                                        $getDetailAbout = $about->teamdetail_about;
                                        $jsonDetailAbout = json_decode($getDetailAbout, true);

                                        $outputDetailAbout = '
                                        <div class="row">
                                            ';
                                            foreach ($jsonDetailAbout as $key => $value) {
                                            $url_gambar_team = asset('upload/about/team/' . $value);
                                            $outputDetailAbout .= '
                                            <div class="col-lg-3">
                                                <div class="text-center p-3" style="border: 1px solid #61677A; position: relative;">
                                                    <a href="#" class="py-2 shadow-sm bg-danger text-white delete-gambar-team" data-id="'.$about->id.'" style="border-radius: 50%; padding: 1px 14px; border: 1px solid #F31559; position: absolute; top: 0; right: 0;" data-gambar_type="'.$value.'" data-type="team">
                                                        <i class="fas fa-times text-white fa-1x"></i>
                                                    </a>
                                                    <a class="photoviewer" href="'. asset('upload/about/team/'.$value). '" data-gallery="photoviewer" data-title="'.$value.'">
                                                        <img src="'. asset('upload/about/team/'.$value). '" alt="" style="height: 150px; width: 100%;">
                                                    </a>
                                                </div>
                                            </div>
                                            ';
                                            }
                                            $outputDetailAbout .= '
                                        </div>';
                                        }
                                        @endphp
                                        @if (isset($about))
                                        <div id="load-teamdetail_about" style="min-height: 200px; overflow-y: scroll;">
                                            {!! $outputDetailAbout !!}
                                        </div>
                                        @endif
                                        <small class="error_teamdetail_about text-danger"></small>

                                    </div>
                                    <div style="height: 10px;"></div>
                                    <div class="form-group">
                                        <label for="">Gambar Sponsor</label>
                                        <div class="input-gambarsponsor_about"></div>

                                        @php
                                        if(isset($about)){
                                        $getDetailAbout = $about->gambarsponsor_about;
                                        $jsonDetailAbout = json_decode($getDetailAbout, true);

                                        $outputDetailAbout = '
                                        <div class="row">
                                            ';
                                            foreach ($jsonDetailAbout as $key => $value) {
                                            $url_gambar_team = asset('upload/about/sponsor/' . $value);
                                            $outputDetailAbout .= '
                                            <div class="col-lg-3">
                                                <div class="text-center p-3" style="border: 1px solid #61677A; position: relative;">
                                                    <a href="#" class="py-2 shadow-sm bg-danger text-white delete-gambar-team" data-id="'.$about->id.'" style="border-radius: 50%; padding: 1px 14px; border: 1px solid #F31559; position: absolute; top: 0; right: 0;" data-gambar_type="'.$value.'" data-type="sponsor">
                                                        <i class="fas fa-times text-white fa-1x"></i>
                                                    </a>
                                                    <a class="photoviewer" href="'. asset('upload/about/sponsor/'.$value). '" data-gallery="photoviewer" data-title="'.$value.'">
                                                        <img src="'. asset('upload/about/sponsor/'.$value). '" alt="" style="height: 150px; width: 100%;">
                                                    </a>
                                                </div>
                                            </div>
                                            ';
                                            }
                                            $outputDetailAbout .= '
                                        </div>';
                                        }
                                        @endphp

                                        @if (isset($about))
                                        <div id="load-gambarsponsor_about" style="min-height: 200px; overflow-y: scroll;">
                                            {!! $outputDetailAbout !!}
                                        </div>
                                        @endif
                                        <small class="error_gambarsponsor_about text-danger"></small>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i data-feather="x"></i>
                                    Close</button>
                                <button type="submit" class="btn btn-primary"><i data-feather="send"></i>
                                    Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@include('admin.about.script')
@endpush