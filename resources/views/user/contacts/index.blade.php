@extends('layouts.user')

@section('title')
Contacts Page
@endsection

@section('content')
@php
$getKonfigurasi = Check::getKonfigurasi();
@endphp


<section class="page-title page-title-layout5 text-center">
    <div class="bg-img"><img src="{{ asset('frontend/medcity') }}/assets/images/backgrounds/6.jpg" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">Contact Us</h1>
                <nav>
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contacts</li>
                    </ol>
                </nav>
            </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->


<div class="row" style="margin-top: 70px;">
    <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
        <div class="heading text-center mb-60">
            <h2 class="heading__subtitle">Lokasi</h2>
            <h3 class="heading__title">Berikut lokasi tempat kami berasal:</h3>
        </div><!-- /.heading -->
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<!-- =========================
                Google Map
        =========================  -->
<section class="google-map py-0">
    <div id="map" style="height: 600px; width: 100%;"></div>
</section><!-- /.GoogleMap -->

<!-- ==========================
              contact layout 1
          =========================== -->
<section class="contact-layout1 pt-0" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-panel d-flex flex-wrap">
                    <form class="contact-panel__form" id="contactForm">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="contact-panel__title">Tentang Kami</h4>
                                <p class="contact-panel__desc mb-30">
                                    Silahkan menghubungi staff kami yang ramah dengan pertanyaan medis atau umum.
                                    Sistem kami akan menerima atau mengembalikan panggilan yang penting.
                                </p>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control deskripsi_konfigurasi summernote" id="deskripsi_konfigurasi" placeholder="Deskripsi..." name="deskripsi_konfigurasi" style="height: 80px;"></textarea>
                            </div><!-- /.col-lg-12 -->
                        </div><!-- /.row -->
                    </form>
                    <div class="contact-panel__info d-flex flex-column justify-content-between bg-overlay bg-overlay-primary-gradient">
                        <div class="bg-img"><img src="assets/images/banners/1.jpg" alt="banner"></div>
                        <div>
                            <h4 class="contact-panel__title color-white">Hubungi Cepat</h4>
                            <p class="contact-panel__desc font-weight-bold color-white mb-30">
                                Tolong jangan sungkan untuk menghubungi staff kami yang ramah dengan pertanyaan kesehatan apapun
                            </p>
                        </div>
                        <div>
                            <h4 class="contact-panel__title color-white">Senang Melayani Anda</h4>
                            <p class="contact-panel__desc font-weight-bold color-white mb-30">
                                Kami harap dengan adanya sistem kami akan membantu proses keinginan yang ingin anda capai. dengan adanya sistem ini semoga membantu user dalam mengetahui diagnosa gejala yang dialaminya.
                            </p>
                        </div>
                        <div>
                            <ul class="contact__list list-unstyled mb-30">
                                <li>
                                    <i class="icon-phone"></i><a href="tel:{{ $getKonfigurasi->nohp_konfigurasi }}">Hubungi Kontak: {{ $getKonfigurasi->nohp_konfigurasi }}</a>
                                </li>
                                <li>
                                    <i class="icon-location"></i><a href="#">{{ $getKonfigurasi->alamat_konfigurasi }}</a>
                                </li>
                                <li>
                                    <i class="icon-clock"></i><a href="{{ url('/contacts') }}">Senin - Jum'at: 08:00 - 17:00</a>
                                </li>
                            </ul>
                            <a href="#" class="btn btn__white btn__rounded btn__outlined">Kontak Kami</a>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.contact layout 1 -->


@push('js')
<script>
    $(document).ready(function() {
        getKonfigurasi();

        function getKonfigurasi() {
            let url = "{{ url('/') }}";
            $.ajax({
                url: `${url}/contacts`,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    if (data.status == 200) {
                        const {
                            result
                        } = data;

                        $('.summernote').summernote({
                            toolbar: false,
                        })
                        $('.summernote').summernote('code', result.deskripsi_konfigurasi);

                        var map = L.map('map').setView([result.latitude_konfigurasi, result.longitude_konfigurasi], 13);

                        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://wa.me/6282277506232">TA.SPK AHP & SAW</a> contributors'
                        }).addTo(map);

                        var marker = L.marker(new L.LatLng(result.latitude_konfigurasi, result.longitude_konfigurasi), {}).addTo(map);

                    }
                },
                error: function(xhr) {
                    const {
                        responseText
                    } = xhr;
                    if (responseText != '') {
                        console.log(responseText);
                    }
                }
            })
        }


    })
</script>
@endpush
@endsection