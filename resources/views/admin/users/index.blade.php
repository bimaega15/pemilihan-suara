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
                        <i data-feather="user"></i> <strong>Data users</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="true">Admin</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="kepala-tab" data-bs-toggle="tab" data-bs-target="#kepala" type="button" role="tab" aria-controls="kepala" aria-selected="false">Caleg</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="koordinator-tab" data-bs-toggle="tab" data-bs-target="#koordinator" type="button" role="tab" aria-controls="koordinator" aria-selected="false">Koordinator</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="relawan-tab" data-bs-toggle="tab" data-bs-target="#relawan" type="button" role="tab" aria-controls="relawan" aria-selected="false">Pendukung</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                                        @include('admin.users.admin.index')
                                    </div>
                                    <div class="tab-pane fade" id="kepala" role="tabpanel" aria-labelledby="kepala-tab">
                                        @include('admin.users.kepala.index')

                                    </div>
                                    <div class="tab-pane fade" id="koordinator" role="tabpanel" aria-labelledby="koordinator-tab">
                                        @include('admin.users.koordinator.index')
                                    </div>
                                    <div class="tab-pane fade" id="relawan" role="tabpanel" aria-labelledby="relawan-tab">
                                        @include('admin.users.relawan.index')
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
@include('admin.users.model')
@endsection

@push('js')
@include('admin.users.script')
@endpush