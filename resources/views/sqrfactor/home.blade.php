@extends('layouts.app-sqrfactor')

        @section('title','SqrFactor || Home')

@section('content')


        <!-- Main Content -->
<div class="site-banner home-banner">
    <div class="site-banner-inner container">
        <h3 class="site-banner-title">We are the Storytellers</h3>
        <div class="site-banner-content m-auto" style="width: 450px;max-width: 100%;">
            <p>
                We write your biographies, but instead of words we use architecture elements,fabrics, furniture and of-course personal touch to them.
            </p>
        </div>
        <div class="site-banner-action">
            <a href="#" class="btn btn-action">Know More</a>
        </div>
    </div>
</div>
<!-- What we do -->

<section class="section-landing section-border text-center">
    <div class="container">
        <h3 class="section-title">
            <span class="text-primary">What</span> We Do
        </h3>
        <div class="row">
            <div class="col-md-10 m-auto">
                <p class="font-weight-light">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                </p>
            </div>
        </div>
        <img src="{{ asset('assets/images/what-we-do.png') }}" alt="" style="margin: 2.5rem 0;" />
        <a href="#" class="btn btn-action">How It works</a>
    </div>
</section>
<!-- End - What we do -->

<!-- Our categories -->
<section class="section-landing text-center mb-5">
    <div class="container">
        <h3 class="section-title">
            <span class="text-primary">Our</span> Categories
        </h3>
        <div class="row">
            <div class="col-md-10 m-auto">
                <p>
                    Our idea is to provide multiple designs. You, the client can launch a competition. Where a network of architects and designers come up with multiple options.
                </p>
            </div>
        </div>
        <br/>
        <div class="row m-0 section-categories">
            <div class="col-md-4 section-category-item">
                <div class="section-category-img">
                    <img src="{{ asset('assets/images/architecture-design.png') }}" alt="" />
                </div>
                <h4>Architecture Design</h4>
            </div>
            <div class="col-md-4 section-category-item active">
                <div class="section-category-img">
                    <img src="{{ asset('assets/images/interior-design.png') }}" alt="" />
                </div>
                <h4>Interior Design</h4>
            </div>
            <div class="col-md-4 section-category-item">
                <div class="section-category-img">
                    <img src="{{ asset('assets/images/landscape-design.png') }}" alt="" />
                </div>
                <h4>Landscape Design</h4>
            </div>
        </div>
    </div>
</section>
<!-- End - Our categories -->

<div class="text-center bg-primary text-white pt-5 pb-5 bg-skyline-red">
    <div class="container">
        <div class="row">
            <div class="col-md-10 m-auto">
                <p>Competitions provide options and brings positive attention to a project. When a number of architects/designers focus on a single problem, the process contributes to design excellence and variety.</p>
                <a href="#" class="btn btn-action btn-action-primary mb-0">Launch Your Competition</a>
            </div>
        </div>
    </div>
</div>
<!-- Multiple Architects Better Design -->
<section class="section-landing text-center mt-4">
    <div class="container">
        <h3 class="section-title">
            <span class="text-primary">Multiple</span> Architects <span class="text-primary">Better</span> Design
        </h3>
        <div class="row">
            <div class="col-md-10 m-auto">
                <p>
                    Multiple Architects participate in competion and provide you a Great design. From multiple options you choose the best and favourite.
                </p>
            </div>
        </div>
    </div>
    <br>
    <img src="{{ asset('assets/images/architects.jpg') }}" alt="" />
</section>
<!-- End - Multiple Architects Better Design -->
<!-- User Reviews -->
<section class="section-landing text-center">
    <div class="container">
        <h3 class="section-title">
            <span class="text-primary">User</span> Reviews
        </h3>
        <div class="row">
            <div class="col-md-10 m-auto">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
                <!-- User reviews carousel -->
                <div id="userReviewsCarousel" class="user-review-carousel carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <div class="media user-review-media">
                                <img class="align-self-center" src="{{ asset('assets/images/user-review-photo.jpg') }}" alt="">
                                <div class="media-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    <h4>- John Doe</h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="media user-review-media">
                                <img class="align-self-center" src="{{ asset('assets/images/user-review-photo.jpg') }}" alt="">
                                <div class="media-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure</p>
                                    <h4>- John Doe</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="user-review-carousel-control">
                        <a href="#userReviewsCarousel" role="button" data-slide="prev">
                            <i class="fa fa-long-arrow-left"></i>
                        </a>&nbsp;
                        <a href="#userReviewsCarousel" role="button" data-slide="next">
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <!-- End - User reviews carousel -->
            </div>
        </div>
    </div>
</section>
<!-- End - User Reviews -->

    @endsection