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
                        <div class="row mb-4" id="filter_dukungan">
                            <div class="col-lg-12 mb-2">
                                <button type="button" class="btn btn-reset-dukungan btn-dark">
                                    <i class="fa-solid fa-rotate-right"></i> Reset
                                </button>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Provinsi</label>
                                    <select name="provinces_id" class="form-control provinces_id" id="">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Kabupaten</label>
                                    <select name="regencies_id" class="form-control regencies_id" id="">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Kecamatan</label>
                                    <select name="districts_id" class="form-control districts_id" id="">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Kelurahan</label>
                                    <select name="villages_id" class="form-control villages_id" id="">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="output_dukungan">
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        <i data-feather="monitor"></i> <strong>
                            Progress Pemenangan Suara
                        </strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4" id="filter_progres">
                            <div class="col-lg-12 mb-2">
                                <button type="button" class="btn btn-reset-progres btn-dark">
                                    <i class="fa-solid fa-rotate-right"></i> Reset
                                </button>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Provinsi</label>
                                    <select name="provinces_id" class="form-control provinces_id" id="">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Kabupaten</label>
                                    <select name="regencies_id" class="form-control regencies_id" id="">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Kecamatan</label>
                                    <select name="districts_id" class="form-control districts_id" id="">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Kelurahan</label>
                                    <select name="villages_id" class="form-control villages_id" id="">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="output_progres">

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
@include('admin.monitoring.scriptProgres')
@endpush