@extends('layouts.user')


@section('title','Home Page')

@section('content')

<!-- ============================
        Slider
    ============================== -->
<section class="slider">
    <div class="slick-carousel carousel-arrows-light carousel-dots-light m-slides-0" data-slick='{"slidesToShow": 1, "arrows": true, "dots": true, "speed": 700,"fade": true,"cssEase": "linear"}'>
        <div class="slide-item align-v-h bg-overlay bg-overlay-gradient">
            <div class="bg-img"><img src="{{ asset('frontend/SmartData/') }}/assets/images/sliders/1.jpg" alt="slide img"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                        <div class="slide__content">
                            <h2 class="slide__title">We Run All Kinds Of IT Services That Vow Your Success</h2>
                            <p class="slide__desc">We are experienced professionals who understand that It services is
                                changing,
                                and are true partners who care about your success. Our team provides a consultative approach on
                                emerging technology.</p>
                            <a href="#" class="btn btn__primary btn__icon mr-30">
                                <span>More About Us</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                            <a href="projects-grid.html" class="btn btn__white">Our Services</a>
                        </div><!-- /.slide-content -->
                    </div><!-- /.col-xl-7 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.slide-item -->
        <div class="slide-item align-v-h bg-overlay bg-overlay-gradient">
            <div class="bg-img"><img src="{{ asset('frontend/SmartData/') }}/assets/images/sliders/2.jpg" alt="slide img"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                        <div class="slide__content">
                            <h2 class="slide__title">Keep Business Safe And Ensure High Availability.</h2>
                            <p class="slide__desc">We are experienced professionals who understand that It services is
                                changing,
                                and are true partners who care about your success. Our team provides a consultative approach on
                                emerging technology.</p>
                            <a href="#" class="btn btn__primary btn__icon mr-30">
                                <span>More About Us</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                            <a href="projects-grid.html" class="btn btn__white">Our Services</a>
                        </div><!-- /.slide-content -->
                    </div><!-- /.col-xl-7 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.slide-item -->
    </div><!-- /.carousel -->
</section>
<!-- /.slider -->

<!-- ========================
      About Layout 4
    =========================== -->
<section class="about-layout4 pt-130 pb-0">
    <div class="container">
        <div class="row heading">
            <div class="col-12">
                <div class="d-flex align-items-center mb-20">
                    <div class="divider divider-primary mr-30"></div>
                    <h2 class="heading__subtitle mb-0">Timely Service Delivery & Incident Resolutions!!</h2>
                </div>
            </div><!-- /.col-12 -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <h3 class="heading__title mb-40">Manages service delivery across various business like, HR, Legal and
                    other IT departments!!
                </h3>
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <p>SmartData has been helping organizations throughout the World to manage their IT with our unique approach
                    to technology management and consultancy solutions. Provide users with appropriate view and access
                    permissions to requests, problems, changes, contracts, assets, solutions, and reports with our experienced
                    professionals.</p>
                <p>As one of the world's largest ITService Providers, our deep pool of certified engineers and IT staff are
                    ready to help you to keep your IT business safe & ensure high availability.</p>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="about__img">
                    <img src="{{ asset('frontend/SmartData/') }}/assets/images/about/2.jpg" alt="about">
                </div><!-- /.about-img -->
                <div class="video__btn-wrapper">
                    <a class="video__btn video__btn-white popup-video" href="https://www.youtube.com/watch?v=nrJtHemSPW4">
                        <div class="video__player">
                            <i class="fa fa-play"></i>
                        </div>
                        <span class="video__btn-title">Watch Our Presentation!</span>
                    </a>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-6 d-flex flex-column justify-content-between">
                <ul class="list-items list-items-layout2 list-horizontal list-unstyled d-flex flex-wrap mt-40">
                    <li>Eliminate Repeat Entry</li>
                    <li>Simpliy Communication</li>
                    <li>Drive Business Process</li>
                    <li>Speed Up Transactions</li>
                    <li>Structure Data & Docs</li>
                    <li>Automate Workflows</li>
                </ul>
                <div class="clients">
                    <p class="text__link text-center mb-10">Trusted By The World's
                        <a href="it-solutions.html" class="btn btn__link btn__primary btn__underlined">Best Organizations</a>
                    </p>
                    <div class="slick-carousel" data-slick='{"slidesToShow": 3, "arrows": false, "dots": false, "autoplay": true,"autoplaySpeed": 2000, "infinite": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 2}}]}'>
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/1.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/1.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/2.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/2.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/3.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/3.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/4.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/4.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/5.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/5.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/6.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/6.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/7.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/7.png" alt="client">
                        </div><!-- /.client -->
                    </div><!-- /.carousel -->
                </div>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.About Layout 4 -->

<!-- ========================
        Services Carousel
    =========================== -->
<section class="services-layout2 services-carousel pt-130 bg-gray">
    <div class="container">
        <div class="row heading mb-40">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <div class="divider divider-primary mr-30"></div>
                    <h2 class="heading__subtitle mb-0">Nationwide Service, Local Expertise</h2>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-7">
                <h3 class="heading__title">Offering the latest software and IT services to our customers!</h3>
            </div><!-- /col-lg-5 -->
            <div class="col-sm-12 col-md-12 col-lg-5">
                <p class="heading__desc">Improve efficiency, leverage tech, and provide better customer experiences with the
                    modern technology services available allover the world. Our skilled personnel, utilising the latest
                    processing software, combined with decades of experience.</p>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="slick-carousel" data-slick='{"slidesToShow": 3, "slidesToScroll": 2, "arrows": true, "dots": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                    <!-- service item #1 -->
                    <div class="service-item">
                        <div class="service__content">
                            <div class="service__icon">
                                <i class="icon-server"></i>
                            </div><!-- /.service__icon -->
                            <h4 class="service__title">IT Management <br> Services</h4>
                            <p class="service__desc">IT management service that manages and oversees the IT infrastructure of
                                any civil organization responsible for network and operations which includes data </p>
                            <ul class="list-items list-unstyled mb-30">
                                <li>Business IT alignment</li>
                                <li> IT financial management</li>
                                <li> IT service management</li>
                            </ul>
                            <a href="it-solutions-single.html" class="btn btn__secondary">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.service-content -->
                    </div><!-- /.service-item -->
                    <!-- service item #2 -->
                    <div class="service-item">
                        <div class="service__content">
                            <div class="service__icon">
                                <i class="icon-cyberspace"></i>
                            </div><!-- /.service__icon -->
                            <h4 class="service__title">Cyber Security<br> Services</h4>
                            <p class="service__desc">Drive your business and manage risk with a global industry leader in
                                cybersecurity, cloud, and managed security services and extend your team with leading experts.</p>
                            <ul class="list-items list-unstyled mb-30">
                                <li>Internet security</li>
                                <li>Automotive security</li>
                                <li>Cyberwarfare</li>
                            </ul>
                            <a href="it-solutions-single.html" class="btn btn__secondary">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.service-content -->
                    </div><!-- /.service-item -->
                    <!-- service item #3 -->
                    <div class="service-item">
                        <div class="service__content">
                            <div class="service__icon">
                                <i class="icon-cloud-computing"></i>
                            </div><!-- /.service__icon -->
                            <h4 class="service__title">Cloud Computing<br> Services</h4>
                            <p class="service__desc">Cloud computing is on-demand availability of computer system resources,
                                especially data storage computing power, without direct active management by the user.</p>
                            <ul class="list-items list-unstyled mb-30">
                                <li>Private cloud services</li>
                                <li>Public cloud services</li>
                                <li>Hybrid cloud services</li>
                            </ul>
                            <a href="it-solutions-single.html" class="btn btn__secondary">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.service-content -->
                    </div><!-- /.service-item -->
                    <!-- service item #4 -->
                    <div class="service-item">
                        <div class="service__content">
                            <div class="service__icon">
                                <i class="icon-permission"></i>
                            </div><!-- /.service__icon -->
                            <h4 class="service__title">IT Consulting <br> Services</h4>
                            <p class="service__desc">TTrying to solve all your IT challenges internally can become costly and
                                a
                                major distraction, Leveraging knowledgeable IT consulting firms like ushelps business. </p>
                            <ul class="list-items list-unstyled mb-30">
                                <li>Scoping & planning</li>
                                <li>Process & system design</li>
                                <li>Project management support</li>
                            </ul>
                            <a href="it-solutions-single.html" class="btn btn__secondary">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.service-content -->
                    </div><!-- /.service-item -->
                    <!-- service item #5 -->
                    <div class="service-item">
                        <div class="service__content">
                            <div class="service__icon">
                                <i class="icon-code"></i>
                            </div><!-- /.service__icon -->
                            <h4 class="service__title">Software Dev<br> Services</h4>
                            <p class="service__desc">With shorter product cycles, innovation, and mergers contributing to
                                constant change, you are faced making business decisions every day to advance.</p>
                            <ul class="list-items list-unstyled mb-30">
                                <li>Implementation</li>
                                <li>Testing & documenting</li>
                                <li>Deployment & maintenance</li>
                            </ul>
                            <a href="it-solutions-single.html" class="btn btn__secondary">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.service-content -->
                    </div><!-- /.service-item -->
                    <!-- service item #6 -->
                    <div class="service-item">
                        <div class="service__content">
                            <div class="service__icon">
                                <i class="icon-internet"></i>
                            </div><!-- /.service__icon -->
                            <h4 class="service__title">Backup & Recovery<br> Services</h4>
                            <p class="service__desc">While you can’t predict unexpected events, we’ll ensure the right
                                precautions are in place to minimize downtime and keep you moving in the right direction.</p>
                            <ul class="list-items list-unstyled mb-30">
                                <li>Compression & Deduplication</li>
                                <li>Duplication & Encryption</li>
                                <li>Multiplexing & Refactoring</li>
                            </ul>
                            <a href="it-solutions-single.html" class="btn btn__secondary">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.service-content -->
                    </div><!-- /.service-item -->
                </div><!-- /.carousel -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12 btn-wrapper">
                <a href="#" class="btn btn__secondary btn__bordered btn__icon">
                    <span>Explore All Services</span>
                    <i class="icon-arrow-right"></i>
                </a>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Services Layout 2 -->

<!-- ======================
    Features Layout 1
    ========================= -->
<section class="features-layout1 pb-0">
    <div class="features-bg">
        <div class="bg-img"><img src="{{ asset('frontend/SmartData/') }}/assets/images/backgrounds/14.jpg" alt="background"></div>
    </div>
    <div class="container">
        <div class="row heading heading-light mb-30">
            <div class="col-sm-12 col-md-12 col-lg-5">
                <div class="divider divider-primary mb-20"></div>
                <h3 class="heading__title">Provides consultative approach on emerging technology. </h3>
            </div><!-- /col-lg-5 -->
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-1">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="heading__desc">As one of the world's largest ITService Providers with over 120 engineers and
                            IT support staff are ready to help.</p>
                        <a href="#" class="btn btn__primary btn__primary-style2 btn__icon mt-30 mb-30">
                            <span>Our Pricing</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-6">
                        <p class="heading__desc">SmartData been helping organizations and Providers through the World to manage
                            their IT with our unique approach to technology management and consultancy solutions. </p>
                    </div><!-- /.col-sm-6 -->
                </div><!-- /.row -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <!-- Feature item #1 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="feature-item text-center">
                    <div class="feature__icon">
                        <i class="icon-software"></i>
                    </div>
                    <h4 class="feature__title">Software Asset</h4>
                    <p class="feature__desc">All aspects of your software assets including purchasing, deployment &
                        maintenance.</p>
                    <a href="#" class="btn__link"><i class="icon-arrow-right icon-outlined"></i></a>
                </div><!-- /.feature-item -->
            </div><!-- /.col-lg-3 -->
            <!-- Feature item #2 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="feature-item text-center">
                    <div class="feature__icon">
                        <i class="icon-dos"></i>
                    </div>
                    <h4 class="feature__title">Privileged Access</h4>
                    <p class="feature__desc">Extend proven Tech best practices to HR, finance, and other service delivery
                        areas.</p>
                    <a href="#" class="btn__link"><i class="icon-arrow-right icon-outlined"></i></a>
                </div><!-- /.feature-item -->
            </div><!-- /.col-lg-3 -->
            <!-- Feature item #3 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="feature-item text-center">
                    <div class="feature__icon">
                        <i class="icon-operating-system"></i>
                    </div>
                    <h4 class="feature__title">Software License</h4>
                    <p class="feature__desc">Build dynamic request templates with associated workflows, and tasks.</p>
                    <a href="#" class="btn__link"><i class="icon-arrow-right icon-outlined"></i></a>
                </div><!-- /.feature-item -->
            </div><!-- /.col-lg-3 -->
            <!-- Feature item #4 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="feature-item text-center">
                    <div class="feature__icon">
                        <i class="icon-machine-learning"></i>
                    </div>
                    <h4 class="feature__title">Enterprise Service</h4>
                    <p class="feature__desc">Our technology allows you to offer the latest software to your possible
                        customers!</p>
                    <a href="#" class="btn__link"><i class="icon-arrow-right icon-outlined"></i></a>
                </div><!-- /.feature-item -->
            </div><!-- /.col-lg-3 -->
        </div><!-- /.row -->
        <div class="row mt-40">
            <div class="col-sm-12 col-md-12 col-lg-6 d-flex flex-column justify-content-between">
                <div class="row row-no-gutter read-note">
                    <div class="col-sm-4">
                        <div class="rating mb-10">
                            <i class="fas fa-star color-primary"></i>
                            <i class="fas fa-star color-primary"></i>
                            <i class="fas fa-star color-primary"></i>
                            <i class="fas fa-star color-primary"></i>
                            <i class="fas fa-star color-primary"></i>
                        </div>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-sm-8">
                        <p class="read-note__text color-white">
                            <span class="font-weight-bold text-underlined">99.9% Customer Satisfaction</span>
                            based on 750+ reviews and 20,000 Objective Resource
                        </p>
                    </div><!-- /.col-lg-8 -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-sm-6">
                        <p class="mb-30 font-weight-bold sub__desc">As one of the world's largest ITService Providers with over
                            120
                            engineers and IT support staff are ready to help.</p>
                        <a href="#" class="btn btn__primary btn__bordered btn__icon mb-30">
                            <span>Request Demo</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-6">
                        <ul class="list-items list-unstyled mb-30">
                            <li>450,000 client’s interactions </li>
                            <li>Help challenge critical activities</li>
                            <li>Simplify &amp; Automate Workflows</li>
                            <li>Peer perspectives and advice</li>
                        </ul>
                    </div><!-- /.col-sm-6 -->
                </div><!-- /.row -->
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <img src="{{ asset('frontend/SmartData/') }}/assets/images/banners/3.jpg" alt="banner">
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Features Layout 1 -->

<!-- =========================== 
      portfolio Grid
    ============================= -->
<section class="portfolio-grid portfolio-grid-carousel pb-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="heading mb-50">
                    <div class="d-flex align-items-center">
                        <div class="divider divider-primary mr-30"></div>
                        <h2 class="heading__subtitle mb-0">Success Stories</h2>
                    </div>
                    <h3 class="heading__title mb-0">Latest Case Studies</h3>
                </div>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="slick-carousel" data-slick='{"slidesToShow": 3, "slidesToScroll": 2, "arrows": true, "dots": true, "autoplay": true,"autoplaySpeed": 3000, "infinite": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                    <!-- portfolio item #1 -->
                    <div class="portfolio-item">
                        <div class="portfolio__img">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/portfolio/grid/1.jpg" alt="portfolio img">
                        </div><!-- /.portfolio-img -->
                        <div class="portfolio__content">
                            <div class="portfolio__cat">
                                <a href="#">Building</a><a href="#">Interior</a>
                            </div><!-- /.portfolio-cat -->
                            <h4 class="portfolio__title"><a href="#">Financial’s Need For
                                    Strategic Advisor</a></h4>
                            <p class="portfolio__desc">We delivered solutions at every step, and moved seamlessly into a more
                                proactive role as a strategic advisor, providing support and guidance across all IT topics.</p>
                            <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.portfolio-content -->
                    </div><!-- /.portfolio-item -->
                    <!-- portfolio item #2 -->
                    <div class="portfolio-item">
                        <div class="portfolio__img">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/portfolio/grid/2.jpg" alt="portfolio img">
                        </div><!-- /.portfolio-img -->
                        <div class="portfolio__content">
                            <div class="portfolio__cat">
                                <a href="#">Software</a><a href="#">Support</a>
                            </div><!-- /.portfolio-cat -->
                            <h4 class="portfolio__title"><a href="#">24x7 System Monitoring and
                                    Alert Response</a></h4>
                            <p class="portfolio__desc">This single, unified platform integrates all operational phases of
                                selling and activation of their wireless services and devices, and serves as the backbone of the
                                operations.</p>
                            <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.portfolio-content -->
                    </div><!-- /.portfolio-item -->
                    <!-- portfolio item #3 -->
                    <div class="portfolio-item">
                        <div class="portfolio__img">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/portfolio/grid/3.jpg" alt="portfolio img">
                        </div><!-- /.portfolio-img -->
                        <div class="portfolio__content">
                            <div class="portfolio__cat">
                                <a href="#">Management</a><a href="#">Cloud</a>
                            </div><!-- /.portfolio-cat -->
                            <h4 class="portfolio__title"><a href="#">Nonprofit Organization
                                    Utilized Security</a></h4>
                            <p class="portfolio__desc">Servers going down on a weekly basis had become the organization’s
                                “normal.” We came on board with the objective of stabilizing the environment, assisting </p>
                            <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.portfolio-content -->
                    </div><!-- /.portfolio-item -->
                    <!-- portfolio item #4 -->
                    <div class="portfolio-item">
                        <div class="portfolio__img">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/portfolio/grid/4.jpg" alt="portfolio img">
                        </div><!-- /.portfolio-img -->
                        <div class="portfolio__content">
                            <div class="portfolio__cat">
                                <a href="#">Digital</a><a href="#">HR</a>
                            </div><!-- /.portfolio-cat -->
                            <h4 class="portfolio__title"><a href="#">Powerful IT Upgrade Aligns
                                    With Your Objectives</a></h4>
                            <p class="portfolio__desc">They needed a robust management solution to organize archive critical
                                documents for client cases, and wanted to determine solutions at every step, and moved </p>
                            <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.portfolio-content -->
                    </div><!-- /.portfolio-item -->
                    <!-- portfolio item #5 -->
                    <div class="portfolio-item">
                        <div class="portfolio__img">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/portfolio/grid/5.jpg" alt="portfolio img">
                        </div><!-- /.portfolio-img -->
                        <div class="portfolio__content">
                            <div class="portfolio__cat">
                                <a href="#">Consulting</a><a href="#">Management</a>
                            </div><!-- /.portfolio-cat -->
                            <h4 class="portfolio__title"><a href="#">The Best IT Practices in Cloud
                                    and Security</a></h4>
                            <p class="portfolio__desc">This single, unified platform integrates all operational phases of
                                selling and activation of their wireless services and devices, and serves as the backbone of the
                                operations.</p>
                            <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.portfolio-content -->
                    </div><!-- /.portfolio-item -->
                    <!-- portfolio item #6 -->
                    <div class="portfolio-item">
                        <div class="portfolio__img">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/portfolio/grid/6.jpg" alt="portfolio img">
                        </div><!-- /.portfolio-img -->
                        <div class="portfolio__content">
                            <div class="portfolio__cat">
                                <a href="#">Software</a><a href="#">Security</a>
                            </div><!-- /.portfolio-cat -->
                            <h4 class="portfolio__title"><a href="#">Helping Companies With
                                    Healthcare Inustry</a></h4>
                            <p class="portfolio__desc">Servers going down on a weekly basis had become the organization’s
                                “normal.” We came on board with the objective of stabilizing the environment, assisting </p>
                            <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                                <span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.portfolio-content -->
                    </div><!-- /.portfolio-item -->
                </div><!-- /.carousel -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.portfolio Grid  -->

<!-- =========================
       Banner layout 5
      =========================== -->
<section class="banner-layout5 banner-layout5-sticky bg-parallax pt-130 pb-0">
    <div class="bg-img"><img src="{{ asset('frontend/SmartData/') }}/assets/images/banners/9.jpg" alt="background"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5 d-flex flex-column justify-content-between pb-80">
                <div class="heading heading-light mb-50 sticky-top">
                    <div class="divider divider-white"></div>
                    <h3 class="heading__title mb-30">Easy solutions for all difficult IT problems, keep business safe &
                        ensure high availability.
                    </h3>
                </div><!-- /.heading -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contact-info">
                            <div class="contact__icon"><i class="icon-map-marker"></i></div>
                            <ul class="contact__list list-unstyled">
                                <li>2307 Beverley Rd Brooklyn, New York 11226 United States.</li>
                            </ul>
                        </div><!-- /.contact-item-->
                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-6">
                        <div class="contact-item">
                            <div class="contact__icon"><i class="icon-mail"></i></div>
                            <ul class="contact__list list-unstyled">
                                <li><a href="mailto:SmartData@7oroof.com">Email: SmartData@7oroof.com</a></li>
                                <li><a href="tel:5565454117">Phone: +55 654 541 17</a></li>
                            </ul>
                        </div><!-- /.contact-item-->
                    </div><!-- /.col-sm-6 -->
                    <div class="col-sm-6"></div><!-- /.col-sm-6 -->
                </div><!-- /.row-->
            </div><!-- /.col-xl-6 -->
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 offset-xl-1">
                <div class="banner__content">
                    <div class="bg-img"><img src="{{ asset('frontend/SmartData/') }}/assets/images/backgrounds/3.png" alt="background"></div>
                    <div class="scroll__icon"><i class="icon-mouse"></i></div>
                    <div class="row heading heading-light">
                        <div class="col-sm-6">
                            <h3 class="heading__title mb-30">450,000 client’s interactions!</h3>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6">
                            <p class="heading__desc mb-20">Provide users with appropriate view access to requests, problems,
                                changes, contracts & solutions with experienced professionals.</p>
                            <p class="heading__desc mb-20">As one of the world's largest ITService Providers, we are ready to
                                help.
                            </p>
                            <a href="#" class="btn btn__white btn__bordered btn__xl btn__icon">
                                <span>Download Brochure</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                    <div class="row counters-wrapper counters-light mt-70">
                        <!-- counter item #1 -->
                        <div class="col-sm-4">
                            <div class="counter-item">
                                <h4 class="counter">6,154</h4>
                                <p class="counter__desc">Projects And Software Developed in 2021</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-4 -->
                        <!-- counter item #2 -->
                        <div class="col-sm-4">
                            <div class="counter-item">
                                <h4 class="counter">2,512</h4>
                                <p class="counter__desc">Qualified Employees And Developers With Us</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-4 -->
                        <!-- counter item #3 -->
                        <div class="col-sm-4">
                            <div class="counter-item">
                                <h4 class="counter">1,784</h4>
                                <p class="counter__desc">Satisfied Clients We Have Served Globally</p>
                            </div><!-- /.counter-item -->
                        </div><!-- /.col-sm-4 -->
                    </div><!-- /.row -->
                </div><!-- /.banner__content -->
                <div class="semi-banner bg-gray">
                    <div class="row row-no-gutter">
                        <div class="col-sm-6">
                            <div class="semi-banner__content">
                                <div class="heading">
                                    <h3 class="heading__title mb-30">Timely Service, and incident resolutions!!</h3>
                                    <p class="heading_desc mb-30">Improve efficiency, leverage tech, and provide better customer
                                        experiences with the modern technology services available allover the world. </p>
                                    <p class="heading_desc mb-30">Our skilled personnel, utilising the latest processing software,
                                        combined with decades of experience.</p>
                                </div><!-- /.heading -->
                                <img src="{{ asset('frontend/SmartData/') }}/assets/images/about/singnture.png" alt="singnture">
                            </div>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6 d-none d-md-block">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/banners/7.jpg" alt="banner" class="w-100">
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                </div><!-- /.semi-banner -->
                <div class="semi-banner bg-gray">
                    <div class="row row-no-gutter">
                        <div class="col-sm-6">
                            <div class="cta-banner bg-primary">
                                <div class="cta__icon color-white"><i class="icon-developer"></i></div>
                                <h4 class="cta__title color-white">Since 1999</h4>
                                <p class="cta__desc color-white mb-25">Provide users with appropriate view and access to
                                    requests,
                                    problems, changes,
                                    contracts, solutions, and reports.</p>
                                <a href="#" class="btn btn__link btn__white btn__icon px-0">
                                    <span>Find Your Solution</span> <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="semi-banner__content pb-0">
                                <div class="heading">
                                    <h3 class="heading__title mb-30">We have decades of work experience!</h3>
                                </div><!-- /.heading -->
                                <h4 class="banner__subheading">Consulting & Insights</h4>
                                <p class="heading_desc">Our objective insights steer you toward the right decisions on issues that
                                    matter.</p>
                                <h4 class="banner__subheading">Research & Advisory</h4>
                                <p class="heading_desc">Our combination of research, problem solving and hands-on experience.</p>
                                <h4 class="banner__subheading">Strategic Advice</h4>
                                <p class="heading_desc">Tools to help turn strategy into decisions, and execute for measurable
                                    results.</p>
                            </div>
                        </div><!-- /.col-sm-6 -->
                    </div><!-- /.row -->
                </div><!-- /.semi-banner -->
                <section class="awards bg-secondary">
                    <div class="row heading heading-light mb-60">
                        <div class="col-sm-6">
                            <h3 class="heading__title">Our awards and recognitions</h3>
                        </div><!-- /col-lg-5 -->
                        <div class="col-sm-6">
                            <p class="heading__desc">Trusted by the world's best organizations, for 21 years and running, it has
                                been delivering smiles to hundreds of IT advisors, developers, users, and business owners.
                            </p>
                        </div><!-- /.col-lg-5 -->
                    </div><!-- /.row -->
                    <div class="row awards-wrapper">
                        <div class="col-sm-12">
                            <div class="awards-carousel-wrapper">
                                <div class="slick-carousel" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "arrows": false, "dots": true,"autoplay": true, "autoplaySpeed": 4000, "infinite": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 768, "settings": {"slidesToShow": 1}}, {"breakpoint": 570, "settings": {"slidesToShow": 1}}]}'>
                                    <!-- fancybox item #1 -->
                                    <div class="fancybox-item">
                                        <div class="fancybox__icon-img">
                                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/awards/icons/1.png" alt="icon">
                                        </div><!-- /.fancybox__icon-img -->
                                        <div class="fancybox__content">
                                            <h4 class="fancybox__title">CSS Design Award</h4>
                                            <p class="fancybox__desc">A web design & development award platform for digital folk,
                                                UI/UX
                                                peeps
                                                and inspiring leaders of the web.
                                            </p>
                                        </div><!-- /.fancybox-content -->
                                    </div><!-- /.fancybox-item -->
                                    <!-- fancybox item #2 -->
                                    <div class="fancybox-item">
                                        <span class="pinned-ribbon"></span>
                                        <div class="fancybox__icon-img">
                                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/awards/icons/2.png" alt="icon">
                                        </div><!-- /.fancybox__icon-img -->
                                        <div class="fancybox__content">
                                            <h4 class="fancybox__title">W3 Design Award</h4>
                                            <p class="fancybox__desc">Awards celebrates digital by honoring outstanding Websites, Web
                                                Marketing, Video, Sites, Apps & Social content.
                                            </p>
                                        </div><!-- /.fancybox-content -->
                                    </div><!-- /.fancybox-item -->
                                    <!-- fancybox item #3 -->
                                    <div class="fancybox-item">
                                        <div class="fancybox__icon-img">
                                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/awards/icons/3.png" alt="icon">
                                        </div><!-- /.fancybox__icon-img -->
                                        <div class="fancybox__content">
                                            <h4 class="fancybox__title">The FWA Award</h4>
                                            <p class="fancybox__desc">Showcasing innovation every day since 2000, our mission is to
                                                showcase
                                                cutting edge creativity, regardless
                                            </p>
                                        </div><!-- /.fancybox-content -->
                                    </div><!-- /.fancybox-item -->
                                    <!-- fancybox item #4 -->
                                    <div class="fancybox-item">
                                        <div class="fancybox__icon-img">
                                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/awards/icons/3.png" alt="icon">
                                        </div><!-- /.fancybox__icon-img -->
                                        <div class="fancybox__content">
                                            <h4 class="fancybox__title">WWW Awards</h4>
                                            <p class="fancybox__desc">The awards that recognize the talent and effort of the best web
                                                designers, developers and agencies in the world.
                                            </p>
                                        </div><!-- /.fancybox-content -->
                                    </div><!-- /.fancybox-item -->
                                </div><!-- /.carousel  -->
                            </div><!-- /.awards-carousel-wrapper -->
                        </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                </section>
            </div><!-- /.col-xl-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Banner layout 5 -->

<!-- ======================
      Blog Grid
    ========================= -->
<section class="blog-grid pb-50">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-40">
                    <h2 class="heading__subtitle">Recent Articles</h2>
                    <h3 class="heading__title">Resource Library</h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <!-- Blog Item #1 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/blog/grid/1.jpg" alt="blog image">
                        </a>
                    </div><!-- /.blog-img -->
                    <div class="post__content">
                        <div class="post__meta d-flex flex-wrap">
                            <div class="post__meta-cat">
                                <a href="#">Consulting</a><a href="#">Sales</a>
                            </div><!-- /.blog-meta-cat -->
                            <span class="post__meta-date">May 13, 2020</span>
                        </div>
                        <h4 class="post__title"><a href="#">Five Ways to Develop a World Class Sales Operations
                                Function</a>
                        </h4>
                        <p class="post__desc">Outsourcing IT infrastructure is a concept that has been around for a while.
                            Characterized in terms of technicians and engineers, workstations and servers, the idea of outsourcing
                            your basic IT needs...
                        </p>
                        <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                            <span>Read More</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.blog-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            <!-- Blog Item #2 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/blog/grid/2.jpg" alt="blog image">
                        </a>
                    </div><!-- /.blog-img -->
                    <div class="post__content">
                        <div class="post__meta d-flex flex-wrap">
                            <div class="post__meta-cat">
                                <a href="#">Tech</a><a href="#">Communications</a>
                            </div><!-- /.blog-meta-cat -->
                            <span class="post__meta-date">April 17, 2020</span>
                        </div>
                        <h4 class="post__title"><a href="#">Succession Risks That Threaten Your Leadership Strategy</a>
                        </h4>
                        <p class="post__desc">Today’s organizations need a quality bench of leaders to drive business
                            outcomes and satisfy employees, customers and investors who now demand more transparency and
                            accountability...
                        </p>
                        <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                            <span>Read More</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.blog-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            <!-- Blog Item #3 -->
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/blog/grid/3.jpg" alt="blog image">
                        </a>
                    </div><!-- /.blog-img -->
                    <div class="post__content">
                        <div class="post__meta d-flex flex-wrap">
                            <div class="post__meta-cat">
                                <a href="#">Digital Business</a><a href="#">Cloud</a>
                            </div><!-- /.blog-meta-cat -->
                            <span class="post__meta-date">March 20, 2020</span>
                        </div>
                        <h4 class="post__title"><a href="#">What Do Employee Engagement Surveys Tell You About
                                Employee?</a>
                        </h4>
                        <p class="post__desc">Outsourcing IT infrastructure is a concept that has been around for a while.
                            Characterized in terms of technicians and engineers, workstations and servers, the idea of outsourcing
                            your basic IT needs...
                        </p>
                        <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                            <span>Read More</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.blog-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog Grid -->

<!-- =========================
       Banner layout 2
      =========================== -->
<section class="banner-layout2 pb-0 bg-overlay bg-overlay-primary">
    <div class="bg-img"><img src="{{ asset('frontend/SmartData/') }}/assets/images/banners/8.jpg" alt="background"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-inner">
                <div class="heading heading-light">
                    <h3 class="heading__title mb-30">Satisfied Users Over The Globe</h3>
                </div>
                <div class="testimonials testimonials-wrapper">
                    <div class="slider-with-navs">
                        <!-- Testimonial #1 -->
                        <div class="testimonial-item">
                            <p class="testimonial__desc color-white">If you’re looking for a rewarding career and the
                                chance to make an
                                impact, you’ve come to the right place. We will transform your business through our techniques!
                            </p>
                            <div class="testimonial__meta">
                                <h4 class="testimonial__meta-title">Ahmed Abdallah</h4>
                                <p class="testimonial__meta-desc">Digital Media Manager</p>
                            </div><!-- /.testimonial-meta -->
                        </div><!-- /. testimonial-item -->
                        <!-- Testimonial #2 -->
                        <div class="testimonial-item">
                            <p class="testimonial__desc color-white">If you’re looking for a rewarding career and the chance
                                to
                                make an impact, you’ve come to the right place. We will transform your business through our
                                techniques! </p>
                            <div class="testimonial__meta">
                                <h4 class="testimonial__meta-title">John Peter</h4>
                                <p class="testimonial__meta-desc">7oroof Inc</p>
                            </div><!-- /.testimonial-meta -->
                        </div><!-- /. testimonial-item -->
                        <!-- Testimonial #3 -->
                        <div class="testimonial-item">
                            <p class="testimonial__desc color-white">If you’re looking for a rewarding career and the
                                chance to make an
                                impact, you’ve come to the right place. We will transform your business through our techniques!
                            </p>
                            <div class="testimonial__meta">
                                <h4 class="testimonial__meta-title">Ayman</h4>
                                <p class="testimonial__meta-desc">7oroof Inc</p>
                            </div><!-- /.testimonial-meta -->
                        </div><!-- /. testimonial-item -->
                        <!-- Testimonial #2 -->
                        <div class="testimonial-item">
                            <p class="testimonial__desc color-white"> If you’re looking for a rewarding career and the chance to
                                make an impact, you’ve come to the right place. We will transform your business through our
                                techniques! </p>
                            <div class="testimonial__meta">
                                <h4 class="testimonial__meta-title">John Peter</h4>
                                <p class="testimonial__meta-desc">7oroof Inc</p>
                            </div><!-- /.testimonial-meta -->
                        </div><!-- /. testimonial-item -->
                        <!-- Testimonial #3 -->
                        <div class="testimonial-item">
                            <p class="testimonial__desc color-white">My project was a simple & small task, but the
                                persistence and
                                determination turned it into an awesome and great project which make me happy .
                            </p>
                            <div class="testimonial__meta">
                                <h4 class="testimonial__meta-title">John Peter</h4>
                                <p class="testimonial__meta-desc">7oroof Inc</p>
                            </div><!-- /.testimonial-meta -->
                        </div><!-- /. testimonial-item -->
                    </div>
                    <div class="slider-nav">
                        <div class="testimonial__thumb">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/testimonials/thumbs/1.png" alt="author thumb">
                        </div><!-- /.testimonial-thumb -->
                        <div class="testimonial__thumb">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/testimonials/thumbs/2.png" alt="author thumb">
                        </div><!-- /.testimonial-thumb -->
                        <div class="testimonial__thumb">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/testimonials/thumbs/3.png" alt="author thumb">
                        </div><!-- /.testimonial-thumb -->
                        <div class="testimonial__thumb">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/testimonials/thumbs/2.png" alt="author thumb">
                        </div><!-- /.testimonial-thumb -->
                        <div class="testimonial__thumb">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/testimonials/thumbs/3.png" alt="author thumb">
                        </div><!-- /.testimonial-thumb -->
                    </div><!-- /.slcik-nav -->
                </div><!-- /.testimonials -->
                <div class="divider divider-light w-100 mt-60 mb-60"></div>
                <div class="heading heading-light">
                    <h3 class="heading__title mb-30">Our Trusted Clients</h3>
                </div>
                <div class="clients">
                    <div class="slick-carousel" data-slick='{"slidesToShow": 4, "arrows": false, "dots": false, "autoplay": true,"autoplaySpeed": 2000, "infinite": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 3}}, {"breakpoint": 767, "settings": {"slidesToShow": 3}}, {"breakpoint": 480, "settings": {"slidesToShow": 2}}]}'>
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/1.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/1.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/2.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/2.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/3.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/3.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/4.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/4.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/5.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/5.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/6.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/6.png" alt="client">
                        </div><!-- /.client -->
                        <div class="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/7.png" alt="client">
                            <img src="{{ asset('frontend/SmartData/') }}/assets/images/clients/7.png" alt="client">
                        </div><!-- /.client -->
                    </div><!-- /.carousel -->
                </div>
            </div><!-- /.col-xl-6 -->
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                <div class="contact-panel">
                    <form class="contact-panel__form" method="post" action="{{ asset('frontend/SmartData/') }}/assets/php/contact.php" id="contactForm">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="contact-panel__title mb-20">Request A Quote</h4>
                                <p class="contact-panel__desc mb-30">Our deep pool of certified engineers and IT staff are ready
                                    to
                                    help you to keep your IT business safe & ensure high availability.</p>
                            </div> <!-- /.col-12 -->
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
                                    <select class="form-control">
                                        <option value="0">Inquiry</option>
                                        <option value="1">IT Management Services 2</option>
                                        <option value="2">IT Management Services 3</option>
                                    </select>
                                </div>
                            </div><!-- /.col-lg-6 -->
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Phone" id="contact-Phone" name="contact-phone">
                                </div>
                            </div><!-- /.col-lg-6 -->
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Additional Details!" id="contact-message" name="contact-message"></textarea>
                                </div>
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-20">
                                    <input type="checkbox" class="custom-control-input" id="acceptTerms">
                                    <label class="custom-control-label" for="acceptTerms">I accept the privacy and terms.</label>
                                </div>
                                <button type="submit" class="btn btn__primary btn__xl btn__block">Submit Request </button>
                                <div class="contact-result"></div>
                            </div><!-- /.col-12 -->
                        </div><!-- /.row -->
                    </form>
                </div>
            </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Banner layout 2 -->

<!-- ========================
      Footer
    ========================== -->
@endsection