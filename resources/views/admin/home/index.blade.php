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
                        <strong>Dashboard</strong>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="semua-suara-tab" data-bs-toggle="tab" data-bs-target="#semua-suara" type="button" role="tab" aria-controls="semua-suara" aria-selected="true">Keseluruhan Suara</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tiap-suara-tab" data-bs-toggle="tab" data-bs-target="#tiap-suara" type="button" role="tab" aria-controls="tiap-suara" aria-selected="false">Suara / TPS</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="semua-suara" role="tabpanel" aria-labelledby="semua-suara-tab">
                                @include('admin.home.partial.semuaSuara')
                            </div>
                            <div class="tab-pane fade" id="tiap-suara" role="tabpanel" aria-labelledby="tiap-suara-tab">
                                @include('admin.home.partial.suaraPerWilayah')
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@include('admin.home.script')
@include('admin.home.scriptAll')
@endpush