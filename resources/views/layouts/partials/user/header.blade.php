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
                        <a href="{{ url('/') }}" class="nav__item-link {{$currentUrl == '/' || $currentUrl == '/home' ? 'active' : ''}}">Home</a>
                    </li><!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="{{ url('/about') }}" class="nav__item-link {{$currentUrl == '/about' ? 'active' : ''}}">About</a>
                    </li><!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="{{ url('/gallery') }}" class="nav__item-link {{$currentUrl == '/gallery' ? 'active' : ''}}">Gallery</a>
                    </li><!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="{{ url('/contactUs') }}" class="nav__item-link {{$currentUrl == '/contactUs' ? 'active' : ''}}">Contact Us</a>
                    </li><!-- /.nav-item -->
                    <!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="{{ url('/statusPendaftaran') }}" class="nav__item-link {{$currentUrl == '/statusPendaftaran' ? 'active' : ''}}">Status Pendaftaran</a>
                    </li><!-- /.nav-item -->

                </ul><!-- /.navbar-nav -->
            </div><!-- /.navbar-collapse -->
            <ul class="navbar-actions list-unstyled mb-0 d-flex align-items-center">
                <li class="d-none d-xl-block">
                    <a href="{{ url('/register') }}" class="btn action__btn-contact"><i class="fas fa-user-tag"></i>
                        Registrasi
                    </a>
                </li>
                <li>
                    <a href="{{ url('/login') }}" class="action__btn action__btn-login" style="cursor: pointer;">
                        <i class="icon-user"></i><span>Login</span>
                    </a>
                </li>
            </ul><!-- /.navbar-actions -->
        </div><!-- /.container -->
    </nav><!-- /.navabr -->
</header>