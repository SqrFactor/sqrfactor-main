<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="description" content=" @yield('content_description') ">
    <meta name="userId" content="{{Auth::check() ? Auth::user()->id: 'null' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('users.partials.head')

    @yield('styles')
</head>
<body class="app-page" data-base="{{URL::to("/")}}" @yield('onload')>


<div style="background: rgba(255, 255, 255, 0.48); width: 100%; height: 100vh;position: fixed;z-index:1111000000;line-height: 100vh;text-align: center; display: none;"
     id="spinner">
    <img src="{{asset("img/spinner.gif")}}" height="20px" width="80px">
</div>
<!-- Header -->
@include('users.partials.header')

@if(Auth::check())
    @include('users.partials.model')
@endif

{{--main container--}}

@yield('content')
{{-- end main container--}}

@include('users.partials.footer-script')

@yield('scripts')
    <!-- <script src="{{asset('js/notification-app.js')}}"></script> -->
</body>
</html>