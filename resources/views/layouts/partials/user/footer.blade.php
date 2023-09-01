@php
$konfigurasi = Check::getKonfigurasi();
@endphp

<footer class="footer footer-dark">
    <div class="footer-primary">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3 footer-widget footer-widget-about">
                    <div class="footer-widget__content">
                        <img src="{{ asset('upload/konfigurasi/'.$konfigurasi->logo_konfigurasi) }}" alt="logo" class="mb-30" style="width: 60%;">
                    </div><!-- /.footer-widget__content -->
                </div><!-- /.col-xl-3 -->
                <div class="col-sm-6 col-md-4 col-lg-4 footer-widget footer-widget-nav">
                    <h6 class="footer-widget__title">Tentang Kami</h6>
                    <div class="footer-widget__content" style="color: #ffffff;">
                        KANG ASEP SHOLEH sekarangpun menjabat sebagai Sekretaris DPD Partai Amanat Nasional (PAN) dan memantapkan Maju menjadi Anggota DPRD dapil Ill Kota Cirebon
                    </div><!-- /.footer-widget__content -->
                </div><!-- /.col-lg-2 -->
                <div class="col-sm-6 col-md-4 col-lg-2 footer-widget footer-widget-nav">
                    <h6 class="footer-widget__title">Site Map</h6>
                    <div class="footer-widget__content">
                        <nav>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('/gallery') }}">About</a></li>
                                <li><a href="{{ url('/gallery') }}">Aktivitas</a></li>
                                <li><a href="{{ url('/gallery') }}">Gallery</a></li>
                                <li><a href="{{ url('/gallery') }}">Cek Status</a></li>
                            </ul>
                        </nav>
                    </div><!-- /.footer-widget__content -->
                </div><!-- /.col-lg-2 -->
                <div class="col-sm-6 col-md-4 col-lg-2 footer-widget footer-widget-nav">
                    <h6 class="footer-widget__title">Bergabung</h6>
                    <div class="footer-widget__content">
                        <nav>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('/tps') }}">Daftar Koordinator</a></li>
                                <li><a href="{{ url('/tps') }}">Pendukung</a></li>
                                <li><a href="{{ url('/tps') }}">Login</a></li>
                            </ul>
                        </nav>
                    </div><!-- /.footer-widget__content -->
                </div><!-- /.col-lg-2 -->
                <!-- /.col-lg-3 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.footer-primary -->
    <div class="footer-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="footer__copyrights">
                        <span class="fz-14">&copy; 2023 Partai PAN, All Rights Reserved.</span>
                        </a>
                    </div>
                </div><!-- /.col-lg-6 -->
                <div class="col-sm-12 col-md-2 col-lg-2 text-center">
                    <button id="scrollTopBtn" class="my-2"><i class="icon-arrow-up-2"></i></button>
                </div><!-- /.col-lg-2 -->
                <div class="col-sm-12 col-md-5 col-lg-5 d-flex flex-wrap justify-content-end align-items-center">
                    <ul class="social-icons list-unstyled mb-0 mr-30">
                        <li><a href="{{ $konfigurasi->facebook_konfigurasi }}"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{ $konfigurasi->instagram_konfigurasi }}"><i class="fab fa-instagram"></i></a></li>
                        <li>
                            <a href="{{ $konfigurasi->youtube_konfigurasi }}">
                                <i class="fab fa-youtube"></i>
                            </a>

                        </li>
                    </ul><!-- /.social-icons -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.footer-secondary -->
</footer>