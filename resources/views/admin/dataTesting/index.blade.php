@extends('layouts.admin')
@section('title')
Data Testing
@endsection
@section('content')
<?php
$isCreate = session()->get('userAcess.is_create');
?>

@push('css')
<style>
    /* end only demo styles */
    .radio-custom {
        opacity: 0;
        position: absolute;
    }

    .radio-custom,
    .radio-custom-label {
        display: inline-block;
        vertical-align: middle;
        margin: 5px;
        cursor: pointer;
    }

    .radio-custom-label {
        position: relative;
    }

    .radio-custom+.radio-custom-label:before {
        content: '';
        background: #fff;
        border: 2px solid #9DB2BF;
        display: inline-block;
        vertical-align: middle;
        width: 25px;
        height: 25px;
        /* padding: 2px; */
        margin-right: 10px;
        text-align: center;
    }

    .radio-custom+.radio-custom-label:before {
        border-radius: 50%;
    }

    .radio-custom:checked+.radio-custom-label:before {
        content: "\f00c";
        font-family: 'FontAwesome';
        color: #526D82;
    }
</style>
@endpush
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i data-feather="settings"></i> <strong>Data Testing</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="count_kuisioner" class="count_kuisioner" value="{{ $count_kuisioner }}">
                                <div id="userDiagnosa">
                                    <h4>Pengisian Biodata</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Tanggal</label>
                                                <input type="text" name="tanggal_user_diagnosa" class="form-control datePicker tanggal_user_diagnosa" placeholder="Tanggal...">
                                                <small class="text-danger error_tanggal_user_diagnosa"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Judul</label>
                                                <input type="text" name="judul_user_diagnosa" class="form-control judul_user_diagnosa" placeholder="Judul...">
                                                <small class="text-danger error_judul_user_diagnosa"></small>

                                            </div>
                                        </div>
                                    </div>
                                    <div style="height: 10px;"></div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Nama</label>
                                                <input type="text" name="nama_user_diagnosa" class="form-control nama_user_diagnosa" placeholder="Nama...">
                                                <small class="text-danger error_nama_user_diagnosa"></small>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Jenis Kelamin</label> <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input jenis_kelamin_user_diagnosa" type="radio" name="jenis_kelamin_user_diagnosa" id="jenis_kelamin_user_diagnosaL" value="L">
                                                    <label class="form-check-label" for="jenis_kelamin_user_diagnosaL">Laki-laki</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input jenis_kelamin_user_diagnosa" type="radio" name="jenis_kelamin_user_diagnosa" id="jenis_kelamin_user_diagnosaP" value="P">
                                                    <label class="form-check-label" for="jenis_kelamin_user_diagnosaP">Perempuan</label>
                                                </div><br>
                                                <small class="text-danger error_jenis_kelamin_user_diagnosa"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="height: 10px;"></div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">No. HP</label>
                                                <input type="text" name="nomor_hp_user_diagnosa" class="form-control nomor_hp_user_diagnosa" placeholder="No. HP...">
                                                <small class="text-danger error_nomor_hp_user_diagnosa"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Email</label> <br>
                                                <input type="text" name="email_user_diagnosa" class="form-control email_user_diagnosa" placeholder="Email...">
                                                <small class="text-danger error_email_user_diagnosa"></small>

                                            </div>
                                        </div>
                                    </div>
                                    <div style="height: 10px;"></div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Alamat</label>
                                                <textarea class="form-control alamat_user_diagnosa" name="alamat_user_diagnosa" rows="4" placeholder="Alamat..."></textarea>
                                                <small class="text-danger error_alamat_user_diagnosa"></small>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Usia</label> <br>
                                                <input type="number" name="usia_user_diagnosa" class="form-control usia_user_diagnosa" placeholder="Usia...">
                                                <small class="text-danger error_usia_user_diagnosa"></small>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary shadow-sm px-5 btn-kuisioner"><i class="fa-sharp fa-solid fa-arrow-right font-weight-bold"></i></button>
                                    </div>
                                </div>
                                <div id="content" class="d-none"></div>
                                <div id="link_content" class="d-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@include('admin.dataTesting.script')
@endpush