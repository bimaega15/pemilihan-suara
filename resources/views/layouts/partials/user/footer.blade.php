@php
    $konfigurasi = Check::getKonfigurasi();
@endphp

<footer class="bg-dark text-light">
    <div class="footer-shape">
        <div class="item">
            <img src="{{ asset('assets-frontend/img/shape/7.png') }}" alt="Shape">
        </div>
        <div class="item">
            <img src="{{ asset('assets-frontend/img/shape/9.png') }}" alt="Shape">
        </div>
    </div>
    <div class="container">
        <div class="f-items relative pt-70 pb-120 pt-xs-0 pb-xs-50">
            <div class="row">
                <div class="col-lg-4 col-md-6 footer-item pr-50 pr-xs-15">
                    <div class="f-item about">
                        <img class="logo" src="{{ asset('assets-frontend/img/logo-putih.png') }}" alt="Logo">
                        <p>
                            Mewujudkan masyarakat yang adil, inklusif, dan berkelanjutan, di mana perempuan memiliki
                            peran aktif dan terlibat secara merata dalam pembuatan kebijakan publik.

                        </p>

                    </div>
                </div>
                <div class="col-lg-2 col-md-6 footer-item">
                    <div class="f-item link">
                        <h4 class="widget-title">Menu Akses</h4>
                        <ul>
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="#">About / Profil</a>
                            </li>
                            <li>
                                <a href="#">Contribute</a>
                            </li>
                            <li>
                                <a href="#">Gallery / Kegiatan</a>
                            </li>
                            <li>
                                <a href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 footer-item">
                    <div class="f-item link">
                        <h4 class="widget-title">Program Kami</h4>
                        <ul>
                            <li>
                                <a href="#">Pendidikan Berkualitas</a>
                            </li>
                            <li>
                                <a href="#">Pengembangan Ekonomi</a>
                            </li>
                            <li>
                                <a href="#">Perlindungan Lingkungan</a>
                            </li>
                            <li>
                                <a href="#">Pengembangan Teknologi</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 footer-item">
                    <h4 class="widget-title">Support</h4>
                    <p>
                        Ada pertanyaan atau ingin bergabung menjadi pendukung silahkan hubungi kami.
                    </p>
                    <div class="f-item newsletter">
                        <form action="#">
                            <input type="email" placeholder="Your Email" class="form-control" name="email">
                            <button type="submit"> Kirim</button>
                        </form>
                    </div>
                    <ul class="footer-social">
                        <li>
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>&copy; Copyright 2023. All Rights Reserved by <a href="#">Tim Pemenangan Vindy
                            Faradilah</a></p>
                </div>
                <div class="col-lg-6 text-end">

                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Bottom -->

</footer>
