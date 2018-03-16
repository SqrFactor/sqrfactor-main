<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="description" content=" @yield('content_description') ">
    @include('admin.partials.head')

    {{--styles--}}
    @yield('styles')
    {{--end--}}

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('admin.partials.header')

<!-- Left side column. contains the logo and sidebar -->
@include('admin.partials.left-sidebar')

<!-- Content Wrapper. Contains page content -->
    @yield('content')
<!-- /.content-wrapper -->

    @include('admin.partials.footer')



</div>
<!-- ./wrapper -->

@include('admin.partials.footer-scripts')
  {{--scripts--}}
@yield('scripts')
{{--end--}}
</body>
</html>
