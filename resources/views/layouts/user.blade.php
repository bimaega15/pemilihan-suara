@php
$getKonfigurasi = Check::getKonfigurasi();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="{{ $getKonfigurasi->nama_konfigurasi }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="{{ asset('upload/konfigurasi/'.$getKonfigurasi->logo_konfigurasi) }}" rel="icon">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="{{ asset('library/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/medcity') }}/assets/css/libraries.css">
    <link rel="stylesheet" href="{{ asset('frontend/medcity') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatable/DataTables-1.13.1/css/dataTables.bootstrap5.min.css') }}">

    <link rel="stylesheet" href="{{ asset('library/leaflet/dist/leaflet.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="{{ asset('library/summernote/summernote.min.css') }}">

    @stack('css')

</head>

<body>
    <div class="wrapper">
        @include('layouts.partials.user.preLoading')
        <!-- =========================
        Header
    =========================== -->
        @include('layouts.partials.user.header')
        <!-- /.Header -->
        @yield('content')
        <!-- ========================
      Footer
    ========================== -->
        @include('layouts.partials.user.footer')
        <!-- /.Footer -->
        <button id="scrollTopBtn"><i class="fas fa-long-arrow-alt-up"></i></button>
    </div><!-- /.wrapper -->

    <script src="{{ asset('frontend/medcity/') }}/assets/js/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('frontend/medcity/') }}/assets/js/plugins.js"></script>
    <script src="{{ asset('frontend/medcity/') }}/assets/js/main.js"></script>
    <script src="{{ asset('library/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('library/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('library/datatable/DataTables-1.13.1/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/leaflet/dist/leaflet.js') }}"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="{{ asset('library/summernote/summernote.min.js') }}"></script>
    <script src=" {{ asset('library/jQuery-Plugin-To-Print-Any-Part-Of-Your-Page-Print/jQuery.print.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.btn-logout', function(e) {
                e.preventDefault();
                $('#modalLogout').modal('show');
            })
        })
    </script>

    @stack('js')
</body>

</html>