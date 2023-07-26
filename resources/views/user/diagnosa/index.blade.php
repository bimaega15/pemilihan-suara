@extends('layouts.user')

@section('title')
Diagnosa Page
@endsection

@section('content')
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
        font-family: 'fontawesome';
        color: #526D82;
    }
</style>
@endpush
<!-- ========================
                                       page title
                                    =========================== -->
<section class="page-title page-title-layout5 text-center">
    <div class="bg-img"><img src="{{ asset('frontend/medcity') }}/assets/images/backgrounds/6.jpg" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">Konsultasi Diagnosa</h1>
                <nav>
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Diagnosa</li>
                    </ol>
                </nav>
            </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->
<section class="services-layout1 services-carousel">
    <div class="bg-img"><img src="{{ asset('frontend/medcity/') }}/assets/images/backgrounds/4.png" alt="background">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-60">
                    <h2 class="heading__subtitle">Form Diagnosa</h2>
                    <h3 class="heading__title">Solusi Diagnosa Menggunakan Naive Bayes</h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-pencil-alt"></i> <strong>Pengisian Form</strong>
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
                                        <button type="button" class="btn btn-secondary shadow-sm px-5 btn-kuisioner">
                                            <i class="fas fa-arrow-right font-weight-bold"></i></button>
                                    </div>
                                </div>
                                <div id="content" class="d-none"></div>
                                <div id="link_content" class="d-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

@push('js')
@include('user.diagnosa.script')
@endpush
@endsection