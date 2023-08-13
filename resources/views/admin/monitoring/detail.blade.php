@extends('layouts.admin')
@section('title')
Users
@endsection
@section('content')
@push('css')
<style>
    .photoviewer-modal {
        background-color: transparent;
        border: none;
        border-radius: 0;
        box-shadow: 0 0 6px 2px rgba(0, 0, 0, .3);
    }

    .photoviewer-header .photoviewer-toolbar {
        background-color: rgba(0, 0, 0, .5);
    }

    .photoviewer-stage {
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, .85);
        border: none;
    }

    .photoviewer-footer .photoviewer-toolbar {
        background-color: rgba(0, 0, 0, .5);
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .photoviewer-header,
    .photoviewer-footer {
        border-radius: 0;
        pointer-events: none;
    }

    .photoviewer-title {
        color: #ccc;
    }

    .photoviewer-button {
        color: #ccc;
        pointer-events: auto;
    }

    .photoviewer-header .photoviewer-button:hover,
    .photoviewer-footer .photoviewer-button:hover {
        color: white;
    }
</style>
@endpush

<?php
$isCreate = session()->get('userAcess.is_create');
?>
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i data-feather="user"></i> <strong>Data TPS Detail</strong>
                            </div>
                            <div>
                                {{ Breadcrumbs::render('monitoringDetail') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row mb-1 mt-1">
                                    <div class="col-lg-6">
                                        <table>
                                            <tr>
                                                <td>Provinsi</td>
                                                <td class="px-4">:</td>
                                                <td>{{ $tps->provinces->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kabupaten</td>
                                                <td class="px-4">:</td>
                                                <td>{{ $tps->regencies->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kecamatan</td>
                                                <td class="px-4">:</td>
                                                <td>{{ $tps->districts->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kelurahan</td>
                                                <td class="px-4">:</td>
                                                <td>{{ $tps->villages->name }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tr>
                                                <td>Nama TPS</td>
                                                <td class="px-4">:</td>
                                                <td>
                                                    {{ $tps->nama_tps }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td class="px-4">:</td>
                                                <td>
                                                    {{ $tps->alamat_tps }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Minimal TPS</td>
                                                <td class="px-4">:</td>
                                                <td>
                                                    {{ $tps->minimal_tps }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Minimal Pendukung</td>
                                                <td class="px-4">:</td>
                                                <td>
                                                    {{ $tps->pendukung_tps }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Laki-laki</td>
                                                <td class="px-4">:</td>
                                                <td><span id="totallk_tps">{{ $tps->totallk_tps }}</span></td>
                                            </tr>
                                            <tr>
                                                <td>Total Perempuan</td>
                                                <td class="px-4">:</td>
                                                <td><span id="totalpr_tps">{{ $tps->totalpr_tps }}</span></td>
                                            </tr>
                                            <tr>
                                                <td>Total Keseluruhan</td>
                                                <td class="px-4">:</td>
                                                <td><span id="totalsemua_tps">{{ $tps->totalsemua_tps }}</span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">
                                                    Nik
                                                </th>
                                                <th scope="col">
                                                    Nama
                                                </th>
                                                <th scope="col">
                                                    Gender
                                                </th>
                                                <th scope="col">
                                                    Email
                                                </th>
                                                <th scope="col">
                                                    No. HP
                                                </th>
                                                <th scope="col">Alamat</th>
                                                <th scope="col" style="width: 100px;">
                                                    Gambar
                                                </th>
                                                <th scope="col" style="width: 100px;">
                                                    Bukti Coblos
                                                </th>
                                                <th scope="col">
                                                    <div class="text-center">
                                                        Approve
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
@include('admin.monitoring.scriptDetail')
@endpush