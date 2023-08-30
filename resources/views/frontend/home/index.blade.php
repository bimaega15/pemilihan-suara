@extends('layouts.user')


@section('title','Home Page')

@section('content')

@php
use Carbon\Carbon;
$getKonfigurasi = Check::getKonfigurasi();
@endphp
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
                            <h2 class="slide__title">
                                {{$item->judul_banner}}
                            </h2>
                            <p class="slide__desc">
                                {{$item->keterangan_banner}}
                            </p>
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
<section class="about-layout4 pt-130 pb-0" id="about">
    <div class="container">
        <div class="row heading">
            <div class="col-12">
                <div class="d-flex align-items-center mb-20">
                    <div class="divider divider-primary mr-30"></div>
                    <h2 class="heading__subtitle mb-0">Tugas dan fungsi partai PAN </h2>
                </div>
            </div><!-- /.col-12 -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <h3 class="heading__title mb-40">Apa saja kegiatan partai politik
                </h3>
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <p>
                    Penyerap, penghimpun, dan penyalur aspirasi politik masyarakat dalam merumuskan dan menetapkan kebijakan negara; Partisipasi politik warga negara Indonesia; dan. Rekrutmen politik dalam proses pengisian jabatan politik melalui mekanisme demokrasi dengan memperhatikan kesetaraan dan keadilan gender.
                </p>
                <p>
                    Sebagai salah satu partai terbaik di indonesia, untuk membangun negeri dan memberantas korupsi
                </p>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="about__img">
                    <img src="{{ asset('frontend/SmartData/') }}/assets/images/about/2.jpg" alt="about">
                </div><!-- /.about-img -->
                <div class="video__btn-wrapper">
                    <a class="video__btn video__btn-white popup-video" href="https://www.youtube.com/watch?v=QunJfj8tMb4">
                        <div class="video__player">
                            <i class="fa fa-play"></i>
                        </div>
                        <span class="video__btn-title">Watch Our Presentation!</span>
                    </a>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-6 d-flex flex-column justify-content-between">
                <ul class="list-items list-items-layout2 list-horizontal list-unstyled d-flex flex-wrap mt-40">
                    <li>Memperjuangkan kepentingan</li>
                    <li>Nilai-nilai masyarakat</li>
                    <li>Rasa aman</li>
                    <li>Aspirasi</li>
                    <li>Perlindungan</li>
                    <li>Lain-lain</li>
                </ul>
                <div class="clients">
                    <p class="text__link text-center mb-10">Sponsor dari beberapa lembaga mitra PAN
                        <a href="{{url('/about')}}" class="btn btn__link btn__primary btn__underlined">Best Organisasi</a>
                    </p>
                    <div class="slick-carousel" data-slick='{"slidesToShow": 3, "arrows": false, "dots": false, "autoplay": true,"autoplaySpeed": 2000, "infinite": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 2}}]}'>
                        @if($about != null)
                        @php
                        $parseSponsor = json_decode($about->gambarsponsor_about, true);
                        @endphp
                        @foreach ($parseSponsor as $item)
                        <div class="client">
                            <img src="{{ asset('upload/about/sponsor/'.$item) }}" alt="{{$item}}" style="width: 100%; height: 120px;">
                            <img src="{{ asset('upload/about/sponsor/'.$item) }}" alt="{{$item}}" style="width: 100%; height: 120px;">
                        </div><!-- /.client -->
                        @endforeach
                        @endif
                    </div><!-- /.carousel -->
                </div>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.About Layout 4 -->

<!-- ========================
       Tim sukses
    =========================== -->
<section class="services-layout2 services-carousel pt-130 bg-gray" id="timSukses">
    <div class="container">
        <div class="row heading mb-40">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <div class="divider divider-primary mr-30"></div>
                    <h2 class="heading__subtitle mb-0">Tim Sukses Kami</h2>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-7">
                <h3 class="heading__title">Pelayanan yang terbaik, Partai PAN sebagai gerakan indonesia lebih bersih</h3>
            </div><!-- /col-lg-5 -->
            <div class="col-sm-12 col-md-12 col-lg-5">
                <p class="heading__desc">Meningkatkan efisiensi, pengarahan, dan penyedia layanan hukum terbaik, dengan pengalaman beberapa tim profesional kami, dengan harapan agar indonesia bersih dari korupsi</p>
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
<section class="features-layout1 pb-0">
    <div class="features-bg">
        <div class="bg-img"><img src="{{ asset('frontend/SmartData/') }}/assets/images/backgrounds/14.jpg" alt="background"></div>
    </div>
    <div class="container">
        <div class="row heading heading-light mb-30">
            <div class="col-sm-12 col-md-12 col-lg-5">
                <div class="divider divider-primary mb-20"></div>
                <h3 class="heading__title">
                    Menyediakan pelayanan yang terbaik untuk negeri.
                </h3>
            </div><!-- /col-lg-5 -->
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-1">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="heading__desc">
                            Partai politik berfungsi sebagai salah satu sarana sosialisasi politik, untuk dapat menjadi
                            pemenang didalam Pemilihan Umum (Pemilu)
                        </p>

                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-6">
                        <p class="heading__desc">
                            Berikut beberapa tim sukses kami, yang memiliki banyak prestasi dan pengaruh di lingkungannya
                        </p>
                    </div><!-- /.col-sm-6 -->
                </div><!-- /.row -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            @if($about != null)
            @php
            $parseSponsor = json_decode($about->teamdetail_about, true);
            @endphp
            @foreach ($parseSponsor as $index => $item)

            @if ($index < 4) <!-- Feature item #1 -->
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="feature-item text-center p-2">
                        <img src="{{ asset('upload/about/team/'.$item) }}" class="rounded" alt="{{ $item }}" style="width: 100%; height: 200px;">
                    </div><!-- /.feature-item -->
                </div>
                <!-- /.col-lg-3 -->
                @endif

                @endforeach
                @endif
        </div><!-- /.row -->
        <div class="row mt-40">
            <div class="col-sm-12 col-md-12 col-lg-6 d-flex flex-column justify-content-between">

                <div class="row">
                    <div class="col-sm-6">
                        <p class="mb-30 font-weight-bold sub__desc"> Partai politik berfungsi sebagai salah satu sarana sosialisasi politik, untuk dapat menjadi
                            pemenang didalam Pemilihan Umum (Pemilu)</p>

                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-6">
                        <ul class="list-items list-unstyled mb-30">
                            <li class="text-white">{{ $tps }} TPS</li>
                            <li class="text-white">Memperjuangkan kepentingan</li>
                            <li class="text-white">Aspirasi</li>
                            <li class="text-white">Nilai-nilai masyarakat</li>
                        </ul>
                    </div><!-- /.col-sm-6 -->
                </div><!-- /.row -->
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <img src="{{ asset('upload/assets/pan.jpg') }}" alt="pan" height="400px" width="60%">
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Features Layout 1 -->

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
                            <h3 class="heading__title mb-30">{{ number_format($tps, 0) }} Tps</h3>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6">
                            <p class="heading__desc mb-20">Siap siaga untuk pengabdian kemasyarakat, bersedia untuk turut berperan dalam kesuksesan pemilihan pejabat sebagai kader partai politik.</p>
                            <p class="heading__desc mb-20">
                                Sebagai salah satu partai terbaik di indonesia, untuk membangun negeri dan memberantas korupsi
                            </p>

                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                    <div class="row counters-wrapper counters-light mt-70">
                        <!-- counter item #1 -->
                        <div class="col-sm-6">
                            <div class="counter-item">
                                <h4 class="counter">{{ number_format($tps,0) }}</h4>
                                <p class="counter__desc">TPS</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-6 -->
                        <!-- counter item #2 -->
                        <div class="col-sm-6">
                            <div class="counter-item">
                                <h4 class="counter">{{ number_format($regencies,0) }}</h4>
                                <p class="counter__desc">Kabupaten</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-6 -->
                        <!-- counter item #3 -->
                        <div class="col-sm-6">
                            <div class="counter-item">
                                <h4 class="counter">{{ number_format($districts,0) }}</h4>
                                <p class="counter__desc">Kecamatan</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6">
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
<section id="contactUs">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="heading text-center mb-40">
                <h2 class="heading__subtitle">Kantor TPS</h2>
                <h3 class="heading__title">Area Wilayah</h3>
            </div><!-- /.heading -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div id="map" style="height: 600px;"></div>
        </div>
    </div>
</section>
<!-- /.contact Grid -->


<!-- ==========================
        contact layout 1
    =========================== -->
<section class="contact-layout1 pb-60">
    <div class="container">
        <div class="row heading mb-40">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <div class="divider divider-primary mr-30"></div>
                    <h2 class="heading__subtitle mb-0">Deskripsi</h2>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-7">
                <h3 class="heading__title">Cerita Singkat tentang partai PAN</h3>
            </div><!-- /col-lg-5 -->

        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 mb-3">
                <form class="contact-form" method="post" action="#" id="contactForm">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="contact-panel__title">
                                Tentang Partai PAN
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
                        <h4 class="contact-info__title">{{ $tps }} Tps</h4>
                        <p class="contact-info__desc">Siap siaga untuk pengabdian kemasyarakat, bersedia untuk turut berperan dalam kesuksesan pemilihan pejabat sebagai kader partai politik.</p>
                        <p class="contact-info__desc">Sebagai salah satu partai terbaik di indonesia, untuk membangun negeri dan memberantas korupsi.
                        </p>
                    </div>
                    <ul style="list-style: none; margin: 0; padding: 0;">
                        <li class="text-white" style="line-height: 30px;"><i class="fas fa-envelope"></i>
                            <a href="mailto:{{ $getKonfigurasi->email_konfigurasi }}" class="text-white"> {{ $getKonfigurasi->email_konfigurasi }}</a>
                        </li>
                        <li class="text-white" style="line-height: 30px;"><i class="fas fa-phone"></i>
                            <a href="tel:{{ $getKonfigurasi->nohp_konfigurasi }}" class="text-white"> {{ $getKonfigurasi->nohp_konfigurasi }}</a>
                        </li>
                        <li class="text-white" style="line-height: 30px;">
                            <a href="{{ $getKonfigurasi->instagram_konfigurasi }}" target="_blank" class="text-white">
                                <i class="fab fa-instagram"></i> @ {{ $getKonfigurasi->instagram_konfigurasi }}
                            </a>
                        </li>
                    </ul>
                </div><!-- /.contact-info -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.contact layout 1 -->


<section class="blog-grid pb-50" id="statusPendaftaran">
    <div class=" row">
        <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="heading text-center mb-40">
                <h2 class="heading__subtitle">Menu untuk periksa status pendaftaran koordinator</h2>
                <h3 class="heading__title">Periksa Status Pendaftaran</h3>
            </div><!-- /.heading -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

    <div class="container">
        <div class="row mb-2">
            <div class="col-lg-6 mx-auto">
                <div class="card login-box-container shadow">
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
    <div style="height: 20px;"></div>

</section>

<!-- ======================
      Blog Grid
    ========================= -->
<section class="blog-grid pb-50" id="gallery">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-40">
                    <h2 class="heading__subtitle">Gallery</h2>
                    <h3 class="heading__title">Gambar Dokumentasi</h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div id="contentGallery" class="row">
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
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