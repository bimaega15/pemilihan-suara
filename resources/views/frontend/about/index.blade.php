@extends('layouts.user')

@section('title','About Page')

@section('content')
@php
use Carbon\Carbon;
@endphp

<!-- ========================
       page title 
    =========================== -->
<section class="page-title page-title-layout1 text-center bg-overlay bg-overlay-gradient bg-parallax">
    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/page-titles/1.jpg" alt="background">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 offset-xl-3">
                <h1 class="pagetitle__heading">Tentang Kami</h1>
                <p class="pagetitle__desc">Partai Amanat Nasional (disingkat: PAN) adalah sebuah partai politik di
                    Indonesia. Asas partai ini adalah Akhlak Politik Berlandaskan Agama yang Membawa Rahmat bagi
                    Sekalian Alam</p>
                <div class="d-flex justify-content-center align-items-center flex-wrap">
                    <a href="{{ url('tps') }}" class="btn btn__primary mx-3">Lihat TPS</a>
                    <a class="video__btn video__btn-rounded video__btn-white popup-video mx-3" href="https://www.youtube.com/watch?v=QunJfj8tMb4">
                        <div class="video__player">
                            <i class="fa fa-play"></i>
                        </div>
                        <span class="video__btn-title color-white">Video Kami</span>
                    </a>
                </div>
                <nav>
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About</li>
                    </ol>
                </nav>
            </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->


<!-- ========================
      About Layout 1
    =========================== -->
<section class="about-layout1">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="heading mb-30">
                    <div class="d-flex align-items-center mb-20">
                        <div class="divider divider-primary mr-30"></div>
                        <h2 class="heading__subtitle mb-0">Tugas dan fungsi partai PAN </h2>
                    </div>
                    <h3 class="heading__title mb-40">
                        Apa saja kegiatan partai politik
                    </h3>
                </div><!-- /heading -->
                <div class="position-relative offset-xl-1">
                    <i class="icon-quote"></i>
                    <p class="mb-40">
                        Penyerap, penghimpun, dan penyalur aspirasi politik masyarakat dalam merumuskan dan menetapkan
                        kebijakan negara; Partisipasi politik warga negara Indonesia; dan. Rekrutmen politik dalam
                        proses pengisian jabatan politik melalui mekanisme demokrasi dengan memperhatikan kesetaraan dan
                        keadilan gender.
                    </p>
                    <ul class="list-items list-items-layout2 list-unstyled d-flex flex-wrap list-horizontal mb-50">
                        <li>Memperjuangkan kepentingan</li>
                        <li>Aspirasi</li>
                        <li>Nilai-nilai masyarakat</li>
                        <li>Perlindungan</li>
                        <li>Rasa aman</li>
                        <li>Lain-lain</li>
                    </ul>
                    <div class="text-left">
                        <img src="{{ asset('upload/assets/3916.jpg') }}" alt="map-indonesia" height="350px">
                    </div>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-5 offset-lg-1">
                <div class="about__img mb-40">
                    <img src="{{ asset('upload/about/gambar/'.$about->gambar_about) }}" alt="about">
                    <blockquote class="blockquote d-flex align-items-end mb-0">
                        <div class="blockquote__avatar">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/1.png" alt="thumb">
                        </div>
                        <div class="blockquote__content">
                            <h4 class="blockquote__title mb-0">
                                Kelahiran Partai Amanat Nasional (PAN) dibidani oleh
                                Majelis Amanat Rakyat (MARA), salah satu organ gerakan reformasi pada era pemerintahan
                                Soeharto, partai ini adalah partai
                                berbasis muhammadiyah.
                            </h4>
                        </div><!-- /.blockquote__content -->
                    </blockquote><!-- /.blockquote -->
                </div><!-- /.about-img -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.About Layout 1 -->

<!-- ======================
    History Timeline
    ========================= -->
<section class="history-timeline pb-0">
    <div class="history-timeline-bg">
        <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/backgrounds/1.jpg" alt="background"></div>
    </div>
    <div class="container">
        <div class="row heading mb-50">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="d-flex align-items-center mb-20">
                    <div class="divider divider-primary mr-30"></div>
                    <h2 class="heading__subtitle mb-0">Sejarah Partai PAN</h2>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <h3 class="heading__title color-white">Salah satu Partai Politik PAN terluas di Indonesia</h3>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
    <div class="position-relative">
        <div class="timeline-bar">
            <div class="container d-flex">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
            </div><!-- /.container -->
        </div><!-- /.timeline-bar -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="timeline-carousel-wrapper mb-70">
                        <div class="slick-carousel carousel-arrows-light" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "arrows": true, "dots": false, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 1}}, {"breakpoint": 768, "settings": {"slidesToShow": 1}}, {"breakpoint": 570, "settings": {"slidesToShow": 1}}]}'>
                            <div class="carousel-block">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <!-- timeline Item #1 -->
                                        <div class="timeline-item row align-items-end">
                                            <div class="timeline__img col-sm-6">
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/1.jpg" alt="timeline">
                                            </div>
                                            <div class="timeline__content col-sm-6">
                                                <p class="timeline__desc">Partai PAN (Partai Amanat Nasional) didirikan
                                                    pada 23 Agustus 1998 oleh sekelompok tokoh nasional yang terlibat
                                                    dalam gerakan reformasi.
                                                </p>
                                                <h4 class="timeline__year mb-0">1998</h4>
                                            </div>
                                        </div><!-- /.timeline-item -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <!-- timeline Item #2 -->
                                        <div class="timeline-item row align-items-end">
                                            <div class="timeline__img col-sm-6">
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/2.jpg" alt="timeline">
                                            </div>
                                            <div class="timeline__content col-sm-6">
                                                <p class="timeline__desc">
                                                    Partai PAN didirikan oleh 50 tokoh nasional, termasuk Amien Rais,
                                                    Faisal Basri M. A., Hatta Rajasa, Goenawan Mohammad, Rizal Ramli,
                                                    dan lainnya. Pengesahan pendirian PAN dilakukan pada tanggal 27
                                                    Agustus 2003 oleh Departemen Kehakiman dan Hak Asasi Manusia.
                                                </p>
                                                <h4 class="timeline__year mb-0">2003</h4>
                                            </div>
                                        </div><!-- /.timeline-item -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <!-- timeline Item #3 -->
                                        <div class="timeline-item row">
                                            <div class="timeline__content col-sm-6">
                                                <h4 class="timeline__year">2004</h4>
                                                <p class="timeline__desc">
                                                    Pemilu 2004, partai PAN mencatat perolehan suara sebesar 7.255.331
                                                    suara, dengan persentase 6,41%, dan meningkatkan jumlah kursi di DPR
                                                    menjadi 53.
                                                </p>
                                            </div>
                                            <div class="timeline__img col-sm-6">
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/3.jpg" alt="timeline">
                                            </div>
                                        </div><!-- /.timeline-item -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <!-- timeline Item #4 -->
                                        <div class="timeline-item row">
                                            <div class="timeline__content col-sm-6">
                                                <h4 class="timeline__year">2009</h4>
                                                <p class="timeline__desc">
                                                    partai PAN mengalami penurunan perolehan suara menjadi 6.254.580
                                                    suara (6,01%) dan memperoleh 46 kursi di DPR.
                                                </p>
                                            </div>
                                            <div class="timeline__img col-sm-6">
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/4.jpg" alt="timeline">
                                            </div>
                                        </div><!-- /.timeline-item -->
                                    </div><!-- /.col-lg-6 -->
                                </div><!-- /.row -->
                            </div><!-- /.carousel-block -->
                            <div class="carousel-block">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <!-- timeline Item #1 -->
                                        <div class="timeline-item row">
                                            <div class="timeline__content col-sm-6">
                                                <h4 class="timeline__year">2014</h4>
                                                <p class="timeline__desc">
                                                    Partai PAN berhasil meningkatkan perolehan
                                                    suara menjadi 9.481.621 (7,59%) dan memperoleh 49 kursi di DPR
                                                </p>
                                            </div>
                                            <div class="timeline__img col-sm-6">
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/3.jpg" alt="timeline">
                                            </div>
                                        </div><!-- /.timeline-item -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <!-- timeline Item #2 -->
                                        <div class="timeline-item row">
                                            <div class="timeline__content col-sm-6">
                                                <h4 class="timeline__year">2019</h4>
                                                <p class="timeline__desc">
                                                    PAN meraih 9.572.623 suara (6,84%) dan mengamankan 44 kursi di DPR.
                                                    Dari data tersebut, terlihat fluktuasi dalam perolehan suara dan
                                                    jumlah kursi PAN dari satu Pemilu ke Pemilu berikutnya
                                                </p>
                                            </div>
                                            <div class="timeline__img col-sm-6">
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/4.jpg" alt="timeline">
                                            </div>
                                        </div><!-- /.timeline-item -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <!-- timeline Item #3 -->
                                        <div class="timeline-item row align-items-end">
                                            <div class="timeline__img col-sm-6">
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/1.jpg" alt="timeline">
                                            </div>
                                            <div class="timeline__content col-sm-6">
                                                <p class="timeline__desc">
                                                    Amien Rais menghadiri pertemuan MARA di Hotel
                                                    Borobudur yang membahas situasi politik terkini. Dalam pertemuan
                                                    tersebut, diputuskan untuk mempersiapkan pendirian partai politik.
                                                </p>
                                                <h4 class="timeline__year mb-0">1998</h4>
                                            </div>
                                        </div><!-- /.timeline-item -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <!-- timeline Item #4 -->
                                        <div class="timeline-item row align-items-end">
                                            <div class="timeline__img col-sm-6">
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/2.jpg" alt="timeline">
                                            </div>
                                            <div class="timeline__content col-sm-6">
                                                <p class="timeline__desc">
                                                    Pengesahan pendirian PAN dilakukan pada tanggal 27 Agustus 2003 oleh
                                                    Departemen Kehakiman dan Hak Asasi Manusia
                                                </p>
                                                <h4 class="timeline__year mb-0">2003</h4>
                                            </div>
                                        </div><!-- /.timeline-item -->
                                    </div><!-- /.col-lg-6 -->
                                </div><!-- /.row -->
                            </div><!-- /.carousel-block -->
                        </div><!-- /.carousel -->
                    </div>
                </div><!-- /.col-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 d-flex flex-column justify-content-between">
                <div class="row row-no-gutter read-note">
                    <div class="col-sm-4">
                        <div class="rating mb-10">
                            <i class="fas fa-star color-primary"></i>
                            <i class="fas fa-star color-primary"></i>
                            <i class="fas fa-star color-primary"></i>
                            <i class="fas fa-star color-primary"></i>
                            <i class="fas fa-star color-primary"></i>
                        </div>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-sm-8">
                        <p class="read-note__text color-white">
                            <span class="font-weight-bold text-underlined">95% Suara</span>
                            berdasarkan 750+ ulasan dan 20.000 suara dari berbagai TPS
                        </p>
                    </div><!-- /.col-lg-8 -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <p class="mb-30 font-weight-bold sub__desc">
                            Partai politik berfungsi sebagai salah satu sarana sosialisasi politik, untuk dapat menjadi
                            pemenang didalam Pemilihan Umum (Pemilu)
                        </p>
                        <a href="{{ url('/tps') }}" class="btn btn__primary btn__bordered btn__icon mb-30">
                            <span>Lihat TPS</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-12 col-md-6">
                        <ul class="list-items list-unstyled mb-30">
                            <li>20.000 TPS</li>
                            <li>Memperjuangkan kepentingan</li>
                            <li>Aspirasi</li>
                            <li>Nilai-nilai masyarakat</li>
                        </ul>
                    </div><!-- /.col-sm-6 -->
                </div><!-- /.row -->
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <img src="{{ asset('upload/assets/pan.jpg') }}" alt="pan" height="500px" width="100%">
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.History Timeline -->

<!-- ======================
    Testimonials 
    ========================= -->
<section class="testimonials pb-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="{{ asset('frontend/SmartData') }}/assets/images/backgrounds/map.png" alt="map">
                <!-- Testimonial #1 -->
                <div class="testimonial-box">
                    <div class="testimonial__thumb">
                        <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/1.png" alt="author thumb">
                        <span class="pulsing-animation pulsing-animation-1"></span>
                        <span class="pulsing-animation pulsing-animation-2"></span>
                        <span class="pulsing-animation pulsing-animation-3"></span>
                    </div><!-- /.testimonial-thumb -->
                    <div class="testimonial__panel">
                        <div class="testimonial__desc">
                            Sebagai gerakan nasional, untuk penyaluran aspirasi masyarakat dalam menetapkan kebijakan
                            negara, serta turut berperan dalam pengisian jabatan politik.
                        </div>
                    </div><!-- /.testimonial-panel -->
                </div><!-- /. testimonial-box -->
                <!-- Testimonial #2 -->
                <div class="testimonial-box">
                    <div class="testimonial__thumb">
                        <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/2.png" alt="author thumb">
                        <span class="pulsing-animation pulsing-animation-1"></span>
                        <span class="pulsing-animation pulsing-animation-2"></span>
                        <span class="pulsing-animation pulsing-animation-3"></span>
                    </div><!-- /.testimonial-thumb -->
                    <div class="testimonial__panel">
                        <div class="testimonial__desc">
                            Sebagai gerakan nasional, untuk penyaluran aspirasi masyarakat dalam menetapkan kebijakan
                            negara, serta turut berperan dalam pengisian jabatan politik.
                        </div>
                    </div><!-- /.testimonial-panel -->
                </div><!-- /. testimonial-box -->
                <!-- Testimonial #3 -->
                <div class="testimonial-box">
                    <div class="testimonial__thumb">
                        <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/3.png" alt="author thumb">
                        <span class="pulsing-animation pulsing-animation-1"></span>
                        <span class="pulsing-animation pulsing-animation-2"></span>
                        <span class="pulsing-animation pulsing-animation-3"></span>
                    </div><!-- /.testimonial-thumb -->
                    <div class="testimonial__panel">
                        <div class="testimonial__desc">
                            Sebagai gerakan nasional, untuk penyaluran aspirasi masyarakat dalam menetapkan kebijakan
                            negara, serta turut berperan dalam pengisian jabatan politik.
                        </div>
                    </div><!-- /.testimonial-panel -->
                </div><!-- /. testimonial-box -->
                <!-- Testimonial #4 -->
                <div class="testimonial-box testimonial-hover-left">
                    <div class="testimonial__thumb">
                        <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/4.png" alt="author thumb">
                        <span class="pulsing-animation pulsing-animation-1"></span>
                        <span class="pulsing-animation pulsing-animation-2"></span>
                        <span class="pulsing-animation pulsing-animation-3"></span>
                    </div><!-- /.testimonial-thumb -->
                    <div class="testimonial__panel">
                        <div class="testimonial__desc">
                            Sebagai gerakan nasional, untuk penyaluran aspirasi masyarakat dalam menetapkan kebijakan
                            negara, serta turut berperan dalam pengisian jabatan politik.
                        </div>
                    </div><!-- /.testimonial-panel -->
                </div><!-- /. testimonial-box -->
                <!-- Testimonial #5 -->
                <div class="testimonial-box testimonial-hover-left">
                    <div class="testimonial__thumb">
                        <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/5.png" alt="author thumb">
                        <span class="pulsing-animation pulsing-animation-1"></span>
                        <span class="pulsing-animation pulsing-animation-2"></span>
                        <span class="pulsing-animation pulsing-animation-3"></span>
                    </div><!-- /.testimonial-thumb -->
                    <div class="testimonial__panel">
                        <div class="testimonial__desc">
                            Sebagai gerakan nasional, untuk penyaluran aspirasi masyarakat dalam menetapkan kebijakan
                            negara, serta turut berperan dalam pengisian jabatan politik.
                        </div>
                    </div><!-- /.testimonial-panel -->
                </div><!-- /. testimonial-box -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
    <div class="pb-100">
        <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/backgrounds/2.jpg" alt="background"></div>
        <div class="container">
            <div class="cta d-flex align-items-center">
                <div class="cta__item d-flex align-items-center">
                    <div class="cta__icon">
                        <i class="icon-programmer"></i>
                    </div><!-- /.cta__icon -->
                    <div class="cta__content">
                        <h4 class="cta__title">Pemilu</h4>
                        <p class="cta__desc mb-0">
                            Pemilu memiliki arti penting sebagai salah satu prosedur utama dalam demokrasi.
                        </p>
                    </div><!-- /.cta__content -->
                </div><!-- /.cta__item -->
                <div class="or-seperator">or</div>
                <div class="cta__item d-flex align-items-center">
                    <div class="cta__content text-right">
                        <h4 class="cta__title">Kedaulatan Rakyat</h4>
                        <p class="cta__desc mb-0">
                            kedaulatan rakyat hanya bisa dikelola secara optimal melalui lembaga perwakilan.
                        </p>
                    </div><!-- /.cta__content -->
                    <div class="cta__icon">
                        <i class="icon-developer"></i>
                    </div><!-- /.cta__icon -->
                </div><!-- /.cta__item -->
            </div><!-- /.cta -->
            <p class="text__link text-center mt-40 mb-0">
                Daftar List Tempat Penampungan Suara (TPS)
                <a href="{{ url('/tps') }}" class="btn btn__link btn__secondary btn__icon px-0">
                    <span>Lihat TPS </span> <i class="icon-arrow-right"></i>
                </a>
            </p>
        </div><!-- /.container -->
    </div>
</section><!-- /.testimonials -->

<!-- =========================
       Banner layout 5
      =========================== -->
<section class="banner-layout5 banner-layout5-sticky bg-parallax pt-130 pb-0">
    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/banners/9.jpg" alt="background"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5 d-flex flex-column justify-content-between pb-80">
                <div class="heading heading-light mb-50 sticky-top">
                    <div class="divider divider-white"></div>
                    <h3 class="heading__title mb-30">
                        Menyampaikan suara masyarakat dalam menetapkan kebijakan negara, dan. Rekrutmen politik dalam
                        proses pengisian jabatan politik
                    </h3>
                </div><!-- /.heading -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contact-info">
                            <div class="contact__icon"><i class="icon-map-marker"></i></div>
                            <ul class="contact__list list-unstyled">
                                <li>{{ $konfigurasi->alamat_konfigurasi }}</li>
                            </ul>
                        </div><!-- /.contact-item-->
                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-6">
                        <div class="contact-item">
                            <div class="contact__icon"><i class="icon-mail"></i></div>
                            <ul class="contact__list list-unstyled">
                                <li><a href="mailto:{{$konfigurasi->email_konfigurasi}}">Email: {{$konfigurasi->email_konfigurasi}}</a></li>
                                <li><a href="tel:{{$konfigurasi->nohp_konfigurasi}}">Phone: {{$konfigurasi->nohp_konfigurasi}}</a></li>
                            </ul>
                        </div><!-- /.contact-item-->
                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-6"></div><!-- /.col-sm-6 -->
                </div><!-- /.row-->
            </div><!-- /.col-xl-6 -->
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 offset-xl-1">
                <div class="banner__content">
                    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/backgrounds/3.png" alt="background"></div>
                    <div class="scroll__icon"><i class="icon-mouse"></i></div>
                    <div class="row heading heading-light">
                        <div class="col-sm-6">
                            <h3 class="heading__title mb-30">20.000 Tps diseluruh indonesia</h3>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6">
                            <p class="heading__desc mb-20">Siap siaga untuk pengabdian kemasyarakat, bersedia untuk turut berperan dalam kesuksesan pemilihan pejabat sebagai kader partai politik.</p>
                            <p class="heading__desc mb-20">
                                Sebagai salah satu partai terbaik di indonesia, untuk membangun negeri dan memberantas korupsi
                            </p>
                            <a href="{{ url('/tps') }}" class="btn btn__white btn__bordered btn__xl btn__icon">
                                <span>Lihat TPS</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                    <div class="row counters-wrapper counters-light mt-70">
                        <!-- counter item #1 -->
                        <div class="col-sm-6">
                            <div class="counter-item">
                                <h4 class="counter">{{ number_format($about->project_about,0) }}</h4>
                                <p class="counter__desc">Project</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-6 -->
                        <!-- counter item #2 -->
                        <div class="col-sm-6">
                            <div class="counter-item">
                                <h4 class="counter">{{ number_format($about->customers_about,0) }}</h4>
                                <p class="counter__desc">Pelanggan</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-6 -->
                        <!-- counter item #3 -->
                        <div class="col-sm-6">
                            <div class="counter-item">
                                <h4 class="counter">{{ number_format($about->team_about,0) }}</h4>
                                <p class="counter__desc">Tim</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="counter-item">
                                <h4 class="counter">{{ number_format($about->awards_about,0) }}</h4>
                                <p class="counter__desc">Pencapaian</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                </div><!-- /.banner__content -->
                <div class="semi-banner bg-gray">
                    <div class="row row-no-gutter">
                        <div class="col-sm-6">
                            <div class="semi-banner__content">
                                <div class="heading">
                                    <h3 class="heading__title mb-30">Tujuan Partai PAN</h3>
                                    <p class="heading_desc mb-30">
                                        PAN memperjuangkan agar Indonesia tersucikan dari pelanggaran hak-hak asasi manusia dan memberi jaminan agar tidak terjadi penghancuran terhadap sumber daya perekonomian rakyat. PAN memandang bahwa hal esensial dalam berbangsa dan bernegara adalah mewujudkan kedaulatan rakyat.
                                    </p>
                                    <p class="heading_desc mb-30">
                                        Pengabdian kami, untuk negara kesatuan republik indonesia yang kami cintai ini.
                                    </p>
                                </div><!-- /.heading -->
                                <img src="{{ asset('frontend/SmartData') }}/assets/images/about/singnture.png" alt="singnture">
                            </div>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6 d-none d-md-block">
                            <img src="{{ asset('upload/assets/pan.jpg') }}" alt="pan" class="w-100">
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                </div><!-- /.semi-banner -->
                <div class="semi-banner bg-gray">
                    <div class="row row-no-gutter">
                        <div class="col-sm-6">
                            <div class="cta-banner bg-primary">
                                <div class="cta__icon color-white"><i class="icon-developer"></i></div>
                                <h4 class="cta__title color-white">Sejak 1998</h4>
                                <p class="cta__desc color-white mb-25">Partai Amanat Nasional (PAN) adalah salah satu partai politik di Indonesia yang didirikan pada tanggal 23 Mei 1998. Partai ini memiliki sejarah yang panjang dan berperan penting dalam perkembangan politik di Indonesia..</p>
                                <a href="{{ url('/tps') }}" class="btn btn__link btn__white btn__icon px-0">
                                    <span>Lihat TPS</span> <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="semi-banner__content pb-0">
                                <div class="heading">
                                    <h3 class="heading__title mb-30">Kita memiliki dedikasi dalam pengalaman bekerja</h3>
                                </div><!-- /.heading -->
                                <h4 class="banner__subheading">Berantas Korupsi</h4>
                                <p class="heading_desc">Sejak berdiri, selalu mengusung isu pemberantasan korupsi. Membingkai hukum untuk kepastian berusaha.</p>
                                <h4 class="banner__subheading">Ekonomi berbingkai kepastian hukum</h4>
                                <p class="heading_desc">Mulfachri mengatakan perkembangan perekonomian harus ditopang bingkai kepastian hukum. Dan itu bisa dicapai dengan proses legislasi yang berkualitas.</p>
                                <h4 class="banner__subheading">Delapan Pandangan Hatta</h4>
                                <p class="heading_desc">Flatform dan arahan Pan menghadapi Pemilu 2014 juga bisa dibaca dari pidato politik Hatta Rajasa saat bertemu temu kader</p>
                            </div>
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                </div><!-- /.semi-banner -->
                <section class="awards bg-secondary">
                    <div class="row heading heading-light mb-60">
                        <div class="col-sm-6">
                            <h3 class="heading__title">Beberapa Lembaga yang support kami</h3>
                        </div><!-- /col-lg-5 -->
                        <div class="col-sm-6">
                            <p class="heading__desc">Percayalah pada organisasi yang kami bangun, kami dengan tulus hati akan mementingkan kepentingan rakyat, dan bertujuan untuk menjadikan indonesia menjadi lebih bersih, aman, dan sejahtera.
                            </p>
                        </div><!-- /.col-lg-5 -->
                    </div><!-- /.row -->
                    <div class="row awards-wrapper">
                        <div class="col-sm-12">
                            <div class="awards-carousel-wrapper">
                                <div class="slick-carousel" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "arrows": false, "dots": true,"autoplay": true, "autoplaySpeed": 4000, "infinite": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 768, "settings": {"slidesToShow": 1}}, {"breakpoint": 570, "settings": {"slidesToShow": 1}}]}'>
                                    @php
                                    $parseSponsor = json_decode($about->gambarsponsor_about, true);
                                    @endphp
                                    @foreach ($parseSponsor as $item)
                                    <!-- fancybox item #1 -->
                                    <div class="fancybox-item">
                                        <div class="fancybox__icon-img">
                                            <img src="{{ asset('upload/about/sponsor/'.$item) }}" alt="icon">
                                        </div><!-- /.fancybox__icon-img -->
                                        <div class="fancybox__content">
                                            <h4 class="fancybox__title"></h4>
                                            <p class="fancybox__desc">
                                            </p>
                                        </div><!-- /.fancybox-content -->
                                        <div style="height: 25px;"></div>
                                    </div><!-- /.fancybox-item -->
                                    @endforeach

                                </div><!-- /.carousel  -->
                            </div><!-- /.awards-carousel-wrapper -->
                        </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                </section>
            </div><!-- /.col-xl-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Banner layout 5 -->

<!-- ======================
      Blog Grid
    ========================= -->
<section class="blog-grid pb-50">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-40">
                    <h2 class="heading__subtitle">Gallery</h2>
                    <h3 class="heading__title">Gambar Dokumentasi</h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            @foreach ($gallery as $item)
            <!-- Blog Item #1 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="{{url('/gallery')}}">
                            <img src="{{ asset('upload/gallery/'.$item->gambar_gallery) }}" alt="" style="width: 100%; height: 250px;">
                        </a>
                    </div><!-- /.blog-img -->
                    <div class="post__content">
                        <div class="post__meta d-flex flex-wrap">
                            <span class="post__meta-date">{{ Carbon::parse($item->waktu_gallery)->format('d F Y H:i') }}</span>
                        </div>
                        <h4 class="post__title"><a href="#">{{ $item->judul_gallery }}</a>
                        </h4>
                        <p class="post__desc">
                            {{$item->keterangan_gallery}}
                        </p>
                    </div><!-- /.blog-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            @endforeach

        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog Grid -->
@endsection