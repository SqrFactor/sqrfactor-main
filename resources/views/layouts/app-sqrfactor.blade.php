<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="description" content=" @yield('content_description') ">

    @include('sqrfactor.partials.head')

    @yield('styles')
</head>
<body data-base="{{URL::to("/")}}">
@if(Auth::check())
    @include('users.partials.header')
    <div class="navbar-spacer"></div>
@else
    @include('sqrfactor.partials.header')
@endif


@yield('content')


@include('sqrfactor.partials.footer')
        <!-- jquery -->
@include('sqrfactor.partials.footer-script')
        <!-- vendor script -->
<!-- script -->
@yield('scripts')
</body>
</html>