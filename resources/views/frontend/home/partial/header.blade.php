<header id="dtr-header-global" class="fixed-top">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">

            <!-- header left starts -->
            <div class="dtr-header-left">

                <!-- logo -->
                <a class="logo-default dtr-scroll-link" href="#home"><img
                        src="{{ asset('upload/konfigurasi/' . $getKonfigurasi->logo_konfigurasi) }}"
                        alt="{{ $getKonfigurasi->logo_konfigurasi }}" height="50px;"></a>

                <!-- logo on scroll -->
                <a class="logo-alt dtr-scroll-link" href="#home"><img
                        src="{{ asset('upload/konfigurasi/' . $getKonfigurasi->logo_konfigurasi) }}"
                        alt="{{ $getKonfigurasi->logo_konfigurasi }}" height="50px;"></a>
                <!-- logo on scroll ends -->

            </div>
            <!-- header left ends -->

            <!-- menu starts-->
            <div class="main-navigation navbar navbar-expand-lg ml-auto">
                <ul class="dtr-scrollspy navbar-nav dtr-nav dark-nav-on-load dark-nav-on-scroll">
                    <li class="nav-item"> <a class="nav-link active" href="#home">Home</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#about">About</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#checkStatus">Status Pendaftaran</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#gallery">Gallery</a> </li>
                </ul>
            </div>
            <!-- menu ends-->

            <!-- header right starts -->
            <div class="dtr-header-right"> <a href="{{ url('/login') }}" class="dtr-btn btn-rounded btn-orange">Login
                    Sekarang</a> </div>
            <!-- header right ends -->

        </div>
    </div>
</header>
