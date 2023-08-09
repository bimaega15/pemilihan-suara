@extends('layouts.user')

@section('content')


<!-- ========================= 
            Google Map
    =========================  -->
<section class="google-map py-0">
    <div id="map" class="height-500"></div>
    <script src="assets/js/google-map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <!-- CLICK HERE (https://developers.google.com/maps/documentation/embed/get-api-key) TO  LERAN MORE ABOUT GOOGLE MAPS API KEY -->
</section><!-- /.GoogleMap -->

<!-- ==========================
        contact layout 1
    =========================== -->
<section class="contact-layout1 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 mb-3">
                <form class="contact-form" method="post" action="assets/php/contact.php" id="contactForm">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="contact-panel__title">Get In Touch</h4>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name" id="contact-name" name="contact-name" required>
                            </div>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" id="contact-email" name="contact-email" required>
                            </div>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Phone" id="contact-Phone" name="contact-phone" required>
                            </div>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Website" id="contact-website" name="contact-website">
                            </div>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-12">
                            <div class="form-group mb-20">
                                <textarea class="form-control" placeholder="Additional Details!" id="contact-message" name="contact-message"></textarea>
                            </div>
                            <button type="submit" class="btn btn__primary btn__xhight mt-10">Submit Request</button>
                            <div class="contact-result"></div>
                        </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                </form>
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-4 offset-lg-1 mb-3">
                <div class="contact-info d-flex flex-column justify-content-between">
                    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/contact/1.jpg" alt="banner"></div>
                    <div>
                        <h4 class="contact-info__title">450,000 client’s interactions!</h4>
                        <p class="contact-info__desc">Provide users with appropriate view access to requests, problems, changes,
                            contracts & solutions with experienced professionals.</p>
                        <p class="contact-info__desc">As one of the world's largest ITService Providers, we are ready to help.
                        </p>
                    </div>
                    <a href="contact-us.html" class="btn btn__white btn__bordered btn__icon">
                        <span>Download Brochure</span>
                        <i class="icon-arrow-right"></i>
                    </a>
                </div><!-- /.contact-info -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.contact layout 1 -->

<!-- ==========================
       Contact layout 2
    ============================ -->
<section class="contact-layout2 pt-0 pb-80">
    <div class="container">
        <div class="row">
            <!-- Contact panel #1 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="contact-info-box">
                    <h4 class="contact__info-box-title">London Office</h4>
                    <ul class="contact__info-list list-unstyled">
                        <li>Email: <a href="mailto:smartdata@7oroof.com">SmartData@7oroof.com</a></li>
                        <li>Address: 2307 Beverley Rd Brooklyn, NY</li>
                        <li>Phone: <a href="tel:5565454117">55 654 541 17</a></li>
                        <li>Hours: Mon-Fri: 8am – 7pm</li>
                    </ul><!-- /.contact__info-list -->
                </div><!-- /.contact-info-box -->
            </div><!-- /.col-lg-4 -->
            <!-- Contact panel #2 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="contact-info-box">
                    <h4 class="contact__info-box-title">Berlin Office</h4>
                    <ul class="contact__info-list list-unstyled">
                        <li>Email: <a href="mailto:smartdata@7oroof.com">SmartData@7oroof.com</a></li>
                        <li>Address: 2307 Beverley Rd Brooklyn, NY</li>
                        <li>Phone: <a href="tel:5565454117">55 654 541 17</a></li>
                        <li>Hours: Mon-Fri: 8am – 7pm</li>
                    </ul><!-- /.contact__info-list -->
                </div><!-- /.contact-info-box -->
            </div><!-- /.col-lg-4 -->
            <!-- Contact panel #3 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="contact-info-box">
                    <h4 class="contact__info-box-title">Manchester Office</h4>
                    <ul class="contact__info-list list-unstyled">
                        <li>Email: <a href="mailto:smartdata@7oroof.com">SmartData@7oroof.com</a></li>
                        <li>Address: 2307 Beverley Rd Brooklyn, NY</li>
                        <li>Phone: <a href="tel:5565454117">55 654 541 17</a></li>
                        <li>Hours: Mon-Fri: 8am – 7pm</li>
                    </ul><!-- /.contact__info-list -->
                </div><!-- /.contact-info-box -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Contact layout 2 -->

@endsection