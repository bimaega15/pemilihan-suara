@extends('layouts.admin')
@section('title')
Monitoring
@endsection
@section('content')
<?php
$isCreate = session()->get('userAcess.is_create');
?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i data-feather="monitor"></i> <strong>Data monitoring</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-1">
                                    <h5>Koordinator & Pendukung</h5>
                                    <hr>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="dataTableKoordinatorPendukung">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th>Nama Tps</th>
                                                <th>Alamat</th>
                                                <th>Capaian</th>
                                                <th style="width: 120px;">Total</th>
                                                <th style="width: 200px;">Koordinator</th>
                                                <th style="width: 300px;">Daerah</th>
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
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        <i data-feather="monitor"></i> <strong>
                            Informasi Target Pemenangan, total dukungan, tps dan koordinator
                        </strong>
                    </div>
                    <div class="card-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="card-list-tab" data-bs-toggle="tab" data-bs-target="#card-list" type="button" role="tab" aria-controls="card-list" aria-selected="true">Card List</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="progres-tab" data-bs-toggle="tab" data-bs-target="#progres" type="button" role="tab" aria-controls="progres" aria-selected="false">Progres</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="grafik-tab" data-bs-toggle="tab" data-bs-target="#grafik" type="button" role="tab" aria-controls="grafik" aria-selected="false">Grafik</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="card-list" role="tabpanel" aria-labelledby="card-list-tab">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@include('admin.monitoring.script')
@include('admin.monitoring.scriptProgres')
@include('admin.monitoring.scriptGrafik')
@endpush