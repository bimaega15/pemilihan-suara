@extends('layouts.user')

@section('title', 'Contact Page')

@section('content')

<section class="page-title page-title-layout16 text-center bg-overlay bg-overlay-gradient bg-parallax">
    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/page-titles/12.jpg" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading mb-10">Kontak Kami</h1>
                <nav>
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kontak Kami</li>
                    </ol>
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->

<!-- ========================= 
            Google Map
    =========================  -->
<section class="google-map py-0">
    <div id="map" style="height: 600px;"></div>
</section><!-- /.GoogleMap -->

<!-- ==========================
        contact layout 1
    =========================== -->
<section class="contact-layout1 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 mb-3">
                <form class="contact-form" method="post" action="assets/php/contact.php" id="contactForm">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="contact-panel__title">
                                My Contact
                            </h4>
                        </div>
                        <div class="col-sm-12">
                            <span class="text-dark">
                                {!! @$about->keterangan_about !!}

                            </span>
                        </div>
                    </div><!-- /.row -->
                </form>
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-4 offset-lg-1 mb-3">
                <div class="contact-info d-flex flex-column justify-content-between">
                    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/contact/1.jpg" alt="banner"></div>
                    <div>
                        <h4 class="contact-info__title">20.000 Tps diseluruh indonesia</h4>
                        <p class="contact-info__desc">Siap siaga untuk pengabdian kemasyarakat, bersedia untuk turut berperan dalam kesuksesan pemilihan pejabat sebagai kader partai politik.</p>
                        <p class="contact-info__desc">Sebagai salah satu partai terbaik di indonesia, untuk membangun negeri dan memberantas korupsi.
                        </p>
                    </div>
                    <a href="{{ url('/tps') }}" class="btn btn__white btn__bordered btn__icon">
                        <span>Lihat TPS</span>
                        <i class="icon-arrow-right"></i>
                    </a>
                </div><!-- /.contact-info -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.contact layout 1 -->

<!-- ==========================
       Contact layout 2
    ============================ -->
<section class="contact-layout2 pt-0 pb-80">
    <div class="container">
        <div class="row">
            <!-- Contact panel #1 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="contact-info-box">
                    <h4 class="contact__info-box-title">Alamat</h4>
                    <ul class="contact__info-list list-unstyled">
                        <li>Alamat: {{ $konfigurasi->alamat_konfigurasi}}</li>
                    </ul><!-- /.contact__info-list -->
                </div><!-- /.contact-info-box -->
            </div><!-- /.col-lg-4 -->
            <!-- Contact panel #2 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="contact-info-box">
                    <h4 class="contact__info-box-title">Kontak</h4>
                    <ul class="contact__info-list list-unstyled">
                        <li>Email: <a href="mailto:{{$konfigurasi->email_konfigurasi}}">
                                {{$konfigurasi->email_konfigurasi}}
                            </a>
                        </li>
                        <li>Phone: <a href="tel:{{$konfigurasi->nohp_konfigurasi}}">
                                {{$konfigurasi->nohp_konfigurasi}}
                            </a>
                        </li>
                    </ul><!-- /.contact__info-list -->
                </div><!-- /.contact-info-box -->
            </div><!-- /.col-lg-4 -->
            <!-- Contact panel #3 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="contact-info-box">
                    <h4 class="contact__info-box-title">Sosial Media</h4>
                    <ul class="contact__info-list list-unstyled">
                        <li>Facebook: <a href="{{$konfigurasi->facebook_konfigurasi}}">
                                <i class="fab fa-facebook"></i>
                            </a></li>
                        <li>Instagram: <a href="{{$konfigurasi->instagram_konfigurasi}}">
                                <i class="fab fa-instagram"></i>
                            </a></li>
                        <li>Facebook: <a href="{{$konfigurasi->facebook_konfigurasi}}">
                                <i class="fab fa-youtube"></i>
                            </a></li>
                    </ul><!-- /.contact__info-list -->
                </div><!-- /.contact-info-box -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Contact layout 2 -->

@endsection
@push('js')
@include('frontend.contact.partial.script')
@endpush