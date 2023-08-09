@extends('layouts.user')

@section('title','About Page')

@section('content')


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
                    <a class="video__btn video__btn-rounded video__btn-white popup-video mx-3"
                        href="https://www.youtube.com/watch?v=QunJfj8tMb4">
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
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/1.png"
                                alt="thumb">
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
        <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/backgrounds/1.jpg"
                alt="background"></div>
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
                        <div class="slick-carousel carousel-arrows-light"
                            data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "arrows": true, "dots": false, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 1}}, {"breakpoint": 768, "settings": {"slidesToShow": 1}}, {"breakpoint": 570, "settings": {"slidesToShow": 1}}]}'>
                            <div class="carousel-block">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <!-- timeline Item #1 -->
                                        <div class="timeline-item row align-items-end">
                                            <div class="timeline__img col-sm-6">
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/1.jpg"
                                                    alt="timeline">
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
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/2.jpg"
                                                    alt="timeline">
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
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/3.jpg"
                                                    alt="timeline">
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
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/4.jpg"
                                                    alt="timeline">
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
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/3.jpg"
                                                    alt="timeline">
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
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/4.jpg"
                                                    alt="timeline">
                                            </div>
                                        </div><!-- /.timeline-item -->
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <!-- timeline Item #3 -->
                                        <div class="timeline-item row align-items-end">
                                            <div class="timeline__img col-sm-6">
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/1.jpg"
                                                    alt="timeline">
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
                                                <img src="{{ asset('frontend/SmartData') }}/assets/images/timeline/2.jpg"
                                                    alt="timeline">
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
                <img src="{{ asset('upload/assets/pan.jpg') }}" alt="pan" height="400px" width="325px">
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
                        <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/1.png"
                            alt="author thumb">
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
                        <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/2.png"
                            alt="author thumb">
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
                        <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/3.png"
                            alt="author thumb">
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
                        <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/4.png"
                            alt="author thumb">
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
                        <img src="{{ asset('frontend/SmartData') }}/assets/images/testimonials/thumbs/5.png"
                            alt="author thumb">
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
        <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/backgrounds/2.jpg"
                alt="background"></div>
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
                                <li>2307 Beverley Rd Brooklyn, New York 11226 United States.</li>
                            </ul>
                        </div><!-- /.contact-item-->
                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-6">
                        <div class="contact-item">
                            <div class="contact__icon"><i class="icon-mail"></i></div>
                            <ul class="contact__list list-unstyled">
                                <li><a href="mailto:SmartData@7oroof.com">Email: SmartData@7oroof.com</a></li>
                                <li><a href="tel:5565454117">Phone: +55 654 541 17</a></li>
                            </ul>
                        </div><!-- /.contact-item-->
                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-6"></div><!-- /.col-sm-6 -->
                </div><!-- /.row-->
            </div><!-- /.col-xl-6 -->
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 offset-xl-1">
                <div class="banner__content">
                    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/backgrounds/3.png"
                            alt="background"></div>
                    <div class="scroll__icon"><i class="icon-mouse"></i></div>
                    <div class="row heading heading-light">
                        <div class="col-sm-6">
                            <h3 class="heading__title mb-30">450,000 client’s interactions!</h3>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6">
                            <p class="heading__desc mb-20">Provide users with appropriate view access to requests,
                                problems,
                                changes, contracts & solutions with experienced professionals.</p>
                            <p class="heading__desc mb-20">As one of the world's largest ITService Providers, we are
                                ready to
                                help.
                            </p>
                            <a href="#" class="btn btn__white btn__bordered btn__xl btn__icon">
                                <span>Download Brochure</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                    <div class="row counters-wrapper counters-light mt-70">
                        <!-- counter item #1 -->
                        <div class="col-sm-4">
                            <div class="counter-item">
                                <h4 class="counter">6,154</h4>
                                <p class="counter__desc">Projects And Software Developed in 2021</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-4 -->
                        <!-- counter item #2 -->
                        <div class="col-sm-4">
                            <div class="counter-item">
                                <h4 class="counter">2,512</h4>
                                <p class="counter__desc">Qualified Employees And Developers With Us</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-4 -->
                        <!-- counter item #3 -->
                        <div class="col-sm-4">
                            <div class="counter-item">
                                <h4 class="counter">1,784</h4>
                                <p class="counter__desc">Satisfied Clients We Have Served Globally</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-4 -->
                    </div><!-- /.row -->
                </div><!-- /.banner__content -->
                <div class="semi-banner bg-gray">
                    <div class="row row-no-gutter">
                        <div class="col-sm-6">
                            <div class="semi-banner__content">
                                <div class="heading">
                                    <h3 class="heading__title mb-30">Timely Service, and incident resolutions!!</h3>
                                    <p class="heading_desc mb-30">Improve efficiency, leverage tech, and provide better
                                        customer
                                        experiences with the modern technology services available allover the world.
                                    </p>
                                    <p class="heading_desc mb-30">Our skilled personnel, utilising the latest processing
                                        software,
                                        combined with decades of experience.</p>
                                </div><!-- /.heading -->
                                <img src="{{ asset('frontend/SmartData') }}/assets/images/about/singnture.png"
                                    alt="singnture">
                            </div>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6 d-none d-md-block">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/banners/7.jpg" alt="banner"
                                class="w-100">
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                </div><!-- /.semi-banner -->
                <div class="semi-banner bg-gray">
                    <div class="row row-no-gutter">
                        <div class="col-sm-6">
                            <div class="cta-banner bg-primary">
                                <div class="cta__icon color-white"><i class="icon-developer"></i></div>
                                <h4 class="cta__title color-white">Since 1999</h4>
                                <p class="cta__desc color-white mb-25">Provide users with appropriate view and access to
                                    requests,
                                    problems, changes,
                                    contracts, solutions, and reports.</p>
                                <a href="#" class="btn btn__link btn__white btn__icon px-0">
                                    <span>Find Your Solution</span> <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="semi-banner__content pb-0">
                                <div class="heading">
                                    <h3 class="heading__title mb-30">We have decades of work experience!</h3>
                                </div><!-- /.heading -->
                                <h4 class="banner__subheading">Consulting & Insights</h4>
                                <p class="heading_desc">Our objective insights steer you toward the right decisions on
                                    issues that
                                    matter.</p>
                                <h4 class="banner__subheading">Research & Advisory</h4>
                                <p class="heading_desc">Our combination of research, problem solving and hands-on
                                    experience.</p>
                                <h4 class="banner__subheading">Strategic Advice</h4>
                                <p class="heading_desc">Tools to help turn strategy into decisions, and execute for
                                    measurable
                                    results.</p>
                            </div>
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                </div><!-- /.semi-banner -->
                <section class="awards bg-secondary">
                    <div class="row heading heading-light mb-60">
                        <div class="col-sm-6">
                            <h3 class="heading__title">Our awards and recognitions</h3>
                        </div><!-- /col-lg-5 -->
                        <div class="col-sm-6">
                            <p class="heading__desc">Trusted by the world's best organizations, for 21 years and
                                running, it has
                                been delivering smiles to hundreds of IT advisors, developers, users, and business
                                owners.
                            </p>
                        </div><!-- /.col-lg-5 -->
                    </div><!-- /.row -->
                    <div class="row awards-wrapper">
                        <div class="col-sm-12">
                            <div class="awards-carousel-wrapper">
                                <div class="slick-carousel"
                                    data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "arrows": false, "dots": true,"autoplay": true, "autoplaySpeed": 4000, "infinite": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 768, "settings": {"slidesToShow": 1}}, {"breakpoint": 570, "settings": {"slidesToShow": 1}}]}'>
                                    <!-- fancybox item #1 -->
                                    <div class="fancybox-item">
                                        <div class="fancybox__icon-img">
                                            <img src="{{ asset('frontend/SmartData') }}/assets/images/awards/icons/1.png"
                                                alt="icon">
                                        </div><!-- /.fancybox__icon-img -->
                                        <div class="fancybox__content">
                                            <h4 class="fancybox__title">CSS Design Award</h4>
                                            <p class="fancybox__desc">A web design & development award platform for
                                                digital folk,
                                                UI/UX
                                                peeps
                                                and inspiring leaders of the web.
                                            </p>
                                        </div><!-- /.fancybox-content -->
                                    </div><!-- /.fancybox-item -->
                                    <!-- fancybox item #2 -->
                                    <div class="fancybox-item">
                                        <span class="pinned-ribbon"></span>
                                        <div class="fancybox__icon-img">
                                            <img src="{{ asset('frontend/SmartData') }}/assets/images/awards/icons/2.png"
                                                alt="icon">
                                        </div><!-- /.fancybox__icon-img -->
                                        <div class="fancybox__content">
                                            <h4 class="fancybox__title">W3 Design Award</h4>
                                            <p class="fancybox__desc">Awards celebrates digital by honoring outstanding
                                                Websites, Web
                                                Marketing, Video, Sites, Apps & Social content.
                                            </p>
                                        </div><!-- /.fancybox-content -->
                                    </div><!-- /.fancybox-item -->
                                    <!-- fancybox item #3 -->
                                    <div class="fancybox-item">
                                        <div class="fancybox__icon-img">
                                            <img src="{{ asset('frontend/SmartData') }}/assets/images/awards/icons/3.png"
                                                alt="icon">
                                        </div><!-- /.fancybox__icon-img -->
                                        <div class="fancybox__content">
                                            <h4 class="fancybox__title">The FWA Award</h4>
                                            <p class="fancybox__desc">Showcasing innovation every day since 2000, our
                                                mission is to
                                                showcase
                                                cutting edge creativity, regardless
                                            </p>
                                        </div><!-- /.fancybox-content -->
                                    </div><!-- /.fancybox-item -->
                                    <!-- fancybox item #4 -->
                                    <div class="fancybox-item">
                                        <div class="fancybox__icon-img">
                                            <img src="{{ asset('frontend/SmartData') }}/assets/images/awards/icons/3.png"
                                                alt="icon">
                                        </div><!-- /.fancybox__icon-img -->
                                        <div class="fancybox__content">
                                            <h4 class="fancybox__title">WWW Awards</h4>
                                            <p class="fancybox__desc">The awards that recognize the talent and effort of
                                                the best web
                                                designers, developers and agencies in the world.
                                            </p>
                                        </div><!-- /.fancybox-content -->
                                    </div><!-- /.fancybox-item -->
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
                    <h2 class="heading__subtitle">Recent Articles</h2>
                    <h3 class="heading__title">Resource Library</h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <!-- Blog Item #1 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/blog/grid/1.jpg" alt="blog image">
                        </a>
                    </div><!-- /.blog-img -->
                    <div class="post__content">
                        <div class="post__meta d-flex flex-wrap">
                            <div class="post__meta-cat">
                                <a href="#">Consulting</a><a href="#">Sales</a>
                            </div><!-- /.blog-meta-cat -->
                            <span class="post__meta-date">May 13, 2020</span>
                        </div>
                        <h4 class="post__title"><a href="#">Five Ways to Develop a World Class Sales Operations
                                Function</a>
                        </h4>
                        <p class="post__desc">Outsourcing IT infrastructure is a concept that has been around for a
                            while.
                            Characterized in terms of technicians and engineers, workstations and servers, the idea of
                            outsourcing
                            your basic IT needs...
                        </p>
                        <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                            <span>Read More</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.blog-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            <!-- Blog Item #2 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/blog/grid/2.jpg" alt="blog image">
                        </a>
                    </div><!-- /.blog-img -->
                    <div class="post__content">
                        <div class="post__meta d-flex flex-wrap">
                            <div class="post__meta-cat">
                                <a href="#">Tech</a><a href="#">Communications</a>
                            </div><!-- /.blog-meta-cat -->
                            <span class="post__meta-date">April 17, 2020</span>
                        </div>
                        <h4 class="post__title"><a href="#">Succession Risks That Threaten Your Leadership Strategy</a>
                        </h4>
                        <p class="post__desc">Today’s organizations need a quality bench of leaders to drive business
                            outcomes and satisfy employees, customers and investors who now demand more transparency and
                            accountability...
                        </p>
                        <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                            <span>Read More</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.blog-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            <!-- Blog Item #3 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/blog/grid/3.jpg" alt="blog image">
                        </a>
                    </div><!-- /.blog-img -->
                    <div class="post__content">
                        <div class="post__meta d-flex flex-wrap">
                            <div class="post__meta-cat">
                                <a href="#">Digital Business</a><a href="#">Cloud</a>
                            </div><!-- /.blog-meta-cat -->
                            <span class="post__meta-date">March 20, 2020</span>
                        </div>
                        <h4 class="post__title"><a href="#">What Do Employee Engagement Surveys Tell You About
                                Employee?</a>
                        </h4>
                        <p class="post__desc">Outsourcing IT infrastructure is a concept that has been around for a
                            while.
                            Characterized in terms of technicians and engineers, workstations and servers, the idea of
                            outsourcing
                            your basic IT needs...
                        </p>
                        <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                            <span>Read More</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.blog-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog Grid -->
@endsection