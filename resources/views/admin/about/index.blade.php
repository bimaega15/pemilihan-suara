@extends('layouts.admin')
@section('title')
About
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
                        <i data-feather="settings"></i> <strong>Data about</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if ($isCreate != null)
                                <div class="mb-3">
                                    <a href="{{ url('/admin/about/create') }}" class="btn btn-primary btn-add">
                                        <i data-feather="plus"></i> Tambah
                                    </a>
                                </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">
                                                    Project
                                                </th>
                                                <th scope="col">
                                                    Customers
                                                </th>
                                                <th scope="col">
                                                    Team
                                                </th>
                                                <th scope="col">
                                                    Awards
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
@include('admin.about.script')
@endpush