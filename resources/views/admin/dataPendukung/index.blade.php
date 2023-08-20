@extends('layouts.admin')
@section('title')
Pendukung
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
                        <i data-feather="settings"></i> <strong>Data Pendukung</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-primary btn-search-pendukung">
                                    <i class="fas fa-user-tag"></i> Cari Pendukung
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <table>
                                    <tr>
                                        <td>Nama Tps</td>
                                        <td class="px-3">:</td>
                                        <td><span id="header_nama_tps"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td class="px-3">:</td>
                                        <td><span id="header_alamat_tps"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Kelurahan Tps</td>
                                        <td class="px-3">:</td>
                                        <td><span id="header_kelurahan_tps"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table>
                                    <tr>
                                        <td>Minimal Pendukung</td>
                                        <td class="px-3">:</td>
                                        <td><span id="header_pendukung_tps"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Status Pencapaian</td>
                                        <td class="px-3">:</td>
                                        <td><span id="header_status_pendukung_tps"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Detail Status</td>
                                        <td class="px-3">:</td>
                                        <td><span id="header_detail_pendukung_tps"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th scope="col">No</th>
                                                <th>Username</th>
                                                <th>Nik</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No. Hp</th>
                                                <th>J.K</th>
                                                <th style="width: 80px;">Gambar</th>
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

@include('admin.dataPendukung.model')
@endsection

@push('js')
@include('admin.dataPendukung.script')
@endpush