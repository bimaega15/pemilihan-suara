@extends('layouts.user')


@section('title','Home Page')

@section('content')

@php
use Carbon\Carbon;
$getKonfigurasi = Check::getKonfigurasi();
@endphp
@push('css')
<style>
    .text-header {
        color: #ffffff;
    }

    @media (max-width: 460px) {
        .features-layout1 img {
            height: 300px !important;
        }

        #about ul {
            display: block !important;
        }
    }
</style>

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


<!-- ============================
        Slider
    ============================== -->
<section class="slider" id="home">
    <div class="slick-carousel carousel-arrows-light carousel-dots-light m-slides-0" data-slick='{"slidesToShow": 1, "arrows": true, "dots": true, "speed": 700,"fade": true,"cssEase": "linear"}'>
        @foreach ($banner as $item)
        <div class="slide-item align-v-h bg-overlay bg-overlay-gradient">
            <div class="bg-img"><img src="{{ asset('upload/banner/'.$item->gambar_banner) }}" alt="slide img"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                        <div class="slide__content">
                            <h3 class="slide__title">
                                {{$item->judul_banner}}
                            </h3>
                            <p class="slide__desc">
                                {{$item->keterangan_banner}}
                            </p>
                            <a href="{{ url('/tps') }}" class="btn btn__primary btn__icon mr-30">
                                <span>Dukung Sekarang</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.slide-content -->
                    </div><!-- /.col-xl-7 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.slide-item -->
        @endforeach
    </div><!-- /.carousel -->
</section>
<!-- /.slider -->

<!-- ========================
      About Layout 4
    =========================== -->
<section class="about-layout1" id="about">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="heading mb-30">
                    <div class="d-flex align-items-center mb-20">
                        <div class="divider divider-primary mr-30"></div>
                        <h1 class="heading__subtitle mb-0">ABOUT ME</h1>
                    </div>
                    <h4 class="heading__title mb-40">
                        Siapa sih Kang Asep Sholeh ?
                    </h4>
                </div><!-- /heading -->
                <div class="position-relative offset-xl-1">
                    <i class="icon-quote"></i>
                    <p class="mb-40">
                        {!! @$about->keterangan_about !!}
                    </p>

                    <a href="{{ asset('assets/PROFILE_KANG_ASEP_SHOLEH.pdf') }}" class="btn btn__primary btn__icon mr-30">
                        <span>Download Profile</span>
                        <i class="icon-arrow-right"></i>
                    </a>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-5 offset-lg-1">
                <div class="about__img mb-40">
                    <img src="{{ asset('upload/about/gambar/'. @$about->gambar_about) }}" alt="about">
                    <blockquote class="blockquote d-flex align-items-end mb-0">
                        <div class="blockquote__avatar">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/1.png" alt="thumb">
                        </div>
                        <!-- /.blockquote__content -->
                    </blockquote><!-- /.blockquote -->
                </div><!-- /.about-img -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.About Layout 4 -->

<section class="features-layout1 pb-0">
    <div class="features-bg">
        <div class="bg-img"><img src="{{ asset('frontend/SmartData/') }}/assets/images/backgrounds/14.jpg" alt="background"></div>
    </div>
    <div class="container">
        <div class="row heading heading-light mb-30">
            <div class="col-sm-12 col-md-12 col-lg-5">
                <div class="divider divider-primary mb-20"></div>
                <h3 class="heading__title">
                    Keuntungan Memilih KANG ASEP SHOLEH dibanding Kandidat Lainnya
                </h3>
                <ul class="list-items list-items-layout2 list-horizontal list-unstyled d-flex flex-wrap mt-40">
                    <li style="color: #ffffff;">Berbuat Sebelum Terpilih</li>
                    <li style="color: #ffffff;">Muda dan Mandiri</li>
                    <li style="color: #ffffff;">Dapat Memimpin</li>
                    <li style="color: #ffffff;">Karakter Tegas dan Sopan</li>
                    <li style="color: #ffffff;">Berpendidikan Tinggi</li>
                    <li style="color: #ffffff;">Bertanggung Jawab</li>
                    <li style="color: #ffffff;">Amanah dan Agamis</li>
                    <li style="color: #ffffff;">Pengusaha Muda</li>
                    <li style="color: #ffffff;">Kharismatik</li>
                </ul>
            </div><!-- /col-lg-5 -->
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-1">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="heading__desc" style="text-align: justify;">
                            <b>Memilih KANG ASEP SHOLEH</b> sama saja mendungkung orang yang akan benar-benar bekerja untuk masyarakat terkhusus wilayah Dapil 3 Kota Cirebon (Kelurahan Argasunya don Kalijaga). Alasannya untuk di kampanyekan :
                            menjadi anggota DPRD harus selesai dulu dengan personalnya terkhusus finansial, jika tidak selesai dengan urusan finansialnya maka banyak oknum Anggota DPRD setelah menjabat malah menghitung untung rugi don banyak yang berbicara balik modal.
                            Maka dari itu jika ingin memilih anggota DPRD harus yang sudah mapan dengan urusan finansialnya agar orientasi Anggota DPRD tidak salah kaprah.
                            Mereka tetap pada jalur tugas don tanggung jawab sebagai Wakil kita dalam menentukan kebijakan don pemberian bantuan. Tapi yang jelas <b>KANG ASEP SHOLEH</b> ini inshaa Allah akan membawa kemanfaatan kepada masyarakat don Tim yang berjuang dari awal.
                        </p>

                    </div><!-- /.col-sm-6 -->
                    <!-- /.col-sm-6 -->
                </div><!-- /.row -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row" style="height: 250px;">
            <!-- Feature item #1 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <!-- /.feature-item -->
            </div>
            <!-- /.col-lg-3 -->

        </div><!-- /.row -->
        <!-- /.row -->
    </div><!-- /.container -->
</section>
<!-- ========================
       Tim sukses
    =========================== -->
<section class="services-layout2 services-carousel pt-130 bg-gray" id="timSukses">
    <div class="container">
        <div class="row heading mb-40">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <div class="divider divider-primary mr-30"></div>
                    <h2 class="heading__subtitle mb-0">AKTIVITAS SOSIAL</h2>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-7">
                <h3 class="heading__title">Banyak Berbuat dalam Aktivitas Kegiatan Sosial</h3>
            </div><!-- /col-lg-5 -->
            <div class="col-sm-12 col-md-12 col-lg-5">
                <p class="heading__desc"><b>ASEP SHOLEH FAKHRUL INSAN </b> atau sering di sapa <b>KANG ASEP SHOLEH</b> Banyak bergerak dan berbuat dalam kegiatan sosial, meski beliau belum menjadi Anggota DPRD Kota Cirebon tapi kegiatan dia untuk
                    aktif dan berkontribusi sudah terlihat, apalagi jika <b>KANG ASEP SHOLEH</b> terpilih menjadi Anggota DPRD Kota Cirebon bisa dipastikan akan lebih masif dan didukung oleh kebijakan. </p>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="slick-carousel" data-slick='{"slidesToShow": 3, "slidesToScroll": 2, "arrows": true, "dots": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                    @if ($about != null)
                    @php
                    $parseSponsor = json_decode($about->teamdetail_about, true);
                    @endphp
                    @foreach ($parseSponsor as $item)
                    <!-- service item #1 -->
                    <div class="service-item">
                        <div class="service__content p-2">
                            <div class="service__icon mb-0">
                                <!-- <i class="icon-server"></i> -->
                            </div><!-- /.service__icon -->
                            <img src="{{ asset('upload/about/team/'.$item) }}" style="width: 100%;" height="300px;" alt="{{ $item }}">
                        </div><!-- /.service-content -->
                    </div><!-- /.service-item -->
                    @endforeach
                    @endif

                </div><!-- /.carousel -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Services Layout 2 -->


<!-- ======================
       Tim sukses
    ========================= -->
<!-- /.Features Layout 1 -->

<!-- =========================
       Banner layout 5
      =========================== -->
<div style="height: 100px;"></div>
<section class="banner-layout5 banner-layout5-sticky bg-parallax pt-130 pb-0">
    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/banners/9.jpg" alt="background"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5 d-flex flex-column justify-content-between pb-80">
                <div class="heading heading-light mb-50 sticky-top">
                    <div class="divider divider-white"></div>
                    <h3 class="heading__title mb-30">
                        Menyampaikan suara masyarakat terkhusus wilayah Dapil 3 Kota Cirebon (Kelurahan Argasunya dan Kalijaga)
                    </h3>
                </div><!-- /.heading -->
                <!-- /.row-->
            </div><!-- /.col-xl-6 -->
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 offset-xl-1">
                <div class="banner__content">
                    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/backgrounds/3.png" alt="background"></div>
                    <div class="scroll__icon"><i class="icon-mouse"></i></div>
                    <!-- /.row -->
                    <div class="row counters-wrapper counters-light mt-0">
                        <!-- counter item #1 -->

                        <div class="col-sm-3">
                            <div class="counter-item">
                                <h4 class="counter">{{ number_format($tps,0) }}</h4>
                                <p class="counter__desc">TPS</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-6 -->
                        <!-- counter item #2 -->
                        <div class="col-sm-3">
                            <div class="counter-item">
                                <h4 class="counter">{{ number_format($regencies,0) }}</h4>
                                <p class="counter__desc">Kabupaten</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-6 -->
                        <!-- counter item #3 -->
                        <div class="col-sm-3">
                            <div class="counter-item">
                                <h4 class="counter">{{ number_format($districts,0) }}</h4>
                                <p class="counter__desc">Kecamatan</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-3">
                            <div class="counter-item">
                                <h4 class="counter">{{ number_format($villages,0) }}</h4>
                                <p class="counter__desc">Kelurahan</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                </div><!-- /.banner__content -->
                <div class="semi-banner bg-gray">
                    <div class="row row-no-gutter">
                        <div class="col-sm-6">
                            <div class="semi-banner__content">
                                <div class="heading">
                                    <h3 class="heading__title mb-30">Pasti Ada HaraPAN</h3>
                                    <p class="heading_desc mb-30">
                                        KANG ASEP SHOLEH sekarangpun menjabat sebagai Sekretaris DPD Partai Amanat Nasional (PAN) dan memantapkan Maju menjadi Anggota DPRD dapil Ill Kota Cirebon. Bukan tanpa alasan KANG ASEP SHOLEH Maju menjadi Anggota DPRD Kota Cirebon, dengan modal di Organisasi dan keaktifan beliau dalam kegiatan sosial kemasyarakatan, KANG ASEP SHOLEH ingin lebih bisa membantu dengan scope yang luas seperti mewujudkan aspirasi masyarakat melalui produk kebijakan yang bisa dinilai lebih bermanfaat untuk masyarakat nantinya.
                                    </p>

                                </div><!-- /.heading -->

                            </div>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6 d-none d-md-block">
                            <img src="{{ asset('upload/assets/5.jpg') }}" alt="pan" class="w-100">
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                </div><!-- /.semi-banner -->
                <div class="semi-banner bg-gray">
                    <div class="row row-no-gutter">
                        <div class="col-sm-6">
                            <div class="cta-banner bg-primary">
                                <div class="cta__icon color-white"><i class="icon-developer"></i></div>
                                <h4 class="cta__title color-white">Kang ASEP SHOLEH</h4>
                                <p class="cta__desc color-white mb-25">"Yang penting bukan apakah kita menang atau kalah, Tuhan tidak mewajibkan manusia untuk menang sehingga kalah pun bukan dosa, yang penting adalah apakah seseorang berjuang (lktiar dan do'a) atau tak berjuang." </p>

                            </div>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="semi-banner__content pb-0">
                                <div class="heading">
                                    <h3 class="heading__title mb-30">Keuntungan Memilih KANG ASEP SHOLEH</h3>
                                </div><!-- /.heading -->
                                <h4 class="banner__subheading">Benar-Benar Bekerja</h4>
                                <p class="heading_desc">Yang akan benar-benar bekerja untuk masyarakat terkhusus wilayah Dapil 3 Kota Cirebon (Kelurahan Argasunya don Kalijaga)</p>
                                <h4 class="banner__subheading">Mapan dengan urusan finansialnya</h4>
                                <p class="heading_desc">Menjadi anggota DPRD harus selesai dulu dengan personalnya terkhusus finansial, jika tidak selesai dengan urusan finansialnya maka banyak oknum Anggota DPRD setelah menjabat malah menghitung untung rugi don banyak yang berbicara balik modal.</p>
                                <h4 class="banner__subheading">Tetap pada jalur Tugas dan Tanggung Jawab</h4>
                                <p class="heading_desc">Tetap pada jalur tugas don tanggung jawab sebagai Wakil kita dalam menentukan kebijakan don pemberian bantuan</p>
                            </div>
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                </div><!-- /.semi-banner -->

            </div><!-- /.col-xl-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
<!-- /.Banner layout 5 -->

<!-- ======================
      contact Grid
    ========================= -->

<!-- ======================
      contact Grid
    ========================= -->

<!-- /.contact Grid -->


<!-- ==========================
        contact layout 1
    =========================== -->
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
                        <h4 class="cta__title">Pendukung</h4>
                        <p class="cta__desc mb-0">
                            Berikan dukungan anda dengan menghubungi salah satu koordinator TPS kami.
                        </p>
                    </div><!-- /.cta__content -->
                </div><!-- /.cta__item -->
                <div class="or-seperator">or</div>
                <div class="cta__item d-flex align-items-center">
                    <div class="cta__content text-right">
                        <h4 class="cta__title">Koordiantor TPS</h4>
                        <p class="cta__desc mb-0">
                            Anda dapat menjadi Koordinator TPS dengan mengklik link daftar koordinator dibawah ini.
                        </p>
                    </div><!-- /.cta__content -->
                    <div class="cta__icon">
                        <i class="icon-developer"></i>
                    </div><!-- /.cta__icon -->
                </div><!-- /.cta__item -->
            </div><!-- /.cta -->
            <p class="text__link text-center mt-40 mb-0">

                <a href="{{ url('/register') }}" class="btn btn__link btn__secondary btn__icon px-0">
                    <span>Daftar Koordiantor TPS </span> <i class="icon-arrow-right"></i>
                </a>
            </p>
        </div><!-- /.container -->
    </div>
</section>
<section class="blog-grid pb-50" id="gallery">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-40">
                    <h2 class="heading__subtitle">Gallery</h2>
                    <h4 class="heading__title">Aktivitas Kami</h4>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div id="contentGallery" class="row">
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<section class="features-layout1 pb-0" id="statusPendaftaran">
    <div class="features-bg">
        <div class="bg-img"><img src="{{ asset('frontend/SmartData/') }}/assets/images/backgrounds/14.jpg" alt="background"></div>
    </div>
    <div class=" row">
        <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="heading text-center mb-40">

                <h3 class="heading__title" style="color: #ffffff;">Cek Status Pendaftaran</h3>
            </div><!-- /.heading -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

    <div class="container">
        <div class="row mb-2">
            <div class="col-lg-6 mx-auto">
                <div class="card login-box-container shadow">
                    <div class="card-header bg-light">
                        <span class="text-dark">
                            <i class="fas fa-table"></i> Cek Status Pendaftaran
                        </span>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('register.checkStatus.postCheckStatus') }}" class="form-submit">
                            @csrf
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="">Masukkan NIK / Username / Email</label>
                                    <input type="text" class="form-control identitas" id="floatingInput" placeholder="NIK / Username / Email..." name="identitas">
                                    <small class="error_identitas text-danger"></small>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info m-b-xs btn-submit w-100 btn-submit">
                                    Submit
                                </button>
                            </div>
                        </form>
                        <div style="height: 20px;"></div>
                        <div class="text-center">
                            <p>Already account ? <a href="{{ url('/login') }}">Login account</a></p>
                            <p>Not registered? <a href="{{ url('/register') }}">Create an account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="height: 280px;">
        <!-- Feature item #1 -->
        <div class="col-sm-6 col-md-6 col-lg-3">
            <!-- /.feature-item -->
        </div>
        <!-- /.col-lg-3 -->

    </div>

</section>
<div style="margin-top: -150px;"></div>
<section class="contact-layout1 pb-60" id="contactUs">
    <div class="container">
        <div class="row heading mb-40">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <div class="divider divider-primary mr-30"></div>
                    <h2 class="heading__subtitle mb-0">Kontak Kami</h2>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-7">
                <h3 class="heading__title">Siap siaga untuk pengabdian kemasyarakat</h3>
            </div><!-- /col-lg-5 -->

        </div>

        <div class="row">
            <!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="contact-info d-flex flex-column justify-content-between">
                    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/contact/1.jpg" alt="banner"></div>
                    <div>
                        <h4 class="contact-info__title">Total Keselurhan {{ $tps }} TPS</h4>
                        <p class="contact-info__desc" style="text-align: justify;">Siap siaga untuk pengabdian kemasyarakat, bersedia untuk turut berperan dalam kesuksesan pemilihan pejabat sebagai kader partai politik. Akan benar-benar bekerja untuk masyarakat terkhusus wilayah Dapil 3 Kota Cirebon (Kelurahan Argasunya don Kalijaga). KANG ASEP SHOLEH ini inshaa Allah akan membawa kemanfaatan kepada masyarakat don Tim yang berjuang dari awal.
                            Ingin menyampaikan aspirasi, pendapatan, ide, gagasan, masukkan dan ingin mengenal lebih jauh tentang Kang Asep Sholeh, silahkan hubungi kontak dibawah ini :
                        </p>

                        </p>
                    </div>
                    <ul style="list-style: none; margin: 0; padding: 0;">
                        <li class="text-white" style="line-height: 30px;"><i class="fas fa-envelope"></i>
                            <a href="mailto:{{ $getKonfigurasi->email_konfigurasi }}" class="text-white">Email : {{ $getKonfigurasi->email_konfigurasi }}</a>
                        </li>
                        <li class="text-white" style="line-height: 30px;"><i class="fas fa-phone"></i>
                            <a href="tel:{{ $getKonfigurasi->nohp_konfigurasi }}" class="text-white">Nomor HP : {{ $getKonfigurasi->nohp_konfigurasi }}</a>
                        </li>
                        <li class="text-white" style="line-height: 30px;">
                            <a href="{{ $getKonfigurasi->instagram_konfigurasi }}" target="_blank" class="text-white">
                                <i class="fab fa-instagram"></i> Instagram : {{ $getKonfigurasi->instagram_konfigurasi }}
                            </a>
                        </li>
                    </ul>
                </div><!-- /.contact-info -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.contact layout 1 -->




<!-- ======================
      Blog Grid
    ========================= -->

<!-- /.blog Grid -->


<!-- ========================
      Footer
    ========================== -->
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

@include('frontend.home.script')
@include('frontend.contact.partial.script')
@include('auth.scriptStatus')
@include('frontend.gallery.partial.script')
@endpush