@php
$getKonfigurasi = Check::getKonfigurasi();
@endphp
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>@yield('title')</title>
    <meta name="author" content="{{ $getKonfigurasi->created_konfigurasi }}">
    <meta name="description" content="{{ $getKonfigurasi->deskripsi_konfigurasi }}">
    <meta name="keywords" content="Suara, TPS, PAN, Aplikasi Suara, Aplikasi Pengelolaan Suara">

    <!-- FAVICON FILES -->
    <link rel="shortcut icon" href="{{ asset('upload/konfigurasi/'.$getKonfigurasi->logo_konfigurasi) }}" type="image/x-icon">
    <!-- CSS FILES -->
    <link rel="stylesheet" href="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/fonts/iconfonts.css">
    <link rel="stylesheet" href="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/css/plugins.css">
    <link rel="stylesheet" href="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/css/responsive.css">
    <link rel="stylesheet" href="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/css/color-blue.css">
    <link rel="stylesheet" href="{{ asset('library/owl-carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/sweetalert2/dist/sweetalert2.min.css') }}">

    <style>
        .dtr-menu-dark .nav-link {
            color: #9b9b9b;
        }

        .dtr-menu-dark .active {
            color: #fd5a49;
        }
    </style>
</head>

<body>
    <div id="dtr-wrapper" class="clearfix">

        <!-- preloader starts -->
        <div class="dtr-preloader">
            <div class="dtr-preloader-inner">
                <div class="dtr-preloader-img"></div>
            </div>
        </div>
        <!-- preloader ends -->

        <!-- Small Devices Header 
============================================= -->
        <div class="dtr-responsive-header fixed-top">
            <div class="container">

                <!-- small devices logo -->
                <a href="index.html"><img src="{{ asset('upload/konfigurasi/'.$getKonfigurasi->logo_konfigurasi) }}" alt="{{ $getKonfigurasi->logo_konfigurasi }}"></a>
                <!-- small devices logo ends -->

                <!-- menu button -->
                <button id="dtr-menu-button" class="dtr-hamburger" type="button"><span class="dtr-hamburger-lines-wrapper"><span class="dtr-hamburger-lines"></span></span></button>
            </div>
            <div class="dtr-responsive-header-menu"></div>
        </div>
        <!-- Small Devices Header ends 
============================================= -->

        <!-- Header 
============================================= -->
        @include('frontend.home.partial.header', [
        'getKonfigurasi' => $getKonfigurasi]
        )
        <!-- header ends
================================================== -->

        <!-- == main content area starts == -->
        <div id="dtr-main-content">

            <!-- hero section starts
================================================== -->
            @include('frontend.home.partial.home')
            <!-- hero section ends
================================================== -->

            <!-- section starts
================================================== -->
            <section id="about" class="dtr-section dtr-pt-100 dtr-pb-80 bg-blue">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="color-white mb-5">Tentang Kami</h2>
                            <div class="text-size-xl color-white text-left" style="font-size: 22px;">
                                {!! $about->keterangan_about !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section ends
================================================== -->

            <!-- section starts
================================================== -->
            <section class="dtr-section dtr-py-100">
                <div class="container">

                    <!-- circle bg icon -->
                    <div class="dtr-circle-icon bg-white color-orange"><i class="icon-mbri-down"></i></div>

                    <!-- row 1 starts -->
                    <div class="row align-items-center">

                        <!-- column 1 starts -->
                        <div class="col-12 col-md-12 dtr-md-mb-30">
                            <div class="text-center">
                                <p class="text-grad-orange font-weight-700" style="font-size: 30px;">Team Partai</p>
                                <h2>Tim Sukses Partai PAN</h2>
                            </div>

                            <div style="height: 40px;"></div>

                            <div class="owl-carousel owl-theme">

                                @if ($about != null)
                                @php
                                $parseTeam = json_decode($about->teamdetail_about, true);
                                @endphp
                                @foreach ($parseTeam as $item)

                                <div class="item">
                                    <div class="card p-1 shadow rounded" style="width: 100%;">
                                        <img class="card-img-top" src="{{ asset('upload/about/team/'.$item) }}" alt="{{ $item }}" style="width: 100%; height: 400px;">
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- column 1 ends -->
                    </div>
                    <!-- row 1 ends -->
                </div>
            </section>
            <!-- section ends
================================================== -->

            <!-- hashtag section starts
================================================== -->
            <section class="dtr-section hashtag-section-padding dtr-section-with-bg parallax" style="background-image: url({{ asset('assets/images/bg-image.jpg') }});">
                <div class="dtr-overlay bg-dark-blue-trans"></div>
                <div class="container dtr-overlay-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <p class="text-grad-orange font-weight-700" style="font-size: 30px;">Sponsor</p>
                                <h2 class="text-white">Team Pendukung Partai PAN</h2>
                            </div>

                            <div style="height: 40px;"></div>

                            <div class="owl-carousel owl-theme">

                                @if ($about != null)
                                @php
                                $parseSponsor = json_decode($about->gambarsponsor_about, true);
                                @endphp
                                @foreach ($parseSponsor as $item)

                                <div class="item">
                                    <div class="card p-1 shadow rounded" style="width: 100%;">
                                        <img class="card-img-top" src="{{ asset('upload/about/sponsor/'.$item) }}" alt="{{ $item }}" style="width: 100%; height: 400px;">
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- hashtag section ends
================================================== -->

            <!-- checkStatus section starts
================================================== -->
            <section id="checkStatus" class="dtr-section dtr-py-100">
                <div class="container">

                    <!-- section intro row starts -->
                    <div class="row dtr-mb-30">
                        <div class="col-12 text-center">
                            <p class="text-grad-orange font-weight-700">
                                Periksa Status Account Pendaftaran Anda
                            </p>
                            <h2>Status Pendaftaran</h2>
                        </div>
                    </div>
                    <!-- section intro row ends -->

                    <!-- row 1 starts -->
                    <div class="row">
                        <div class="col-12 col-md-6 mx-auto">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <span class="text-dark font-weight-bold">
                                        <i class="icon-table"></i> Periksa Pendaftaran
                                    </span>
                                </div>
                                <div class="card-body py-5 px-4">
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
                    <!-- row 1 ends -->
                </div>
            </section>
            <!-- checkStatus section ends
================================================== -->


            <!-- gallery section starts
================================================== -->
            <section id="gallery" class="dtr-section dtr-py-100 bg-grey">
                <div class="container">

                    <!-- section intro row starts -->
                    <div class="row dtr-mb-30">
                        <div class="col-12 text-center">
                            <h2>Gallery</h2>
                            <p class="text-grad-orange font-weight-700">
                                Daftar Gallery Partai PAN
                            </p>
                        </div>
                    </div>
                    <!-- section intro row ends -->

                    <!-- row starts -->
                    <div class="row">

                        <!-- column 1 starts -->
                        <div class="col-12 col-md-4">

                            <!-- blog item 1 starts -->
                            <div class="dtr-blog-item">
                                <!-- image -->
                                <div class="dtr-post-img"> <img src="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/images/blogpost-img1.jpg" alt="image" class="dtr-rounded"> </div>
                                <p class="text-size-sm font-weight-500 color-blue"> <span class="dtr-date">March 18, 2020</span><span class="dtr-author dtr-ml-20">by Admin</span></p>
                                <h5><a href="#">How corona virus is affecting communities around the world</a></h5>
                                <p class="dtr-mb-20">There are many variations of passages of Lorem Ipsum available, but the majority have suffered ...</p>
                                <a href="#" class="font-weight-700">Read More <i class="icon-mbri-right dtr-ml-10"></i></a>
                            </div>
                            <!-- blog item 1 ends -->

                        </div>
                        <!-- column 1 ends -->

                        <!-- column 2 starts -->
                        <div class="col-12 col-md-4 dtr-md-mt-30">

                            <!-- blog item 2 starts -->
                            <div class="dtr-blog-item">
                                <!-- image -->
                                <div class="dtr-post-img"> <img src="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/images/blogpost-img2.jpg" alt="image" class="dtr-rounded"> </div>
                                <p class="text-size-sm font-weight-500 color-blue"> <span class="dtr-date">March 19, 2020</span><span class="dtr-author dtr-ml-20">by Admin</span></p>
                                <h5><a href="#">Trials to begin on Covid-19 vaccine next month</a></h5>
                                <p class="dtr-mb-20">There are many variations of passages of Lorem Ipsum available, but the majority have suffered ...</p>
                                <a href="#" class="font-weight-700">Read More <i class="icon-mbri-right dtr-ml-10"></i></a>
                            </div>
                            <!-- blog item 2 ends -->

                        </div>
                        <!-- column 2 ends -->

                        <!-- column 3 starts -->
                        <div class="col-12 col-md-4 dtr-md-mt-30">

                            <!-- blog item 3 starts -->
                            <div class="dtr-blog-item">
                                <!-- image -->
                                <div class="dtr-post-img"> <img src="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/images/blogpost-img3.jpg" alt="image" class="dtr-rounded"> </div>
                                <p class="text-size-sm font-weight-500 color-blue"> <span class="dtr-date">March 20, 2020</span><span class="dtr-author dtr-ml-20">by Admin</span></p>
                                <h5><a href="#">Airport officers fear exposure as coronavirus cases rise</a></h5>
                                <p class="dtr-mb-20">There are many variations of passages of Lorem Ipsum available, but the majority have suffered ....</p>
                                <a href="#" class="font-weight-700">Read More <i class="icon-mbri-right dtr-ml-10"></i></a>
                            </div>
                            <!-- blog item 3 ends -->

                        </div>
                        <!-- column 3 ends -->

                    </div>
                    <!-- row starts -->

                </div>
            </section>
            <!-- gallery section ends
================================================== -->


            <!-- footer section starts
================================================== -->
            @include('frontend.home.partial.footer', [
            'getKonfigurasi' => $getKonfigurasi])
            <!-- footer section ends
================================================== -->

        </div>
        <!-- == main content area ends == -->

    </div>
    <!-- #dtr-wrapper ends -->

    <!-- JS FILES -->
    <script src="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/js/plugins.js"></script>
    <script src="{{ asset('frontend/svasty-main/svasty-template/svasty') }}/assets/js/custom.js"></script>
    <script src="{{ asset('library/owl-carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('library/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                },
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true
            })
        })
    </script>

    @include('auth.scriptStatus')

</body>

</html>