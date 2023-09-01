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
                        @if ($nama_roles == 'koordinator')
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="suara-koordinator-tab" data-bs-toggle="tab" data-bs-target="#suara-koordinator" type="button" role="tab" aria-controls="suara-koordinator" aria-selected="true">Suara TPS</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="koordinator-pendukung-tab" data-bs-toggle="tab" data-bs-target="#koordinator-pendukung" type="button" role="tab" aria-controls="koordinator-pendukung" aria-selected="false">Data Pendukung</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="suara-koordinator" role="tabpanel" aria-labelledby="suara-koordinator-tab">
                                <div id="output_suara_koordinator">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="koordinator-pendukung" role="tabpanel" aria-labelledby="koordinator-pendukung-tab">
                                @include('admin.home.partial.dataPendukungCo')
                            </div>
                        </div>
                        @else
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="semua-suara-tab" data-bs-toggle="tab" data-bs-target="#semua-suara" type="button" role="tab" aria-controls="semua-suara" aria-selected="true">Keseluruhan Suara</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tiap-suara-tab" data-bs-toggle="tab" data-bs-target="#tiap-suara" type="button" role="tab" aria-controls="tiap-suara" aria-selected="false">Suara Per TPS</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="data-pendukung-tab" data-bs-toggle="tab" data-bs-target="#data-pendukung" type="button" role="tab" aria-controls="data-pendukung" aria-selected="false">Data Pendukung</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="semua-suara" role="tabpanel" aria-labelledby="semua-suara-tab">
                                @include('admin.home.partial.semuaSuara')
                            </div>
                            <div class="tab-pane fade" id="tiap-suara" role="tabpanel" aria-labelledby="tiap-suara-tab">
                                @include('admin.home.partial.suaraPerWilayah')
                            </div>
                            <div class="tab-pane fade" id="data-pendukung" role="tabpanel" aria-labelledby="data-pendukung-tab">
                                @include('admin.home.partial.dataPendukung')
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if ($nama_roles == 'koordinator')
@include('admin.home.scriptKoordinator')
@include('admin.home.scriptPendukungKoordinator')

@else
@include('admin.home.script')
@include('admin.home.scriptAll')
@include('admin.home.scriptPendukungAdmin')
@endif
@endpush