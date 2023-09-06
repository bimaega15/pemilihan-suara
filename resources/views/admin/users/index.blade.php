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
                                    @foreach ($role as $index => $item)
                                    @php
                                    $getText = strtolower($item->nama_roles);
                                    $getText = explode(' ', $getText);
                                    $getText = implode('-', $getText);
                                    @endphp
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{$index == 0 ? 'active' : ''}}" id="{{$getText}}-tab" data-bs-toggle="tab" data-bs-target="#{{$getText}}" type="button" role="tab" aria-controls="{{$getText}}" aria-selected="true">{{$item->nama_roles}}</button>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="myTabContent">

                                    @foreach ($role as $index => $item)
                                    @php
                                    $getText = strtolower($item->nama_roles);
                                    $getText = explode(' ', $getText);
                                    $getText = implode('-', $getText);
                                    @endphp
                                    <div class="tab-pane fade show {{ $index == 0 ? 'active' : ''}}" id="{{$getText}}" role="tabpanel" aria-labelledby="{{$getText}}-tab">
                                        @include('admin.users.'.$getText.'.index')
                                    </div>
                                    @endforeach
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