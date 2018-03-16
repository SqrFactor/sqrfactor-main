@include('sqrfactor.partials.google-analytics')
<meta charset="UTF-8">
{{-- Social media meta tags --}}
<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="@yield('og_title')" />
<meta property="og:description" content="@yield('og_description')" />
<meta property="og:image" content="@yield('og_image')" />
<meta name="twitter:card" content="summary" />
{{-- Social Media meta tags --}}

<meta name="keywords" content="sqrfactor,Social network,architects,interior designers">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" href="{{ asset('assets/images/sqr_factor_fav.ico') }}">
<!-- fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="{{ asset('assets/css/app-bootstrap.css') }}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
<!-- Vendor CSS -->
<link href="{{ asset('assets/css/bootstrap-select.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/daterangepicker.css') }}" rel="stylesheet">
<!-- CSS -->
<link href="{{ asset('assets/css/mediaelement-playlist-plugin.min.css') }}" rel="stylesheet">
<link href="{{  asset('assets/css/mediaelementplayer.css') }}" rel="stylesheet">
<link href="{{  asset('assets/css/swiper.min.css') }}" rel="stylesheet">

<link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
<!-- Main css -->
<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet">
<!-- custom scroll -->
<link href="{{ asset('assets/css/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">
<link rel='stylesheet' href='{{ asset('css/nprogress.css') }}'/>
{{--@if(Request::path() == 'post/design' || Request::path() == 'post/article' )--}}
    {{--editer medium--}}
    {{--<link href="{{ asset('assets/css/medium-editor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/medium-editor-insert-plugin.min.css') }}" rel="stylesheet">--}}
    {{-- end editer medium--}}
{{--@endif--}}

{{--sweet alert--}}

<link href="{{ asset('assets/css/sweetalert2.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/croppie.min.css') }}" rel="stylesheet">
