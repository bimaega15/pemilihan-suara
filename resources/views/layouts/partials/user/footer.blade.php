<footer class="footer">
    <div class="footer-primary">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="footer-widget-about">
                        <img src="{{ asset('frontend/medcity/') }}/assets/images/logo/logo-light.png" alt="logo" class="mb-30">
                        <p class="color-gray">
                            Tujuan kami adalah untuk memberikan kualitas perawatan yang baik, bertanggung jawab, dan berkualitas. kami berharap anda mengizikan kami untuk merawat anda dan berusaha untuk menjadi yang pertama dan pilihan yang terbaik dalam pelayanan kesehatan
                        </p>
                        <a href="{{ url('/users/diagnosa') }}" class="btn btn__primary btn__primary-style2 btn__link">
                            <span>Diagnosa</span> <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.footer-widget__content -->
                </div><!-- /.col-xl-2 -->

                <div class="col-sm-6 col-md-6 col-lg-2">
                </div><!-- /.col-lg-2 -->
                <div class="col-sm-6 col-md-6 col-lg-2">
                    <div class="footer-widget-nav">
                        <h6 class="footer-widget__title">Links</h6>
                        <nav>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('/contacts') }}">Contacts</a></li>
                                <li><a href="{{ url('/users/hasil') }}">Riwayat</a></li>
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/users/diagnosa') }}">Diagnosa</a></li>
                            </ul>
                        </nav>
                    </div><!-- /.footer-widget__content -->
                </div><!-- /.col-lg-2 -->
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="footer-widget-contact">
                        <h6 class="footer-widget__title color-heading">Hubungi Cepat</h6>
                        <ul class="contact-list list-unstyled">
                            <li>Jika kamu memiliki pertanyaan-pertanyaan or membutuhkan bantuan. jangan sungkan untuk menghubungi dengan tim kami.</li>
                            <li>
                                <a href="tel:{{ $getKonfigurasi->nohp_konfigurasi }}" class="phone__number">
                                    <i class="icon-phone"></i> <span>{{ $getKonfigurasi->nohp_konfigurasi }}</span>
                                </a>
                            </li>
                            <li class="color-body">
                                {{ $getKonfigurasi->alamat_konfigurasi }}
                            </li>
                        </ul>
                        <div class="d-flex align-items-center">
                            <a href="{{ url('/contacts') }}" class="btn btn__primary btn__link mr-30">
                                <i class="icon-arrow-right"></i> <span>Dapatkan Petunjuk</span>
                            </a>
                            <ul class="social-icons list-unstyled mb-0">
                                <li><a href="tel:{{ $getKonfigurasi->nohp_konfigurasi }}"><i class="fa-solid fa-phone"></i></a></li>
                                <li><a href="mailto:{{ $getKonfigurasi->email_konfigurasi }}"><i class="fa-solid fa-envelope"></i></a></li>
                            </ul><!-- /.social-icons -->
                            </ul><!-- /.social-icons -->
                        </div>
                    </div><!-- /.footer-widget__content -->
                </div><!-- /.col-lg-2 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.footer-primary -->
    <div class="footer-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <span class="fz-14">&copy; 2023 Diagnosa Bermain Gadget, All Rights Reserved. With Love by</span>
                    <a class="fz-14 color-primary" href="https://wa.me/6282277506232"> {{ $getKonfigurasi->nama_konfigurasi }} </a>
                </div><!-- /.col-lg-6 -->
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <nav>
                        <ul class="list-unstyled footer__copyright-links d-flex flex-wrap justify-content-end mb-0">
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Cookies</a></li>
                        </ul>
                    </nav>
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.footer-secondary -->
</footer>