@extends('layouts.admin')
@section('title')
Form About
@endsection
@section('content')
@push('css')
<style>
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
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
                                <i data-feather="settings"></i> <strong>Form about</strong>
                            </div>
                            <div>
                                {{ Breadcrumbs::render('formAbout') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <a href="{{ url('/admin/about') }}" class="btn btn-primary btn-add">
                                        <i data-feather="arrow-left"></i> kembali
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan_about" class="form-control keterangan_about" id="editor" placeholder="Keterangan"></textarea>
                                    <small class="error_keterangan_about text-danger"></small>
                                </div>
                                <div style="height: 10px;"></div>
                                <div class="form-group">
                                    <label for="">Gambar</label>
                                    <input type="file" class="form-control gambar_about" name="gambar_about">
                                    <small class="error_gambar_about text-danger"></small>

                                </div>
                                <div style="height: 10px;"></div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Banyak Project</label>
                                            <input type="number" class="form-control project_about" name="project_about" placeholder="Project...">
                                            <small class="error_project_about text-danger"></small>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Banyak Customers</label>
                                            <input type="number" class="form-control customers_about" name="customers_about" placeholder="Customers...">
                                            <small class="error_customers_about text-danger"></small>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Banyak Pencapaian</label>
                                            <input type="number" class="form-control awards_about" name="awards_about" placeholder="Awards...">
                                            <small class="error_awards_about text-danger"></small>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Banyak Team</label>
                                            <input type="number" class="form-control team_about" name="team_about" placeholder="Awards...">
                                            <small class="error_team_about text-danger"></small>

                                        </div>
                                    </div>
                                </div>
                                <div style="height: 10px;"></div>
                                <div class="form-group">
                                    <label for="">Gambar Team</label>
                                    <input type="file" class="form-control teamdetail_about" name="teamdetail_about">
                                    <small class="error_teamdetail_about text-danger"></small>

                                </div>
                                <div style="height: 10px;"></div>
                                <div class="form-group">
                                    <label for="">Gambar Sponsor</label>
                                    <input type="file" class="form-control gambarsponsor_about" name="gambarsponsor_about">
                                    <small class="error_gambarsponsor_about text-danger"></small>

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
@include('admin.about.script')
@endpush