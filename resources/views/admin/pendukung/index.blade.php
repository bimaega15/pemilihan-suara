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
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i data-feather="settings"></i> <strong>Data Pendukung</strong>
                            </div>
                            <div class="d-flex align-items-center">
                                {{ Breadcrumbs::render('pendukung') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if ($isCreate != null)
                                <div class="mb-3">
                                    <a data-bs-toggle="modal" data-bs-target="#modalForm" href="{{ url('/admin/pendukung/create') }}" class="btn btn-primary btn-add">
                                        <i data-feather="plus"></i> Tambah
                                    </a>
                                </div>
                                @endif
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-end">
                                            <div class="me-2">
                                                <div class="d-flex align-items-center">
                                                    <div style="width: 15px; height: 15px;" class="bg-secondary rounded me-1">
                                                    </div>
                                                    <div>
                                                        Belum ada tindakan
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="me-2">
                                                <div class="d-flex align-items-center">
                                                    <div style="width: 15px; height: 15px;" class="bg-success rounded me-1">
                                                    </div>
                                                    <div>
                                                        Verifikasi
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="me-2">
                                                <div class="d-flex align-items-center">
                                                    <div style="width: 15px; height: 15px;" class="bg-danger rounded me-1">
                                                    </div>
                                                    <div>
                                                        Ditolak
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <div style="width: 15px; height: 15px;" class="bg-info rounded me-1">
                                                    </div>
                                                    <div>
                                                        Menunggu Verifikasi
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
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
@include('admin.pendukung.model')
@endsection

@push('js')
@include('admin.pendukung.script')
@endpush