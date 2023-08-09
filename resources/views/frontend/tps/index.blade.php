@extends('layouts.user')

@section('title','Tps Page')

@section('content')

@push('css')
<style>
    #filter_progres select {
        width: 100%;
    }

    #output_dukungan .card {
        margin-bottom: 10px;
    }

    #output_progres .card {
        margin-bottom: 10px;
    }

    #output_grafik .card {
        margin-bottom: 10px;
    }

    .page-item.disabled .page-link {
        width: 110px;
    }

    .pagination li a {
        line-height: 30px;
    }

    .progress-bar {
        height: 20px;
    }

    footer br {
        display: none;
    }
</style>
@endpush
<!-- ========================
       page title 
    =========================== -->
<section class="page-title page-title-layout16 text-center bg-overlay bg-overlay-gradient bg-parallax">
    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/page-titles/12.jpg" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading mb-10">Tempat Pemilihan Suara</h1>
                <nav>
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">TPS</li>
                    </ol>
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->

<section class="blog-grid pb-50">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="heading text-center mb-40">
                <h2 class="heading__subtitle">Daftar List Tempat Pemilihan Suara</h2>
                <h3 class="heading__title">TPS</h3>
            </div><!-- /.heading -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th>Nama Tps</th>
                                <th>Alamat</th>
                                <th>Capaian</th>
                                <th style="width: 120px;">Total</th>
                                <th style="width: 200px;">Koordinator</th>
                                <th style="width: 300px;">Daerah</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="card-tab" data-toggle="tab" data-target="#card" type="button" role="tab" aria-controls="card" aria-selected="true">Card List</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="progres-tab" data-toggle="tab" data-target="#progres" type="button" role="tab" aria-controls="progres" aria-selected="false">Progres</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="grafik-tab" data-toggle="tab" data-target="#grafik" type="button" role="tab" aria-controls="grafik" aria-selected="false">Grafik</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="card" role="tabpanel" aria-labelledby="card-tab">
                        @include('admin.monitoring.partial.cardList')
                    </div>
                    <div class="tab-pane fade" id="progres" role="tabpanel" aria-labelledby="progres-tab">
                        @include('admin.monitoring.partial.progres')
                    </div>
                    <div class="tab-pane fade" id="grafik" role="tabpanel" aria-labelledby="grafik-tab">
                        @include('admin.monitoring.partial.grafik')
                    </div>
                </div>

            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@include('frontend.tps.partial.script')
@include('admin.monitoring.script')
@include('admin.monitoring.scriptProgres')
@include('admin.monitoring.scriptGrafik')
@endpush