<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Smart Data  IT Solutions &  Services Template">
    <link href="{{ asset('frontend/SmartData/') }}/assets/images/favicon/favicon.png" rel="icon">
    <title>Smart Data IT Solutions & Services Template</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800;900&family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('frontend/SmartData/') }}/assets/css/libraries.css">
    <link rel="stylesheet" href="{{ asset('frontend/SmartData/') }}/assets/css/style.css">
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
</body>

</html>