{{-- <?php
$getKonfigurasi = Check::getKonfigurasi();
$currentUrl = Check::getCurrentUrl();
?>

<header class="header header-transparent">
    <nav class="navbar navbar-expand-lg sticky-navbar">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('upload/konfigurasi/') }}/{{$getKonfigurasi->logo_konfigurasi}}" class="logo-light" alt="logo" height="50px;">
                <img src="{{ asset('upload/konfigurasi/') }}/{{ $getKonfigurasi->logo_konfigurasi }}" class="logo-dark" alt="logo" height="50px;">
            </a>
            <button class="navbar-toggler" type="button">
                <span class="menu-lines"><span></span></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavigation">
                <ul class="navbar-nav ml-auto">
                    <li class="nav__item">
                        <a href="#home" id="link_home" class="text-header font-weight-bold">Home</a>
                    </li><!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="#about" id="link_about" class="text-header font-weight-bold">About</a>
                    </li><!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="#timSukses" id="link_timSukses" class="text-header font-weight-bold">Aktivitas</a>
                    </li>

                    <li class="nav__item">
                        <a href="#gallery" id="link_gallery" class="text-header font-weight-bold">Gallery</a>
                    </li><!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="#statusPendaftaran" id="link_statusPendaftaran" class="text-header font-weight-bold">Cek Status</a>
                    </li><!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="#contactUs" id="link_contactUs" class="text-header font-weight-bold">Kontak</a>
                    </li><!-- /.nav-item -->

                </ul><!-- /.navbar-nav -->
            </div><!-- /.navbar-collapse -->
            <ul class="navbar-actions list-unstyled mb-0 d-flex align-items-center">
                <li class="d-none d-xl-block">
                    <a href="{{ url('/register') }}" class="btn action__btn-contact"><i class="fas fa-user-tag"></i>
                        DAFTAR
                    </a>
                </li>
                <!-- <li>
                    <a href="{{ url('/login') }}" class="action__btn action__btn-login" style="cursor: pointer;">
                        <i class="icon-user"></i><span>Login</span>
                    </a>
                </li> -->
            </ul><!-- /.navbar-actions -->
        </div><!-- /.container -->
    </nav><!-- /.navabr -->
</header> --}}
<?php
$getKonfigurasi = Check::getKonfigurasi();
$currentUrl = Check::getCurrentUrl();
?>

<div class="top-bar-area top-bar-style-one bg-dark text-light">
    <div class="container">
        <div class="row align-center">
            <div class="col-xl-6 col-lg-8 offset-xl-3 pl-30 pl-md-15 pl-xs-15">
                <ul class="item-flex">
                    <li>
                        <i class="fas fa-map-marker-alt"></i> Jl. Cirebon Raya No. 23, Kota Cirebon
                    </li>
                    <li>
                        <a href="tel:+4733378901"><i class="fas fa-phone-alt"></i> 085777400685</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
<!-- End Header Top -->

<!-- Header
    ============================================= -->
<header>
    <!-- Start Navigation -->
    <nav
        class="navbar mobile-sidenav navbar-style-one navbar-sticky navbar-default validnavs white navbar-fixed no-background">

        <div class="container">
            <div class="row align-center">

                <!-- Start Header Navigation -->
                <div class="col-xl-2 col-lg-3 col-md-2 col-sm-1 col-1">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="index-2.html">
                            <img src="{{ asset('assets-frontend/img/logo-baru.png') }}" class="logo" alt="Logo">
                        </a>
                    </div>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="col-xl-6 offset-xl-1 col-lg-6 col-md-4 col-sm-4 col-4">
                    <div class="collapse navbar-collapse" id="navbar-menu">

                        <img src="assets/img/logo.png" alt="Logo">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-times"></i>
                        </button>

                        <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                            <li class="nav__item">
                                <a href="#home" id="link_home" class="dropdown-toggle active"
                                    data-toggle="dropdown">Home</a>

                            </li>
                            <li class="nav__item">
                                <a href="#about" id="link_about" class="dropdown-toggle"
                                    data-toggle="dropdown">About</a>

                            </li>
                            <li class="nav__item">
                                <a href="#timSukses" id="link_timSukses" href="project.html" class="dropdown-toggle"
                                    data-toggle="dropdown">Contribute</a>

                            </li>
                            <li class="nav__item">
                                <a href="#gallery" id="link_gallery" class="dropdown-toggle"
                                    data-toggle="dropdown">Gallery</a>

                            </li>

                            <li class="nav__item"><a href="#contactUs" id="link_contactUs">contact</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.navbar-collapse -->

                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-7 col-7">
                    <div class="attr-right">
                        <!-- Start Atribute Navigation -->
                        <div class="attr-nav">
                            <ul>
                                <li class="button">
                                    <a href="{{ url('/login') }}">LOGIN</a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Atribute Navigation -->

                    </div>
                </div>

            </div>
            <!-- Main Nav -->

            <!-- Overlay screen for menu -->
            <div class="overlay-screen"></div>
            <!-- End Overlay screen for menu -->
        </div>
    </nav>
    <!-- End Navigation -->
</header>
