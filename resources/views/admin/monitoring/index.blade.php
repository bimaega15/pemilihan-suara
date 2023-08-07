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
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@include('admin.monitoring.script')
@endpush