<footer id="dtr-footer">
    <div class="container">
        <div class="row">

            <!-- column 1 starts -->
            <div class="col-12 col-sm-6 col-lg-2 dtr-mb-30"> <a href="index.html" class="d-block dtr-mb-30"><img
                        src="{{ asset('upload/konfigurasi/' . $getKonfigurasi->logo_konfigurasi) }}"
                        alt="footer logo"></a>
                <div class="dtr-social-large">
                    <ul class="dtr-social dtr-social-list social-light text-left">
                        <li><a href="{{ $getKonfigurasi->instagram_konfigurasi }}" class="dtr-instagram color-grey"
                                target="_blank" title="instagram"></a></li>
                        <li><a href="{{ $getKonfigurasi->facebook_konfigurasi }}" class="dtr-facebook color-grey "
                                target="_blank" title="facebook"></a></li>
                    </ul>
                </div>
            </div>
            <!-- column 1 ends -->

            <!-- column 2 starts -->
            <div class="col-12 col-sm-6 col-lg-4 dtr-mb-30">
                <h6>About</h6>
                <p>{!! Check::truncateText($about->keterangan_about, 100, '...') !!}</p>
                <p class="text-size-xs dtr-mt-20 dtr-mb-30">copyright© 2023
                    {{ $getKonfigurasi->created_konfigurasi }}.<br>
                    All rights reserved.</p>
            </div>
            <!-- column 2 ends -->

            <!-- column 3 starts -->
            <div class="col-12 col-sm-6 col-lg-3 dtr-mb-30">
                <h6>Menu</h6>
                <ul class="dtr-list-simple">
                    <li><a class="to-home" href="#home">Home</a></li>
                    <li><a class="to-about" href="#about">About</a></li>
                    <li><a class="to-checkStatus" href="#checkStatus">Status Pendaftaran</a></li>
                    <li><a class="to-gallery" href="#gallery">Gallery</a></li>
                    <li><a href="{{ url('/login') }}">Login</a></li>
                </ul>
            </div>
            <!-- column 3 ends -->

            <!-- column 4 starts -->
            <div class="col-12 col-sm-6 col-lg-3 dtr-mb-30">
                <h6>Get in Touch</h6>
                <p class="d-flex dtr-mb-20"><i class="icon-envelope1 dtr-mt-5 dtr-mr-15"></i><span><a
                            href="mailto:{{ $getKonfigurasi->email_konfigurasi }}">{{ $getKonfigurasi->email_konfigurasi }}</a></span>
                </p>
                <p class="d-flex dtr-mb-20"><i
                        class="icon-phone-alt dtr-mt-5 dtr-mr-15"></i><span>{{ $getKonfigurasi->nohp_konfigurasi }}</span>
                </p>
                <p class="d-flex dtr-mb-20"><i class="icon-map-marker-alt dtr-mt-5 dtr-mr-15"></i><span>
                        {{ $getKonfigurasi->alamat_konfigurasi }}<br>
                        {{ $getKonfigurasi->nama_konfigurasi }}<br>
                        {{ $getKonfigurasi->created_konfigurasi }}</span></p>
            </div>
            <!-- column 4 ends -->

        </div>
    </div>
</footer>
