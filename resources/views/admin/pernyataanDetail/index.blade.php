@extends('layouts.admin')
@section('title')
Kuisioner Jawaban Detail
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
                        <div class="d-flex justify-content-between">
                            <div>
                                <i data-feather="settings"></i> <strong>Data Kuisioner Jawaban Detail</strong>
                            </div>
                            <div>
                                {{ Breadcrumbs::render('pernyataanDetail', $id) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/admin/pernyataanDetail/'.$id.'/store') }}" method="post" class="form-submit">
                            <input type="hidden" name="count_kuisioner" class="count_kuisioner" value="{{ $count_kuisioner }}">
                            <input type="hidden" name="pernyataan_id" class="pernyataan_id" value="{{ $id }}">
                            @foreach ($kuisioner as $item)
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="mb-2">{{ $item->soal_kuisioner }}</label>
                                        <select name="kuisioner_id" class="form-control kuisioner_id" id="" data-kuisioner_id="{{ $item->id }}">
                                            <option value="">-- Pernyataan --</option>
                                            @foreach ($jawabanKuisioner as $value)
                                            <option value="{{$value->id}}" data-bobot_jawaban_kuisioner="{{ $value->bobot_jawaban_kuisioner }}">{{$value->nama_jawaban_kuisioner}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="mb-2">Bobot</label>
                                        <input data-kuisioner_id="{{ $item->id }}" type="number" step="any" class="form-control bobot-jawaban-kuisioner" placeholder="Bobot..." readonly>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary form-control btn-submit">
                                        <i class="fa-solid fa-paper-plane"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@include('admin.pernyataanDetail.script')
@endpush