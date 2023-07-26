@extends('layouts.admin')
@section('title')
Hasil
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
                        <i data-feather="settings"></i> <strong>Data hasil</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">
                                                    Tanggal
                                                </th>
                                                <th scope="col">
                                                    Judul
                                                </th>
                                                <th scope="col">
                                                    Nama
                                                </th>
                                                <th scope="col">
                                                    Jenis Kelamin
                                                </th>
                                                <th scope="col">
                                                    No. HP
                                                </th>
                                                <th scope="col">
                                                    Email
                                                </th>
                                                <th scope="col">
                                                    Alamat
                                                </th>
                                                <th scope="col">
                                                    Usia
                                                </th>
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
@include('admin.hasil.script')
@endpush