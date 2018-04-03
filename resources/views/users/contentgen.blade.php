@extends('layouts.app-news-feed')
@section('title')  How It Works - Square Factor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection
@section('styles')

<link href="{{ asset('assets/css/site.css') }}" rel="stylesheet">
<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">


@endsection


@section('content')
<!-- feed modal -->
<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>

    <div class="navbar-spacer"></div>
    <!-- Main Content -->
    <div class="page-header">
      <div class="container">
        <h1 class="page-header-title">How Does It <span class="text-primary">Works</span></h1>
      </div>
    </div>
    <div class="container">
      <!-- step 1 -->
      <div class="section-hiw">
        <div class="row">
          <div class="col-lg-5 col-md-6 mr-auto" data-aos="fade-right">
            <div class="section-hiw-number mt-2">01</div>
            <h3 class="section-hiw-title">Create A Design Brief</h3>
            <div class="section-hiw-content">
              We understand your design requirements like its our own project and create your design brief. You can make it too !
            </div>
          </div>
          <div class="col-lg-5 col-md-6" data-aos="fade-left">
            <div class="section-hiw-media">
              <img src="./assets/images/hiw-1.png" alt="" />
            </div>
          </div>
        </div>
      </div>
      <!-- end step 1 -->
      <!-- step 2 -->
      <div class="section-hiw">
        <div class="row">
          <div class="col-lg-5 push-lg-7 col-md-6 push-md-6">
            <div class="section-hiw-number">02</div>
            <h3 class="section-hiw-title">Selecting A Pricing Package</h3>
            <div class="section-hiw-content">
              The client; initially real estate developers will choose a design package (seting up prize money) for the competition and also the project timeline.
            </div>
          </div>
          <div class="col-lg-6 pull-lg-5 col-md-6 pull-md-6 mr-auto">
            <div class="section-hiw-media">
              <img src="./assets/images/hiw-2.png" alt="" />
            </div>
          </div>
        </div>
      </div>
      <!-- end step 2 -->
      <!-- step 3 -->
      <div class="section-hiw">
        <div class="row">
          <div class="col-lg-5 col-md-6 mr-auto">
            <div class="section-hiw-number">03</div>
            <h3 class="section-hiw-title">Launch Architecture Competition</h3>
            <div class="section-hiw-content">
              We share your design contest with the architecture community. And they will brainstorm ideas just for you.
            </div>
          </div>
          <div class="col-lg-5 col-md-6">
            <div class="section-hiw-media">
              <img src="./assets/images/hiw-3.png" alt="" />
            </div>
          </div>
        </div>
      </div>
      <!-- end step 3 -->
      <!-- step 4 -->
      <div class="section-hiw">
        <div class="row">
          <div class="col-lg-5 push-lg-7 col-md-6 push-md-6">
            <div class="section-hiw-number">04</div>
            <h3 class="section-hiw-title">Multiple Architects Multiple Designs</h3>
            <div class="section-hiw-content">
              Designers submit designs to your contest. Log into your SqrFactor account to track the process and review designed to add changes.
            </div>
          </div>
          <div class="col-lg-6 pull-lg-5 col-md-6 pull-md-6 mr-auto">
            <div class="section-hiw-media">
              <img src="./assets/images/hiw-4.png" alt="" />
            </div>
          </div>
        </div>
      </div>
      <!-- end step 4 -->
      <!-- step 5 -->
      <div class="section-hiw">
        <div class="row">
          <div class="col-lg-5 col-md-6 mr-auto">
            <div class="section-hiw-number">05</div>
            <h3 class="section-hiw-title">Give Feedback to shortlist designs</h3>
            <div class="section-hiw-content">
              We share your design contest with the architecture community. And they will brainstorm ideas just for you.
            </div>
          </div>
          <div class="col-lg-5 col-md-6">
            <div class="section-hiw-media">
              <img src="./assets/images/hiw-5.png" alt="" />
            </div>
          </div>
        </div>
      </div>
      <!-- end step 5 -->
      <!-- step 6 -->
      <div class="section-hiw">
        <div class="row">
          <div class="col-lg-5 push-lg-7 col-md-6 push-md-6">
            <div class="section-hiw-number">06</div>
            <h3 class="section-hiw-title">Select your favourite design</h3>
            <div class="section-hiw-content">
              <p>Choose the winner of your design contest. Your designer gets the prize money and you get full design copyright. Now download your design and make it work hard for you!</p>
              <a href="#" class="btn btn-lg mt-2">Get Started</a>
            </div>
          </div>
          <div class="col-lg-6 pull-lg-5 col-md-6 pull-md-6 mr-auto">
            <div class="section-hiw-media">
              <img src="./assets/images/hiw-6.png" alt="" />
            </div>
          </div>
        </div>
      </div>
      <!-- end step 6 -->
    </div>
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-3">
            <div class="footer-item">
              <h4 class="footer-title">Social Links</h4>
              <div class="footer-item-content">
                <div class="footer-social-links">
                  <a href="#"><i class="fa fa-facebook-square"></i></a>&nbsp;
                  <a href="#"><i class="fa fa-twitter-square"></i></a>&nbsp;
                  <a href="#"><i class="fa fa-google-plus-square"></i></a>&nbsp;
                  <a href="#"><i class="fa fa-linkedin-square"></i></a>&nbsp;
                  <a href="#"><i class="fa fa-instagram"></i></a>
                </div>
              </div>
            </div>
            <!-- footer item -->
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="footer-item">
              <h4 class="footer-title">Support</h4>
              <div class="footer-item-content">
                <ul class="footer-menu">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">How It Works</a></li>
                  <li><a href="#">FAQs</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </div>
            </div>
            <!-- footer item -->
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="footer-item">
              <h4 class="footer-title">Policies</h4>
              <div class="footer-item-content">
                <ul class="footer-menu">
                  <li><a href="#">Privacy Policy</a></li>
                  <li><a href="#">Terms of Service</a></li>
                  <li><a href="#">Refund & Guarantee Policy</a></li>
                </ul>
              </div>
            </div>
            <!-- footer item -->
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="footer-item">
              <h4 class="footer-title">Talk To Us</h4>
              <div class="footer-item-content">
                <p>Because there are some questions that even Google can't answer. We'd love to hear from you! Shoot us an email to
                  <a href="mailto:create@sqrfactor.in">create@sqrfactor.in</a> and we will get back to you as soon as possible.
                </p>
              </div>
            </div>
            <!-- footer item -->
          </div>
        </div>
      </div>
      <div class="footer-bottom text-center">
        <div class="container">
          <div class="row">
            <div class="col-sm-7 text-md-left">
              Copyright © 2017 https://www.sqrfactor.in. All Rights Reserved.
            </div>
            <div class="col-sm-5 text-md-right">
              Develop by : <a href="#">Agile</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
@endsection




