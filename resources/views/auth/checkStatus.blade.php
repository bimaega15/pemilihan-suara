@extends('layouts.auth')

@section('title', 'Check Status Pendaftaran Page')


@section('content')

<?php
$getKonfigurasi = Check::getKonfigurasi();

?>
<div class='loader'>
    <div class='spinner-grow text-primary' role='status'>
        <span class='sr-only'>Loading...</span>
    </div>
</div>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-12 col-lg-6">
            <div class="card login-box-container">
                <div class="card-body">
                    <div class="authent-logo">
                        <img src="{{ asset('upload/konfigurasi/' . $getKonfigurasi->logo_konfigurasi) }}" alt="{{ $getKonfigurasi->logo_konfigurasi }}" height="80">
                    </div>
                    <div class="authent-text">
                        <p>{{ $getKonfigurasi->nama_konfigurasi }}</p>
                        <p>Periksa Status Pendaftaran.</p>
                    </div>

                    <div style="height: 30px;"></div>
                    <form method="post" action="{{ route('register.checkStatus.postCheckStatus') }}" class="form-submit">
                        @csrf
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control identitas" id="floatingInput" placeholder="Username / NIK / Email..." name="identitas">
                                <small class="error_identitas text-danger"></small>
                                <label for="floatingInput">Username / NIK / Email</label>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-info m-b-xs btn-submit">
                                Submit
                            </button>
                        </div>
                    </form>
                    <div class="authent-reg">
                        <p>Already account ? <a href="{{ url('/login') }}">Login account</a></p>
                        <p>Not registered? <a href="{{ url('/register') }}">Create an account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('auth.partial.model')

@push('js')
@include('auth.scriptStatus')
@endpush
@endsection