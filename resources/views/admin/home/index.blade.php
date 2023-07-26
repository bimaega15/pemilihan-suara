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
                                        <h5 class="card-title">User</h5>
                                        <h2>{{ $users }}</h2>
                                        <p>
                                            <i class="fas fa-user fa-2x"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Role</h5>
                                        <h2>{{ $role }}</h2>
                                        <i class="fa-solid fa-user-gear fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Kuisioner</h5>
                                        <h2>{{ $kuisioner }}</h2>
                                        <p><i class="fa-solid fa-table fa-2x"></i></p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Jawaban Kuisioner</h5>
                                        <h2>{{ $jawabanKuisioner }}</h2>
                                        <p><i class="fa-solid fa-table fa-2x"></i></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Range Bobot</h5>
                                        <h2>{{ $rangeBobot }}</h2>
                                        <p>
                                            <i class="fa-solid fa-book fa-2x"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card stat-widget shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Diagnosa User</h5>
                                        <h2>{{ $userDiagnosa }}</h2>
                                        <p>
                                            <i class="fa-solid fa-user-tie fa-2x"></i>
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