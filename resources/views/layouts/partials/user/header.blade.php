@php
$getKonfigurasi = Check::getKonfigurasi();
$getCurrentUrl = url()->current();
$urlCurrent = explode('/', $getCurrentUrl);

unset($urlCurrent[0]);
unset($urlCurrent[1]);
unset($urlCurrent[2]);

$urlCurrent = array_values($urlCurrent);
$string = '/';
foreach($urlCurrent as $index => $value) {
if($index == 0){
$string .= $value;
} else {
$string .= '/'. $value;
}
}

@endphp
<header class="header header-layout1">
    <div class="header-topbar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <ul class="contact__list d-flex flex-wrap align-items-center list-unstyled mb-0">
                            <li>
                                <button class="miniPopup-emergency-trigger" type="button">Konsul Gejala</button>
                                <div id="miniPopup-emergency" class="miniPopup miniPopup-emergency text-center">
                                    <div class="emergency__icon">
                                        <i class="icon-call3"></i>
                                    </div>
                                    <a href="tel:{{$getKonfigurasi->nohp_konfigurasi}}" class="phone__number">
                                        <i class="icon-phone"></i> <span>{{$getKonfigurasi->nohp_konfigurasi}}</span>
                                    </a>
                                    <p>Silahkan hubungi kontak kami dengan staf resepsionis kami yang ramah atau pertanyaan medis
                                        <a href="{{ url('/users/diagnosa') }}" class="btn btn__secondary btn__link btn__block">
                                            <span>Konsultasi Gejala</span> <i class="icon-arrow-right"></i>
                                        </a>
                                </div><!-- /.miniPopup-emergency -->
                            </li>
                            <li>
                                <i class="icon-phone"></i><a href="tel:{{ $getKonfigurasi->nohp_konfigurasi }}">No. Telepon: {{ $getKonfigurasi->nohp_konfigurasi }}</a>
                            </li>
                            <li>
                                <i class="icon-location"></i><a href="#">{{ $getKonfigurasi->alamat_konfigurasi }}</a>
                            </li>
                            <li>
                                <i class="icon-clock"></i><a href="{{ url('/contacts') }}">Senin - Jumat: &nbsp; 08:00 - 17:00</a>
                            </li>
                        </ul><!-- /.contact__list -->
                        <div class="d-flex">
                            <ul class="social-icons list-unstyled mb-0 mr-30">
                                <li><a href="tel:{{ $getKonfigurasi->nohp_konfigurasi }}"><i class="fa-solid fa-phone"></i></a></li>
                                <li><a href="mailto:{{ $getKonfigurasi->email_konfigurasi }}"><i class="fa-solid fa-envelope"></i></a></li>
                            </ul><!-- /.social-icons -->

                        </div>
                    </div>
                </div><!-- /.col-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.header-top -->
    <nav class="navbar navbar-expand-lg sticky-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('upload/konfigurasi/'.$getKonfigurasi->logo_konfigurasi) }}" class="logo-light" alt="logo" style="height: 50px;">
                <img src="{{ asset('upload/konfigurasi/'.$getKonfigurasi->logo_konfigurasi) }}" class="logo-dark" alt="logo" style="height: 50px;">
            </a>
            <button class="navbar-toggler" type="button">
                <span class="menu-lines"><span></span></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavigation">
                <ul class="navbar-nav ml-auto">
                    <li class="nav__item">
                        <a href="{{ url('/') }}" class="nav__item-link {{ $string == '/' ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ url('/contacts') }}" class="nav__item-link {{ $string == '/contacts' ? 'active' : '' }}"> Contacts</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ url('/users/hasil') }}" class="nav__item-link {{ $string == '/users/hasil' ? 'active' : '' }}">Riwayat</a>
                    </li>
                    <!-- /.nav-item -->
                </ul><!-- /.navbar-nav -->
                <button class=" close-mobile-menu d-block d-lg-none"><i class="fas fa-times"></i></button>
            </div><!-- /.navbar-collapse -->
            <div class="d-none d-xl-flex align-items-center position-relative ml-30">
                <div class="miniPopup-departments-trigger">
                    <a href="{{ url('/login') }}"><i class="fas fa-sign-in-alt"></i> Log In</a>
                </div>
                <a href="{{ url('/users/diagnosa') }}" class="btn btn__primary btn__rounded ml-30">
                    <i class="icon-calendar"></i>
                    <span>Diagnosa</span>
                </a>
            </div>
        </div><!-- /.container -->
    </nav><!-- /.navabr -->
</header>