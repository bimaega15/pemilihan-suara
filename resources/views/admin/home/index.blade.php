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
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="#" class="btn btn-light btn-reset-wilayah me-1">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Provinsi</label>
                                    <select class="form-control provinces_id" name="provinces_id">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                    <small class="error_provinces_id text-danger"></small>

                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Kabupaten</label>
                                    <select class="form-control regencies_id" name="regencies_id">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                    <small class="error_regencies_id text-danger"></small>

                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Kecamatan</label>
                                    <select class="form-control districts_id" name="districts_id">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                    <small class="error_districts_id text-danger"></small>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Kelurahan</label>
                                    <select class="form-control villages_id" name="villages_id">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                    <small class="error_villages_id text-danger"></small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3" id="output_grafik">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div style="width: 100%;" class="card shadow">
                                        <div class="card-header">
                                            <h5><i class="fa-solid fa-house-user"></i> Tps Pemersatu Suara</h5>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="fa-solid fa-location-dot"></i> Alamat TPS Pemerstau Suara
                                            </h5>
                                            <hr>
                                            <canvas id="myChart" class="mb-4"></canvas>
                                            <div class="card shadow p-3">
                                                <div class="progress" style="height: 30px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;/*! height: 50px; */"> 75%
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <i class="fas fa-volume-down"></i> Target Pemenangan
                                                    </div>
                                                    <div>
                                                        <span>2.880 Suara</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <span><i class="fas fa-user"></i> Total dukungan: </span>
                                                <span>1000 Suara</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span><i class="fas fa-user-tie"></i> Total Koordinator: </span>
                                                <span>4 C.O</span>
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
    </div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@include('admin.home.script')
@endpush