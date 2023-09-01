@extends('layouts.admin')
@section('title')
konfigurasi
@endsection
@section('content')
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
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i data-feather="settings"></i> <strong>Data konfigurasi</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/admin/konfigurasi') }}" method="post" class="form-submit">
                            <input type="hidden" name="id" class="id">
                            <input type="hidden" name="page" class="page">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary btn-submit">
                                            <i data-feather="send"></i> Submit
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control cominimal_konfigurasi" id="floatingInput" placeholder="Minimal Koordinator..." name="cominimal_konfigurasi">
                                        <small class="error_cominimal_konfigurasi text-danger"></small>
                                        <label for="floatingInput">Minimum Koordinator / TPS</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control volminimal_konfigurasi" id="floatingInput" placeholder="Minimal Pendukung" name="volminimal_konfigurasi">
                                        <small class="error_volminimal_konfigurasi text-danger"></small>
                                        <label for="floatingInput">Minimum Volunter</label>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 10px;"></div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control nama_konfigurasi" id="floatingInput" placeholder="Nama konfigurasi..." name="nama_konfigurasi">
                                        <small class="error_nama_konfigurasi text-danger"></small>
                                        <label for="floatingInput">Nama aplikasi</label>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 10px;"></div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-floating">
                                        <input type="number" class="form-control nohp_konfigurasi" id="floatingInput" placeholder="No. HP..." name="nohp_konfigurasi">
                                        <small class="error_nohp_konfigurasi text-danger"></small>
                                        <label for="floatingInput">No. Handphone</label>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 10px;"></div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-floating">
                                        <textarea class="form-control alamat_konfigurasi" id="floatingInput" placeholder="Alamat..." name="alamat_konfigurasi" style="height: 80px;"></textarea>
                                        <small class="error_alamat_konfigurasi text-danger"></small>
                                        <label for="floatingInput">Alamat</label>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 10px;"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control email_konfigurasi" id="floatingInput" placeholder="Email..." name="email_konfigurasi">
                                        <small class="error_email_konfigurasi text-danger"></small>
                                        <label for="floatingInput">Email</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control created_konfigurasi" id="floatingInput" placeholder="Created by..." name="created_konfigurasi">
                                        <small class="error_created_konfigurasi text-danger"></small>
                                        <label for="floatingInput">Created By</label>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 10px;"></div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="deskripsi_konfigurasi">Deskripsi aplikasi</label>
                                        <textarea class="form-control deskripsi_konfigurasi summernote" id="deskripsi_konfigurasi" placeholder="Deskripsi..." name="deskripsi_konfigurasi" style="height: 80px;"></textarea>
                                        <small class="error_deskripsi_konfigurasi text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 10px;"></div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Longitude</label>
                                        <input class="form-control longitude_konfigurasi" type="text" name="longitude_konfigurasi" placeholder="Longitude...">
                                        <span id="load_longitude_konfigurasi"></span>
                                        <small class="error_longitude_konfigurasi text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Latitude</label>
                                        <input class="form-control latitude_konfigurasi" type="text" name="latitude_konfigurasi" placeholder="Latitude...">
                                        <span id="load_latitude_konfigurasi"></span>
                                        <small class="error_latitude_konfigurasi text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 10px;"></div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="map-contact" style="width: 100%; height: 500px;"></div>
                                </div>
                            </div>

                            <div style="height: 10px;"></div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Logo aplikasi</label>
                                        <input class="form-control logo_konfigurasi" type="file" id="formFile" name="logo_konfigurasi">
                                        <span id="load_logo_konfigurasi"></span>
                                        <small class="error_logo_konfigurasi text-danger"></small>
                                    </div>
                                </div>
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
@include('admin.konfigurasi.script')
@endpush