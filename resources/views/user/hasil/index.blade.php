@extends('layouts.user')

@section('title')
Hasil Page
@endsection

@section('content')
<section class="page-title page-title-layout5 text-center">
    <div class="bg-img"><img src="{{ asset('frontend/medcity') }}/assets/images/backgrounds/6.jpg" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">Hasil Konsultasi</h1>
                <nav>
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Konsultasi</li>
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
                    <h2 class="heading__subtitle">Hasil Diagnosa</h2>
                    <h3 class="heading__title">Riwayat Diagnosa Anda:</h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-book"></i> <strong>Data Hasil</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">
                                                Tanggal
                                            </th>
                                            <th scope="col">
                                                Judul
                                            </th>
                                            <th scope="col">
                                                Nama
                                            </th>
                                            <th scope="col">
                                                Jenis Kelamin
                                            </th>
                                            <th scope="col">
                                                No. HP
                                            </th>
                                            <th scope="col">
                                                Email
                                            </th>
                                            <th scope="col">
                                                Alamat
                                            </th>
                                            <th scope="col">
                                                Usia
                                            </th>
                                            <th scope="col">
                                                <div class="text-center">
                                                    Actions
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

@push('js')
@include('user.hasil.script')
@endpush
@endsection