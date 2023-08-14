@extends('layouts.user')

@section('title','Tps Page')

@section('content')

@push('css')
<style>
    #filter_progres select {
        width: 100%;
    }

    #output_dukungan .card {
        margin-bottom: 10px;
    }

    #output_progres .card {
        margin-bottom: 10px;
    }

    #output_grafik .card {
        margin-bottom: 10px;
    }

    .page-item.disabled .page-link {
        width: 110px;
    }

    .pagination li a {
        line-height: 30px;
    }

    .progress-bar {
        height: 20px;
    }

    footer br {
        display: none;
    }
</style>
@endpush
<!-- ========================
       page title 
    =========================== -->
<section class="page-title page-title-layout16 text-center bg-overlay bg-overlay-gradient bg-parallax">
    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/page-titles/12.jpg" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading mb-10">Periksa Status Pendaftaran</h1>
                <nav>
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Status Pendaftaran</li>
                    </ol>
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->

<section class="blog-grid pb-50">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="heading text-center mb-40">
                <h2 class="heading__subtitle">Menu untuk periksa status pendaftaran koordinator</h2>
                <h3 class="heading__title">Check Status Regis</h3>
            </div><!-- /.heading -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

    <div class="container">
        <div class="row mb-2">
            <div class="col-lg-6 mx-auto">
                <div class="card login-box-container">
                    <div class="card-header bg-light">
                        <span class="text-dark">
                            <i class="fas fa-table"></i> Periksa Pendaftaran
                        </span>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('register.checkStatus.postCheckStatus') }}" class="form-submit">
                            @csrf
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="">Periksa Status Pendaftaran</label>
                                    <input type="text" class="form-control identitas" id="floatingInput" placeholder="Masukan Username / NIK / Email..." name="identitas">
                                    <small class="error_identitas text-danger"></small>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info m-b-xs btn-submit w-100 btn-submit">
                                    Submit
                                </button>
                            </div>
                        </form>
                        <div style="height: 30px;"></div>
                        <div class="text-center">
                            <p>Already account ? <a href="{{ url('/login') }}">Login account</a></p>
                            <p>Not registered? <a href="{{ url('/register') }}">Create an account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 20px;"></div>

</section>

@endsection

@push('js')
@include('auth.scriptStatus')
@endpush