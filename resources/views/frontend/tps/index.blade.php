@extends('layouts.user')

@section('content')
<!-- ========================
       page title 
    =========================== -->
<section class="page-title page-title-layout16 text-center bg-overlay bg-overlay-gradient bg-parallax">
    <div class="bg-img"><img src="{{ asset('frontend/SmartData') }}/assets/images/page-titles/12.jpg" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading mb-10">Our Blog</h1>
                <nav>
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->

<!-- ======================
      Blog Grid
    ========================= -->
<section class="blog-grid">
    <div class="container">
        <div class="row">
            <!-- post Item #1 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/blog/grid/1.jpg" alt="post image">
                        </a>
                    </div><!-- /.post-img -->
                    <div class="post__content">
                        <div class="post__meta-cat">
                            <a href="#">Consulting</a><a href="#">Sales</a>
                        </div><!-- /.post-meta-cat -->
                        <span class="post__meta-date">May 13, 2020</span>
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
                    </div><!-- /.post-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            <!-- post Item #2 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/blog/grid/2.jpg" alt="post image">
                        </a>
                    </div><!-- /.post-img -->
                    <div class="post__content">
                        <div class="post__meta-cat">
                            <a href="#">Tech</a><a href="#">Communications</a>
                        </div><!-- /.post-meta-cat -->
                        <span class="post__meta-date">April 17, 2020</span>
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
                    </div><!-- /.post-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            <!-- post Item #3 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/blog/grid/3.jpg" alt="post image">
                        </a>
                    </div><!-- /.post-img -->
                    <div class="post__content">
                        <div class="post__meta-cat">
                            <a href="#">Digital Business</a><a href="#">Cloud</a>
                        </div><!-- /.post-meta-cat -->
                        <span class="post__meta-date">March 20, 2020</span>
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
                    </div><!-- /.post-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            <!-- post Item #4 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/blog/grid/4.jpg" alt="post image">
                        </a>
                    </div><!-- /.post-img -->
                    <div class="post__content">
                        <div class="post__meta-cat">
                            <a href="#">Security</a><a href="#">Support</a>
                        </div><!-- /.post-meta-cat -->
                        <span class="post__meta-date">Feb 9, 2020</span>
                        <h4 class="post__title"><a href="#">New Remote Workers Visible to Security Operations? </a>
                        </h4>
                        <p class="post__desc">Many are utilizing remote working systems that have not been operationally
                            tested as part of their core security operations monitoring, likely result is fewer security alerts
                            and issues...
                        </p>
                        <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                            <span>Read More</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.post-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            <!-- post Item #5 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/blog/grid/5.jpg" alt="post image">
                        </a>
                    </div><!-- /.blog-img -->
                    <div class="post__content">
                        <div class="post__meta-cat">
                            <a href="#">Insights</a><a href="#">Costs</a>
                        </div><!-- /.blog-meta-cat -->
                        <span class="post__meta-date">Feb 3, 2020</span>
                        <h4 class="post__title"><a href="#">Market Insights to Manage People Related Costs</a>
                        </h4>
                        <p class="post__desc">If economies stay closed, some of the hardest decisions for leaders still lie
                            ahead, and yet most leaders lack the data they need to make informed decisions about their
                            workforce...
                        </p>
                        <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                            <span>Read More</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.post-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            <!-- post Item #6 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="post-item">
                    <div class="post__img">
                        <a href="blog-single-post.html">
                            <img src="{{ asset('frontend/SmartData') }}/assets/images/blog/grid/6.jpg" alt="post image">
                        </a>
                    </div><!-- /.post-img -->
                    <div class="post__content">
                        <div class="post__meta-cat">
                            <a href="#">Sales</a><a href="#">Sales</a>
                        </div><!-- /.post-meta-cat -->
                        <span class="post__meta-date">Jan 30, 2020</span>
                        <h4 class="post__title"><a href="#">Embrace Proactive Customer Experience in the Business</a>
                        </h4>
                        <p class="post__desc">Concerns like these can raise volumes, increase expenses and strain your
                            staff. And they’re still just the tip of the iceberg, because customers are delaying or canceling
                            purchases...
                        </p>
                        <a href="blog-single-post.html" class="btn btn__secondary btn__link">
                            <span>Read More</span>
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div><!-- /.post-content -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12 text-center">
                <nav class="pagination-area">
                    <ul class="pagination justify-content-center mb-0">
                        <li><a class="current" href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#"><i class="icon-arrow-right"></i></a></li>
                    </ul>
                </nav><!-- .pagination-area -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog Grid -->

@endsection