<?php
$getKonfigurasi = Check::getKonfigurasi();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Smart Data  IT Solutions &  Services Template">
    <link href="{{ asset('upload/konfigurasi/') }}/{{$getKonfigurasi->logo_konfigurasi}}" alt="logo-aplikasi" rel="icon">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800;900&family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('frontend/SmartData/') }}/assets/css/libraries.css">
    <link rel="stylesheet" href="{{ asset('frontend/SmartData/') }}/assets/css/style.css">
    <link href="{{ asset('library/photoviewer-master') }}/dist/photoviewer.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('library/leaflet/dist/leaflet.css') }}">

    @stack('css')
</head>

<body>
    <div class="wrapper">
        @include('layouts.partials.user.preloading')

        <!-- =========================
        Header 
    =========================== -->
        @include('layouts.partials.user.header')
        <!-- /.Header -->

        @yield('content')

        @include('layouts.partials.user.footer')
        <!-- /.Footer -->


        <!-- /.login-popup -->
        @include('layouts.partials.user.loginpopup')

        @include('layouts.partials.user.registerpopup')
        <!-- /.login-popup -->
    </div><!-- /.wrapper -->

    <script src="{{ asset('frontend/SmartData/') }}/assets/js/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('frontend/SmartData/') }}/assets/js/plugins.js"></script>
    <script src="{{ asset('frontend/SmartData/') }}/assets/js/main.js"></script>
    <script src="{{ asset('library/photoviewer-master') }}/dist/photoviewer.js"></script>
    <script src="{{ asset('library/leaflet/dist/leaflet.js') }}"></script>

    @stack('js')
</body>

</html>