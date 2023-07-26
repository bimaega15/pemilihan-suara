@extends('layouts.user')

@section('title')
Home Page
@endsection

@section('content')
<!-- ============================
                                            Slider
                                        ============================== -->
@php
$getKonfigurasi = Check::getKonfigurasi();
@endphp
<section class="slider">
    <div class="slick-carousel m-slides-0" data-slick='{"slidesToShow": 1, "arrows": true, "dots": false, "speed": 700,"fade": true,"cssEase": "linear"}'>
        <div class="slide-item align-v-h">
            <div class="bg-img"><img src="{{ asset('upload/assets/home.jpg') }}" alt="Home">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                        <div class="slide__content">
                            <h2 class="slide__title">Memberikan medis terbaik </h2>
                            <p class="slide__desc">Beberapa step dalam melakukan konsultasi gejala diagnosa kecenderungan anak dalam bermain gadget.</p>
                            <ul class="features-list list-unstyled mb-0 d-flex flex-wrap">
                                <!-- feature item #1 -->
                                <li class="feature-item">
                                    <div class="feature__icon">
                                        <i class="icon-user"></i>
                                    </div>
                                    <h2 class="feature__title">Form Identitas</h2>
                                </li><!-- /.feature-item-->
                                <!-- feature item #2 -->
                                <li class="feature-item">
                                    <div class="feature__icon">
                                        <i class="fa-solid fa-disease"></i>
                                    </div>
                                    <h2 class="feature__title">Form Gejala </h2>
                                </li><!-- /.feature-item-->
                                <!-- feature item #3 -->
                                <li class="feature-item">
                                    <div class="feature__icon">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                    <h2 class="feature__title">Hasil Diagnosa</h2>
                                </li><!-- /.feature-item-->
                                <!-- feature item #4 -->
                                <li class="feature-item">
                                    <div class="feature__icon">
                                        <i class="fa-solid fa-print"></i>
                                    </div>
                                    <h2 class="feature__title">Cetak Hasil</h2>
                                </li><!-- /.feature-item-->
                            </ul><!-- /.features-list -->
                        </div><!-- /.slide-content -->
                    </div><!-- /.col-xl-7 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.slide-item -->
    </div><!-- /.carousel -->
</section>
<!-- /.slider -->

<!-- ============================
                                        contact info
                                    ============================== -->
<section class="contact-info py-0">
    <div class="container">
        <div class="row row-no-gutter boxes-wrapper">
            <div class="col-sm-12 col-md-4">
                <div class="contact-box d-flex">
                    <div class="contact__icon">
                        <i class="icon-call3"></i>
                    </div><!-- /.contact__icon -->
                    <div class="contact__content">
                        <h2 class="contact__title">Kontak Kami</h2>
                        <p class="contact__desc">Silahkan hubungi kontak kami dengan staf resepsionis kami yang ramah atau pertanyaan medis </p>
                        <a href="tel:{{ $getKonfigurasi->nohp_konfigurasi }}" class="phone__number">
                            <i class="icon-phone"></i> <span>{{ $getKonfigurasi->nohp_konfigurasi }}</span>
                        </a>
                    </div><!-- /.contact__content -->
                </div><!-- /.contact-box -->
            </div><!-- /.col-md-4 -->

            <div class="col-sm-12 col-md-4">
                <div class="contact-box d-flex">
                    <div class="contact__icon">
                        <i class="icon-health-report"></i>
                    </div><!-- /.contact__icon -->
                    <div class="contact__content">
                        <h2 class="contact__title">Konsultasi Diagnosa</h2>
                        <p class="contact__desc">Silahkan kunjungi link berikut untuk melakukan diagnosa gejala agar anda mengetahui hasil diagnosa pada anda</p>
                        <a href="{{ url('/users/diagnosa') }}" class="btn btn__white btn__outlined btn__rounded">
                            <span>Konsultasi Gejala</span><i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.contact__content -->
                </div><!-- /.contact-box -->
            </div><!-- /.col-md-4 -->

            <div class="col-sm-12 col-md-4">
                <div class="contact-box d-flex">
                    <div class="contact__icon">
                        <i class="icon-heart2"></i>
                    </div><!-- /.contact__icon -->
                    <div class="contact__content">
                        <h2 class="contact__title">Buka Pada Jam</h2>
                        <ul class="time__list list-unstyled mb-0">
                            <li><span>Senin - Jumat</span> &nbsp;<span>08:00 - 17:00</span></li>
                            <li><span>Sabtu</span> &nbsp;<span>09:00 - 22:00</span></li>
                            <li><span>Sunday</span> &nbsp;<span>10:00 - 24:00</span></li>
                        </ul>
                    </div><!-- /.contact__content -->
                </div><!-- /.contact-box -->
            </div><!-- /.col-md-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.contact-info -->

<!-- ========================
                                      About Layout 2
                                    =========================== -->
<section class="about-layout2 pb-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 offset-lg-1">
                <div class="heading-layout2">
                    <h3 class="heading__title mb-60"> Tingkatkan Kualitas kehidupanmu melalui kesehatan yang lebih baik</h3>
                </div><!-- /heading -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-5">
                <div class="text-with-icon">
                    <div class="text__icon">
                        <i class="icon-doctor"></i>
                    </div>
                    <div class="text__content">
                        <p class="heading__desc font-weight-bold color-secondary mb-30">
                            Tujuan kami adalah untuk memberikan kualitas perawatan yang baik, bertanggung jawab, dan berkualitas. kami berharap anda mengizikan kami untuk merawat anda dan berusaha untuk menjadi yang pertama dan pilihan yang terbaik dalam pelayanan kesehatan
                        </p>
                        <a href="{{ url('/users/diagnosa') }}" class="btn btn__secondary btn__rounded mb-70">
                            <span>Konsultasi Gejala</span> <i class="icon-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="video-banner-layout2 bg-overlay">
                    <img src="{{ asset('frontend/medcity/') }}/assets/images/about/2.jpg" alt="about" class="w-100">
                    <a class="video__btn video__btn-white popup-video" href="https://www.youtube.com/watch?v=kTlv5_Bs8aw">
                        <div class="video__player">
                            <i class="fa fa-play"></i>
                        </div>
                        <span class="video__btn-title color-white">
                            Tonton Video Kami
                        </span>
                    </a>
                </div><!-- /.video-banner -->
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-7">
                <div class="about__text bg-white">
                    <p class="heading__desc mb-30">
                        Tujuan kami adalah untuk memberikan kualitas perawatan yang baik, bertanggung jawab, dan berkualitas. kami berharap anda mengizikan kami untuk merawat anda dan berusaha untuk menjadi yang pertama dan pilihan yang terbaik dalam pelayanan kesehatan
                    </p>
                    <p class="heading__desc mb-30">
                        Kami akan bekerja dengan kamu untuk mengembangkan rencana pelayanan mandiri termasukan manajemen dari diagnosa krisis. Kami berkomitmen to menjadi daerah perdana jaringan pelayanan kesehatan menyediakan pusat pelayanan pasien dengan klinik yang menginspirasi dan pelayanan terbaik</p>
                    <ul class="list-items list-unstyled">
                        <li>
                            Kami melakukan serangkaian test untuk membantu kami mencari tahu mengapa anda tidak merasak enak dan menentukan tindakan yang benar untuk mu.
                        </li>
                        <li>
                            Keahlian sistem kami dalam memanajemen pasien dengan sebuah serangkaian masalah masalah kesehatan
                        </li>
                        <li>
                            Kami menawarkan berbagai perawatan dan dukungan untuk pasien kami dari diagnosis ke tindakan dan rehabilitasi
                        </li>
                    </ul>
                </div>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
<!-- /.About Layout 2 -->


<!-- ========================
                                        Notses
                                    =========================== -->
<section class="notes border-top pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="note font-weight-bold">
                    <i class="far fa-file-alt color-primary"></i>
                    <span>Sampaikanlah Besok Perawatan Kesehatan untuk keluarga anda.</span>
                    <a href="{{ url('/contacts') }}" class="btn btn__link btn__secondary">
                        <span>Lihat Contacts</span><i class="icon-arrow-right"></i>
                    </a>
                </div>
            </div><!-- /.col-sm-6 -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="info__meta d-flex flex-wrap justify-content-between align-items-center">
                    <div class="testimonials__rating">
                        <div class="testimonials__rating-inner d-flex align-items-center">
                            <span class="total__rate">5.0</span>
                            <div>
                                <span class="overall__rate">Peringkat keseluruhan</span>
                                <span>, berdasarkan pada 7541 reviews.</span>
                            </div>
                        </div><!-- /.testimonials__rating-inner -->
                    </div><!-- /.testimonials__rating -->
                    <a href="{{ url('/users/diagnosa') }}" class="btn btn__primary btn__rounded">
                        <span>Konsultasi Gejala</span> <i class="icon-arrow-right"></i>
                    </a>
                </div><!-- /.info__meta -->
            </div><!-- /.col-sm-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.notes -->



<!-- ====================== Work Process ========================= -->
<section class="work-process work-process-carousel pt-130 pb-0 bg-overlay bg-overlay-secondary">
    <div class="bg-img"><img src="{{ asset('frontend/medcity/') }}/assets/images/banners/1.jpg" alt="background">
    </div>
    <div class="container">
        <div class="row heading-layout2">
            <div class="col-12">
                <h2 class="heading__subtitle color-primary">Merawat Kesehatan Anda dan Keluarga Anda</h2>
            </div><!-- /.col-12 -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-5">
                <h3 class="heading__title color-white">
                    Kita Menyediakan semua aspek dari praktek kesehatan untuk keseluruhan keluarga anda
                </h3>
            </div><!-- /.col-xl-5 -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 offset-xl-1">
                <p class="heading__desc font-weight-bold color-gray mb-40">
                    Kita akan bekerja dengan anda untuk mengembangkan rencana pelayanan individual termasuk management dari diagnosa kronis.
                    Jika kita tidak membantu, Kita bisa menyediakan refereal atau petunjuk tentang jenis dari kewajiban praktisi. Kami memperlakukan semua pertanyaan sensitif dan paling ketat kepercayaannya.
                </p>
                <ul class="list-items list-items-layout2 list-items-light list-horizontal list-unstyled">
                    <li>Fraktur dan Dislokasi</li>
                    <li>Assesment Kesehatan</li>
                    <li>Injeksi Desensitisasi</li>
                    <li>Perawatan Berkualitas Tinggi</li>
                </ul>
            </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="carousel-container mt-90">
                    <div class="slick-carousel" data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "infinite":false, "arrows": false, "dots": false, "responsive": [{"breakpoint": 1200, "settings": {"slidesToShow": 3}}, {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                        <!-- process item #1 -->
                        <div class="process-item">
                            <span class="process__number">01</span>
                            <div class="process__icon">
                                <i class="icon-user"></i>
                            </div><!-- /.process__icon -->
                            <h4 class="process__title">Pengisian identitas diri pada form diagnosa</h4>
                            <p class="process__desc">Sebelum anda melakukan konsultasi gejala, terlebih dahulu anda mengisi bidoata diri.</p>
                        </div><!-- /.process-item -->
                        <!-- process-item #2 -->
                        <div class="process-item">
                            <span class="process__number">02</span>
                            <div class="process__icon">
                                <i class="fa-solid fa-disease"></i>
                            </div><!-- /.process__icon -->
                            <h4 class="process__title">Pengisian Form Gejala</h4>
                            <p class="process__desc">
                                Isi beberapa gejala yang sesuai dengan yang anda alami sekarang
                            </p>
                        </div><!-- /.process-item -->
                        <!-- process-item #3 -->
                        <div class="process-item">
                            <span class="process__number">03</span>
                            <div class="process__icon">
                                <i class="fa-solid fa-book"></i>
                            </div><!-- /.process__icon -->
                            <h4 class="process__title">Hasil Diagnosa</h4>
                            <p class="process__desc">
                                Anda dapat melihat hasil dari gejala-gejala yang anda alami
                            </p>
                        </div><!-- /.process-item -->
                        <!-- process-item #4 -->
                        <div class="process-item">
                            <span class="process__number">04</span>
                            <div class="process__icon">
                                <i class="fa-solid fa-print"></i>
                            </div><!-- /.process__icon -->
                            <h4 class="process__title">Cetak hasil</h4>
                            <p class="process__desc">Anda dapat mencetak hasil diagnosa dari halaman hasil diagnosa yang anda dapatkan </p>
                        </div><!-- /.process-item -->
                        <!-- process-item #5 -->
                        <div class="process-item">
                            <span class="process__number">05</span>
                            <div class="process__icon">
                                <i class="icon-head"></i>
                            </div><!-- /.process__icon -->
                            <h4 class="process__title">Your custom Next process</h4>
                            <p class="process__desc">Our administration and support staff have exceptional
                                skills to assist you.
                            </p>
                            <a href="#" class="btn btn__secondary btn__link">
                                <span>Meet Our Doctors</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.process-item -->
                    </div><!-- /.carousel -->
                </div>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
    <div class="cta bg-light-blue">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-2 col-lg-2">
                    <img src="{{ asset('frontend/medcity/') }}/assets/images/icons/alert2.png" alt="alert">
                </div><!-- /.col-lg-2 -->
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <h4 class="cta__title">Kesehatan yang pasti untuk keluarga anda</h4>
                    <p class="cta__desc">
                        Melayani masyarakat dalam meningkatkan kualitas hidup melalui keseahatan yang lebih baik. Kita menempatkan protokol untuk melindungi pasien kami dan staff sambil terus memberikan perawatan medis yang diperlukan
                    </p>
                </div><!-- /.col-lg-7 -->
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <a href="{{ url('/users/diagnosa') }}" class="btn btn__primary btn__secondary-style2 btn__rounded">
                        <span>Program Kesehatan</span>
                        <i class="icon-arrow-right"></i>
                    </a>
                </div><!-- /.col-lg-3 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.cta -->
</section><!-- /.Work Process -->
@endsection