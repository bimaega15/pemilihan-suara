@extends('layouts.admin')
@section('title')
Home
@endsection
@section('content')
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i data-feather="home"></i> <strong>Dashboard</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Admin</h5>
                                        <h2>{{ $admin }}</h2>
                                        <p>
                                            <i class="fas fa-user-lock fa-2x"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Koordinator</h5>
                                        <h2>{{ $koordinator }}</h2>
                                        <i class="fas fa-user-tie fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">caleg</h5>
                                        <h2>{{ $kepalaKepegawaian }}</h2>
                                        <p>
                                            <i class="fas fa-user-secret fa-2x"></i>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Relawan</h5>
                                        <h2>{{ $relawan }}</h2>
                                        <p>
                                            <i class="fas fa-user-friends fa-2x"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Jabatan</h5>
                                        <h2>{{ $jabatan }}</h2>
                                        <p>
                                            <i class="fas fa-house-user fa-2x"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Banner</h5>
                                        <h2>{{ $banner }}</h2>
                                        <p>
                                            <i class="fa-solid fa-user-tie fa-2x"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Gallery</h5>
                                        <h2>{{ $gallery }}</h2>
                                        <p>
                                            <i class="fas fa-image fa-2x"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Pengumuman</h5>
                                        <h2>{{ $pengumuman }}</h2>
                                        <p>
                                            <i class="fas fa-volume-down fa-2x"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Tps</h5>
                                        <h2>{{ $tps }}</h2>
                                        <p>
                                            <i class="fas fa-envelope-open-text fa-2x"></i>
                                        </p>
                                    </div>
                                </div>
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
@include('admin.home.script')
@endpush