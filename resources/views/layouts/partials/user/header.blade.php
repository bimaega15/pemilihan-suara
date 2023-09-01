<?php
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
</header>