@extends('layouts.user')


@section('title', 'Home Page')

@section('content')

    @php
        use Carbon\Carbon;
        $getKonfigurasi = Check::getKonfigurasi();
    @endphp



    <!-- ============================
                                                                                                    Slider
                                                                                                ============================== -->
    <div class="banner-area banner-style-one shadow navigation-custom-large zoom-effect overflow-hidden text-light"
        id="home">
        <!-- Slider main container -->
        <div class="banner-fade">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">

                <!-- Single Item -->
                <div class="swiper-slide banner-style-one">
                    <div class="banner-thumb bg-cover shadow dark"
                        style="background: url(assets-frontend/img/banner/gambar2.jpg);"></div>
                    <div class="container">
                        <div class="row align-center">
                            <div class="col-xl-7 offset-xl-5">
                                <div class="content">
                                    <h2><strong>Memilih Pemimpin</strong> Yang Merakyat.</h2>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shape -->
                    <div class="banner-shape-bg">
                        <img src="{{ asset('assets-frontend/img/shape/4.png') }}" alt="Shape">
                    </div>
                    <!-- End Shape -->
                </div>
                <div class="swiper-slide banner-style-one">
                    <div class="banner-thumb bg-cover shadow dark"
                        style="background: url(assets-frontend/img/banner/gambar1.jpg);"></div>
                    <div class="container">
                        <div class="row align-center">
                            <div class="col-xl-7 offset-xl-5">
                                <div class="content">
                                    <h2><strong>Berkolaborasi </strong> Bersama Rakyat.</h2>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shape -->
                    <div class="banner-shape-bg">
                        <img src="{{ asset('assets-frontend/img/shape/4.png') }}" alt="Shape">
                    </div>
                    <!-- End Shape -->
                </div>
                <!-- End Single Item -->

                <!-- Single Item -->

                <!-- End Single Item -->

            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>

        </div>
    </div>
    <!-- End Main -->

    <!-- Start Our Features
                                                                                                ============================================= -->

    <div class="about-style-one-area default-padding" id="about">

        <div class="container">
            <div class="row align-center">
                <div class="about-style-one col-xl-6 col-lg-5">
                    <div class="h4 sub-heading">Visi Vindy Faradilah</div>
                    <h2 class="title mb-25">Mewujudkan Masyarakat Yang Adil, inklusif, dan berkelanjutan</h2>
                    <p>
                        Mewujudkan masyarakat yang adil, inklusif, dan berkelanjutan, di mana perempuan memiliki peran
                        aktif
                        dan terlibat secara merata dalam pembuatan kebijakan publik.
                        Saya bertekad untuk memajukan hak-hak perempuan, menciptakan kesetaraan gender, dan membangun
                        fondasi yang kuat bagi pembangunan berkelanjutan.
                    </p>

                </div>
                <div class="about-style-one col-xl-5 offset-xl-1 col-lg-6 offset-lg-1">
                    <div class="about-thumb">
                        <img class="wow fadeInRight" src="{{ asset('assets-frontend/img/about/about.jpg') }}"
                            alt="Image Not Found">

                        <div class="thumb-shape-bottom wow fadeInDown" data-wow-delay="300ms">
                            <img src="{{ asset('assets-frontend/img/shape/anim-3.png') }}" alt="Image Not Found">
                            <img src="{{ asset('assets-frontend/img/shape/anim-4.png') }}" alt="Image Not Found">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Our Features -->
    <!-- Start Services
                                                                                                ============================================= -->
    <div class="services-style-two-area default-padding bottom-less bg-cover bg-gray"
        style="background-image: url(assets-frontend/img/shape/27.png);">

        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4 class="sub-heading">Program Prioritas</h4>
                        <h2 class="title">Berkolaborasi Bersama Rakyat</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <!-- Single Item -->
                <div class="col-xl-4 col-md-6 mb-30">
                    <div class="services-style-two active">
                        <div class="thumb">
                            <img src="{{ asset('assets-frontend/img/service/gambar4.jpg') }}" alt="Thumb">
                            <div class="title">
                                <a href="#">
                                    <i class="flaticon-budget"></i>
                                    <h4>Pendidikan Berkualitas</h4>
                                </a>
                            </div>
                        </div>
                        <div class="info">
                            <p>
                                Meningkatkan akses dan kualitas pendidikan dari tingkat dasar hingga menengah.
                            </p>
                            <div class="button">
                                <a href="#">Selengkapnya</a>
                                <div class="devider"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->

                <!-- Single Item -->
                <div class="col-xl-4 col-md-6 mb-30">
                    <div class="services-style-two">
                        <div class="thumb">
                            <img src="{{ asset('assets-frontend/img/service/gambar1.jpg') }}" alt="Thumb">
                            <div class="title">
                                <a href="#">
                                    <i class="flaticon-bar-chart"></i>
                                    <h4>Pengembangan Ekonomi</h4>
                                </a>
                            </div>
                        </div>
                        <div class="info">
                            <p>
                                Mendukung UMKM dengan penyediaan akses pendanaan, pelatihan, dan pemasaran.
                            </p>
                            <div class="button">
                                <a href="#">Selengkapnya</a>
                                <div class="devider"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->

                <!-- Single Item -->
                <div class="col-xl-4 col-md-6 mb-30">
                    <div class="services-style-two">
                        <div class="thumb">
                            <img src="{{ asset('assets-frontend/img/service/gambar3.jpg') }}" alt="Thumb">
                            <div class="title">
                                <a href="#">
                                    <i class="flaticon-credit-cards"></i>
                                    <h4>Perlindungan Lingkungan</h4>
                                </a>
                            </div>
                        </div>
                        <div class="info">
                            <p>
                                Mendorong pengelolaan yang berkelanjutan terhadap hutan, sungai, dan laut.
                            </p>
                            <div class="button">
                                <a href="#">Selengkapnya</a>
                                <div class="devider"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->

            </div>
        </div>
    </div>
    <!-- End Services -->
    <div class="choose-us-style-one-area default-padding text-light">
        <div class="cover-bg" style="background-image: url(assets-frontend/img/banner/gambar20.jpg);"></div>
        <div class="shape-left-top">
            <img src="{{ asset('assets-frontend/img/shape/17.png') }}" alt="Shape">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pr-80">
                    <div class="choose-us-style-one">
                        <h2 class="title mb-35">Keyakinan & Tekad Yang Kuat</h2>
                        <ul class="list-item">
                            <li class="wow fadeInUp">
                                <p>
                                    Saya percaya bahwa dengan visi yang kuat, tekad yang tak tergoyahkan, dan kerja keras
                                    yang konsisten, kita dapat menciptakan masyarakat yang lebih inklusif, adil, dan
                                    berkelanjutan.
                                </p>
                            </li>
                            <li class="wow fadeInUp" data-wow-delay="300ms">
                                <p>
                                    Saya tidak hanya melihat ini sebagai tugas politik, tetapi juga sebagai panggilan moral
                                    dan sosial. Saya siap bekerja bersama komunitas, rekan-rekan legislator, dan masyarakat
                                    luas untuk mewujudkan visi ini dan menjadikan perubahan yang berarti bagi perempuan dan
                                    seluruh masyarakat.
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Partner Area
                                                                                                ============================================= -->
    <!-- End Partner Area -->

    <!-- Start Aobut
                                                                                                ============================================= -->

    <div class="fun-factor-style-one-area bg-gray default-padding"
        style="background-image: url(assets-frontend/img/shape/41.png);">
        <div class="container">
            <div class="fun-factor-style-one-box">

                <div class="shape-animated-up-down">
                    <img src="{{ asset('assets-frontend/img/shape/39.png') }}" alt="Image Not Found">
                </div>

                <div class="row align-center">

                    <div class="col-lg-10 offset-lg-1 text-center fun-fact-style-one">
                        <div class="row">
                            <!-- Single item -->
                            <div class="col-lg-3 col-md-4 item">
                                <div class="fun-fact">
                                    <div class="counter">
                                        <div class="timer" data-to="1" data-speed="2000">1</div>
                                        <div class="operator">+</div>
                                    </div>
                                    <span class="medium">Kota/Kapupaten</span>
                                </div>
                            </div>
                            <!-- End Single item -->

                            <!-- Single item -->
                            <div class="col-lg-3 col-md-4 item">
                                <div class="fun-fact">
                                    <div class="counter">
                                        <div class="timer" data-to="1" data-speed="2000">1</div>
                                        <div class="operator">+</div>
                                    </div>
                                    <span class="medium">Kecamatan</span>
                                </div>
                            </div>
                            <!-- End Single item -->

                            <!-- Single item -->
                            <div class="col-lg-3 col-md-4 item">
                                <div class="fun-fact">
                                    <div class="counter">
                                        <div class="timer" data-to="1" data-speed="2000">1</div>
                                        <div class="operator">+</div>
                                    </div>
                                    <span class="medium">Kelurahan/Desa</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 item">
                                <div class="fun-fact">
                                    <div class="counter">
                                        <div class="timer" data-to="12" data-speed="2000">12</div>
                                        <div class="operator">+</div>
                                    </div>
                                    <span class="medium">TPS</span>
                                </div>
                            </div>
                            <!-- End Single item -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End About -->

    <!-- Start Faq
                                                                                                ============================================= -->
    <div class="testimonial-style-one-area default-padding">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-4">
                    <div class="testimonial-thumb">
                        <div class="thumb-item">
                            <img src="{{ asset('assets-frontend/img/illustration/14.png') }}" alt="illustration">

                        </div>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="testimonial-carousel swiper">

                        <div class="swiper-slide">
                            <div class="testimonial-style-one">
                                <div class="item">
                                    <div class="content">
                                        <p>
                                            “Jika kita ingin memberikan warisan yang berarti bagi generasi mendatang, kita
                                            harus bertindak hari ini. Biarkan tindakan kita menjadi riwayat yang
                                            menginspirasi, riwayat perempuan yang berani berdiri untuk keadilan, kesetaraan,
                                            dan perubahan positif. Bersama, kita harus bisa membuat perubahan yang mampu
                                            mengukir jejak berarti dalam sejarah.”
                                        </p>
                                    </div>
                                    <div class="provider">
                                        <i class="flaticon-quote"></i>
                                        <div class="info">
                                            <h4>Vindy Faradilah, S.E</h4>
                                            <span>Calon Anggota Legislatif DPR-RI Dapil VIII 2024</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- End Faq -->

    <!-- Start Testimonials
                                                                                                ============================================= -->
    <div class="testimonials-style-two-area bg-dark default-padding-top half-shape-light-bottom"
        style="background-image: url(assets-frontend/img/shape/34.png);" id="timSukses">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="site-heading text-light text-center">
                        <h4 class="sub-heading">Contribute</h4>
                        <h2 class="title">Kegiatan Yang Sudah Berjalan</h2>
                        <p>Saya berkomitmen untuk menjadi perwakilan yang kuat bagi perempuan dan masyarakat pada umumnya,
                            dengan fokus pada kesetaraan gender, hak asasi perempuan, dan pembangunan berkelanjutan. Saya
                            akan bekerja keras untuk mewujudkan tujuan-tujuan ini melalui kerjasama dengan berbagai pihak
                            dan advokasi yang berkelanjutan di dalam dan di luar parlemen</p>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fill">
            <div class="row">
                <div class="testimonial-style-two-carousel swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">

                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="gallery-item">
                                <div class="gallery-style-two">
                                    <img src="{{ asset('assets-frontend/img/gallery/01.jpg') }}" alt="Thumb">
                                    <div class="shape">
                                        <img src="{{ asset('assets-frontend/img/shape/35.png') }}" alt="Image Not Found">
                                    </div>
                                    <div class="overlay">
                                        <div class="content">
                                            <span>Cirebon</span>
                                            <h4><a href="#">Kunjunagn Kerja</a></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->

                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="gallery-item">
                                <div class="gallery-style-two">
                                    <img src="{{ asset('assets-frontend/img/gallery/04.jpg') }}" alt="Thumb">
                                    <div class="shape">
                                        <img src="{{ asset('assets-frontend/img/shape/35.png') }}" alt="Image Not Found">
                                    </div>
                                    <div class="overlay">
                                        <div class="content">
                                            <span>Cirebon</span>
                                            <h4><a href="#">Kunjunagn Kerja</a></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->

                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="gallery-item">
                                <div class="gallery-style-two">
                                    <img src="{{ asset('assets-frontend/img/gallery/05.jpg') }}" alt="Thumb">
                                    <div class="shape">
                                        <img src="{{ asset('assets-frontend/img/shape/35.png') }}" alt="Image Not Found">
                                    </div>
                                    <div class="overlay">
                                        <div class="content">
                                            <span>Cirebon</span>
                                            <h4><a href="#">Kunjunagn Kerja</a></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-item">
                                <div class="gallery-style-two">
                                    <img src="{{ asset('assets-frontend/img/gallery/06.jpg') }}" alt="Thumb">
                                    <div class="shape">
                                        <img src="{{ asset('assets-frontend/img/shape/35.png') }}" alt="Image Not Found">
                                    </div>
                                    <div class="overlay">
                                        <div class="content">
                                            <span>Cirebon</span>
                                            <h4><a href="#">Kunjunagn Kerja</a></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->

                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonials  -->

    <!-- Start Project
                                                                                                ============================================= -->
    <div class="home-blog-area default-padding bottom-less bg-gray" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4 class="sub-heading">Recent Gallery</h4>
                        <h2 class="title">Dokumentasi Semua Kegiatan</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <!-- Single Item -->
                <div class="col-xl-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="300ms">
                    <div class="blog-style-one">
                        <div class="thumb">
                            <a href="#"><img src="{{ asset('assets-frontend/img/gallery/04.jpg') }}"
                                    alt="Thumb"></a>
                        </div>
                        <div class="info">
                            <div class="blog-meta">
                                <ul>
                                    <li>
                                        <span></span>
                                        <a href="#">Kab. Cirebon</a>
                                    </li>
                                    <li>
                                        28 Desember, 2020
                                    </li>
                                </ul>
                            </div>
                            <h4>
                                <a href="blog-single-with-sidebar.html">Penyerahan 13 Mesin Pompa Kepada Petani di
                                    Cirebon</a>
                            </h4>

                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-xl-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="500ms">
                    <div class="blog-style-one">
                        <div class="thumb">
                            <a href="#"><img src="{{ asset('assets-frontend/img/gallery/11.jpg') }}"
                                    alt="Thumb"></a>
                        </div>
                        <div class="info">
                            <div class="blog-meta">
                                <ul>
                                    <li>
                                        <span></span>
                                        <a href="#">Desa Bunder</a>
                                    </li>
                                    <li>
                                        20 Desember, 2020
                                    </li>
                                </ul>
                            </div>
                            <h4>
                                <a href="blog-single-with-sidebar.html">Penyerahan Power Tresher Kepada Petani Fajar
                                    Jaya</a>
                            </h4>

                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-xl-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="700ms">
                    <div class="blog-style-one">
                        <div class="thumb">
                            <a href="#"><img src="{{ asset('assets-frontend/img/gallery/19.jpg') }}"
                                    alt="Thumb"></a>
                        </div>
                        <div class="info">
                            <div class="blog-meta">
                                <ul>
                                    <li>
                                        <span></span>
                                        <a href="#">Kab. Cirebon</a>
                                    </li>
                                    <li>
                                        29 December, 2020
                                    </li>
                                </ul>
                            </div>
                            <h4>
                                <a href="blog-single-with-sidebar.html">Penyerahan Traktor Kepada Petani</a>
                            </h4>

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="300ms">
                    <div class="blog-style-one">
                        <div class="thumb">
                            <a href="#"><img src="{{ asset('assets-frontend/img/gallery/07.jpg') }}"
                                    alt="Thumb"></a>
                        </div>
                        <div class="info">
                            <div class="blog-meta">
                                <ul>
                                    <li>
                                        <span></span>
                                        <a href="#">Kab. Cirebon</a>
                                    </li>
                                    <li>
                                        28 Desember, 2020
                                    </li>
                                </ul>
                            </div>
                            <h4>
                                <a href="blog-single-with-sidebar.html">Support Kelompok Wanita Tani (KWT) Kab. Cirebon</a>
                            </h4>

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="300ms">
                    <div class="blog-style-one">
                        <div class="thumb">
                            <a href="#"><img src="{{ asset('assets-frontend/img/gallery/06.jpg') }}"
                                    alt="Thumb"></a>
                        </div>
                        <div class="info">
                            <div class="blog-meta">
                                <ul>
                                    <li>
                                        <span></span>
                                        <a href="#">Kab. Cirebon</a>
                                    </li>
                                    <li>
                                        28 Desember, 2022
                                    </li>
                                </ul>
                            </div>
                            <h4>
                                <a href="blog-single-with-sidebar.html">Santunan Yatim dan Dhuafa Kab. Cirebon</a>
                            </h4>

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="300ms">
                    <div class="blog-style-one">
                        <div class="thumb">
                            <a href="#"><img src="{{ asset('assets-frontend/img/gallery/13.jpg') }}"
                                    alt="Thumb"></a>
                        </div>
                        <div class="info">
                            <div class="blog-meta">
                                <ul>
                                    <li>
                                        <span></span>
                                        <a href="#">Kab. Cirebon</a>
                                    </li>
                                    <li>
                                        28 Desember, 2020
                                    </li>
                                </ul>
                            </div>
                            <h4>
                                <a href="blog-single-with-sidebar.html">Panen Padi MSP bersama Petani Kab. Cirebon</a>
                            </h4>

                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
            </div>
        </div>
    </div>

    <!--<div class="request-call-back-area text-light default-padding" style="background-image: url(assets-frontend/img/shape/vote-banner.png);">
                                                                                                <div class="container">
                                                                                                    <div class="row align-center">
                                                                                                        <div class="col-lg-6">
                                                                                                            <h2 class="title">Looking for a First-Class <br> Business Consultant?</h2>
                                                                                                            <a class="btn circle btn-light mt-30 mt-md-15 mt-xs-10 btn-md radius animation" href="#">Request a Call back</a>
                                                                                                        </div>
                                                                                                        <div class="col-lg-6 text-end">
                                                                                                            <div class="achivement-counter">
                                                                                                                <ul>
                                                                                                                    <li>
                                                                                                                        <div class="icon">
                                                                                                                            <i class="flaticon-handshake"></i>
                                                                                                                        </div>
                                                                                                                        <div class="fun-fact">
                                                                                                                            <div class="counter">
                                                                                                                                <div class="timer" data-to="500" data-speed="2000">500</div>
                                                                                                                                <div class="operator">+</div>
                                                                                                                            </div>
                                                                                                                            <span class="medium">Business advices given over 30 years</span>
                                                                                                                        </div>
                                                                                                                    </li>
                                                                                                                    <li>
                                                                                                                        <div class="icon">
                                                                                                                            <i class="flaticon-employee"></i>
                                                                                                                        </div>
                                                                                                                        <div class="fun-fact">
                                                                                                                            <div class="counter">
                                                                                                                                <div class="timer" data-to="30" data-speed="2000">30</div>
                                                                                                                                <div class="operator">+</div>
                                                                                                                            </div>
                                                                                                                            <span class="medium">Business Excellence awards achieved</span>
                                                                                                                        </div>
                                                                                                                    </li>
                                                                                                                </ul>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div> -->
    <!-- End Project -->
    <div class="request-call-back-area text-light default-padding"
        style="background-image: url(assets-frontend/img/shape/vote-banner.png);">

        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-7">
                    <div class="party-single-item style-01">
                        <div class="content">
                            <div class="subtitle wow animate__animated animate__fadeInUp">
                                <p>Dukungan Anda Membantu Kami</p>
                                <div class="icon">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                            </div>
                            <h4 class="title wow animate__animated animate__fadeInUp">Dukung Vindy Faradilah, S.E
                            </h4>
                            <p class="description style-01 wow animate__animated animate__fadeInUp">
                                Dukungan yang Anda berikan kepada kami sebagai calon legislatif merupakan dorongan yang
                                sangat kami hargai dalam perjuangan kami untuk mewakili dan melayani masyarakat dengan
                                sebaik-baiknya.
                            </p>
                            <div>
                                <a class="btn circle btn-light mt-30 mt-md-15 mt-xs-10 btn-md radius animation"
                                    href="#">Gabung Menjadi Volunteer</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-blog-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="site-heading text-center">

                        <h2 class="title">Turun Langsung Ke Masyarakat</h2>
                        <p>Tantangan tidak akan mudah, tetapi saya yakin bahwa dengan kerja keras, kolaborasi, dan
                            ketekunan, kita dapat meraih perubahan yang signifikan. Saya terus terinspirasi oleh
                            cerita-cerita perempuan tangguh yang telah memecahkan batasan-batasan dan membuka jalan bagi
                            generasi mendatang. Semangat inilah yang membara di dalam diri saya, mendorong saya untuk terus
                            berjuang dan memperjuangkan hak-hak perempuan, serta mengadvokasi perubahan yang lebih baik
                            untuk semua.</p>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <!-- Single Item -->
                <div class="col-lg-6">
                    <div class="blog-style-one solid">
                        <div class="thumb">
                            <img src="{{ asset('assets-frontend/img/gallery/14.jpg') }}" alt="Image Not Found">
                            <div class="info">
                                <div class="blog-meta">
                                    <ul>

                                        <li>
                                            24 August, 2023
                                        </li>
                                    </ul>
                                </div>
                                <h4>
                                    <a href="#">Kembali Guyur Bantuan, Vindy Faradilah Serahkan 13 Mesin Pompa Kepada
                                        Petani Di Kab. Cirebon</a>
                                </h4>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-lg-6 mt-md-30 mt-xs-30">
                    <div class="blog-style-one solid mb-30">
                        <div class="thumb">
                            <img src="{{ asset('assets-frontend/img/gallery/11.jpg') }}" alt="Image Not Found">

                            <div class="info">
                                <div class="blog-meta">
                                    <ul>

                                        <li>
                                            16 August, 2023
                                        </li>
                                    </ul>
                                </div>
                                <h4>
                                    <a href="#">Vindy Tebar Bantuan 100 Ribu Ekor Benih Lele.</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="blog-style-one solid">
                        <div class="thumb">
                            <img src="{{ asset('assets-frontend/img/gallery/13.jpg') }}"
                                style="height: 395px; width: 600px;" alt="Image Not Found">

                            <div class="info">
                                <div class="blog-meta">
                                    <ul>

                                        <li>
                                            18 August, 2023
                                        </li>
                                    </ul>
                                </div>
                                <h4>
                                    <a href="#">Vindy memberikan bantuan kepada kelompok tani di Kab. Cirebon</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
            </div>
        </div>
    </div>
    <!-- Start Contact Us
                                                                                                ============================================= -->
    <div class="contact-style-one-area overflow-hidden half-shape-top default-padding-bottom" style="padding-top: 20px;"
        id="contactUs">

        <div class="contact-shape">
            <img src="{{ asset('assets-frontend/img/shape/37.png') }}" alt="Image Not Found">
        </div>

        <div class="container">
            <div class="row">

                <div class="contact-stye-one col-lg-5 pt-220 pt-md-120 pt-xs-50">

                    <div class="shape-animated-arrow">
                        <img src="{{ asset('assets-frontend/img/shape/36.png') }}" alt="Image Not Found">
                    </div>

                    <div class="contact-style-one-info">
                        <h2>Hubungi Kami</h2>
                        <p>
                            Kami selalu siap mendengarkan pandangan, masukan, atau pertanyaan dari Anda.
                        </p>
                        <ul>
                            <li class="wow fadeInUp">
                                <div class="icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="content">
                                    <h5 class="title">Tim Kami</h5>
                                    <a href="#">085777400685</a>
                                </div>
                            </li>
                            <li class="wow fadeInUp" data-wow-delay="300ms">
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Lokasi</h5>
                                    <p>
                                        Jl. Cirebon Raya No. 30, <br> Kota Cirebon
                                    </p>
                                </div>
                            </li>
                            <li class="wow fadeInUp" data-wow-delay="500ms">
                                <div class="icon">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Official Email</h5>
                                    <a href="mailto:info@agrul.com.com">timvindi@gmail.com</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="contact-stye-one col-lg-7 pl-60 pl-md-15 pl-xs-15 mt-md-50">
                    <div class="contact-form-style-one">
                        <h5 class="sub-title">Ada Pertanyaan?</h5>
                        <h2 class="heading">Kirim Pesan Sekarang</h2>
                        <form action="https://validthemes.net/site-template/consua/assets/mail/contact.php" method="POST"
                            class="contact-form contact-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" id="name" name="name" placeholder="Name"
                                            type="text">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" id="email" name="email" placeholder="Email*"
                                            type="email">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" id="phone" name="phone" placeholder="Phone"
                                            type="text">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group comments">
                                        <textarea class="form-control" id="comments" name="comments" placeholder="Pertanyaan Anda *"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" name="submit" id="submit">
                                        <i class="fa fa-paper-plane"></i> Kirim Sekarang
                                    </button>
                                </div>
                            </div>
                            <!-- Alert Message -->
                            <div class="col-lg-12 alert-notification">
                                <div id="message" class="alert-msg"></div>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- End Contact -->

    <!-- Start Fun Factor Area
                                                                                                ============================================= -->

    <!-- End Fun Factor Area -->

    <!-- Start Blog
                                                                                                ============================================= -->
    <!-- /.contact layout 1 -->

@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    @include('frontend.home.script')
    @include('frontend.contact.partial.script')
    @include('auth.scriptStatus')
    @include('frontend.gallery.partial.script')
@endpush
