<?php
$getKonfigurasi = Check::getKonfigurasi();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="{{ $getKonfigurasi->deskripsi_konfigurasi }}">
    <link href="{{ asset('upload/konfigurasi/') }}/{{$getKonfigurasi->logo_konfigurasi}}" alt="logo-aplikasi" rel="icon">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800;900&family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('frontend/SmartData/') }}/assets/css/libraries.css">
    <link rel="stylesheet" href="{{ asset('frontend/SmartData/') }}/assets/css/style.css">
    <link href="{{ asset('library/photoviewer-master') }}/dist/photoviewer.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('library/leaflet/dist/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2-develop/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('library/sweetalert2/dist/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <script src="{{ asset('library/select2-develop/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('library/datatable/DataTables-1.13.1/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('library/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('js')
</body>

</html>