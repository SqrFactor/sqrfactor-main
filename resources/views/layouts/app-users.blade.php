<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="description" content=" @yield('content_description') ">
    @include('users.partials.head')

    @yield('styles')

</head>
<body class="app-page" data-base="{{URL::to("/")}}">

<div style="background: rgba(255, 255, 255, 0.48); width: 100%; height: 100vh;position: fixed;z-index:1111000000;line-height: 100vh;text-align: center; display: none;"
     id="spinner">
    <img src="{{asset("img/spinner.gif")}}" height="20px" width="80px">
</div>

<!-- Header -->
@include('users.partials.header')

@if(Auth::check())
    @include('users.partials.model')
@endif
{{--header profile --}}

{{--
   Show header profile only if the request in is not a simple request
--}}
@if(!isset($_REQUEST['simple']))
    @include('users.partials.header-profile')
@else
    <div class="header-spacer-fit"></div>
    <br>
@endif



@include('users.partials.cropping-profile')

@yield('content')

{{-- end main container--}}
@include('users.partials.footer-script')

@yield('scripts')

</body>
</html>