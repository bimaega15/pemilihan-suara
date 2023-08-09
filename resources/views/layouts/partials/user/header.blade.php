<?php
$getKonfigurasi = Check::getKonfigurasi();
$currentUrl = Check::getCurrentUrl();
?>

<header class="header header-transparent">
    <nav class="navbar navbar-expand-lg sticky-navbar">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('upload/konfigurasi/') }}/{{$getKonfigurasi->logo_konfigurasi}}" class="logo-light"
                    alt="logo" height="50px;">
                <img src="{{ asset('upload/konfigurasi/') }}/{{ $getKonfigurasi->logo_konfigurasi }}" class="logo-dark"
                    alt="logo" height="50px;">
            </a>
            <button class="navbar-toggler" type="button">
                <span class="menu-lines"><span></span></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavigation">
                <ul class="navbar-nav ml-auto">
                    <li class="nav__item">
                        <a href="{{ url('/') }}"
                            class="nav__item-link {{$currentUrl == '/' || $currentUrl == '/home' ? 'active' : ''}}">Home</a>
                    </li><!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="{{ url('/about') }}"
                            class="nav__item-link {{$currentUrl == '/about' ? 'active' : ''}}">About</a>
                    </li><!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="{{ url('/') }}"
                            class="nav__item-link {{$currentUrl == '/gallery' ? 'active' : ''}}">Gallery</a>
                    </li><!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="{{ url('/contactUs') }}"
                            class="nav__item-link {{$currentUrl == '/contactUs' ? 'active' : ''}}">Contact Us</a>
                    </li><!-- /.nav-item -->
                    <li class="nav__item">
                        <a href="{{ url('/tps') }}"
                            class="nav__item-link {{$currentUrl == '/tps' ? 'active' : ''}}">TPS</a>
                    </li><!-- /.nav-item -->

                </ul><!-- /.navbar-nav -->
            </div><!-- /.navbar-collapse -->
            <ul class="navbar-actions list-unstyled mb-0 d-flex align-items-center">
                <li class="d-none d-xl-block">
                    <a href="request-quote.html" class="btn action__btn-contact"><i class="fas fa-user-tag"></i>
                        Pendaftaran C.O
                    </a>
                </li>
                <li>
                    <button class="action__btn action__btn-login open-login-popup">
                        <i class="icon-user"></i><span>Login</span>
                    </button>
                </li>
            </ul><!-- /.navbar-actions -->
        </div><!-- /.container -->
    </nav><!-- /.navabr -->
</header>