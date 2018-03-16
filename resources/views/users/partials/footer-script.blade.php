<script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyB69teYhvBd7aatwegp-UdNwTYRD-t19g0"></script>
{{-- <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.0.0/firebase.js"></script>

<!-- Bootstrap script -->
<script src="{{ asset('vendor/tether/dist/js/tether.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Js effects for material design. + Tooltips -->
<script src="{{ asset('assets/js/material.min.js') }}"></script>

<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
<script src="{{ asset('assets/js/theme-plugins.js') }}"></script>

<!-- Init functions -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- vendor script -->
<script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- script -->
<script src="{{ asset('assets/js/selectize.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/mediaelement-and-player.min.js') }}"></script>
<script src="{{ asset('assets/js/mediaelement-playlist-plugin.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper.jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<!-- app script -->
<script src="{{ asset('assets/js/daterangepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>

<script src='{{ asset('js/nprogress.min.js') }}'></script>
<!-- jquery -->
<script src="{{ asset('assets/js/jquery.geocomplete.min.js') }}"></script>
<script src=" {{ asset('assets/js/logger.js') }}"></script>
<script src="{{ asset('assets/js/croppie.min.js') }}"></script>

<script src="{{ asset('js/main-users.js') }}"></script>

<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/firebase-messaging-sw.js') }}"></script>

@if (notify()->ready())
    <script>
        swal({
            title: "{!! notify()->message() !!}",
            text: "{!! notify()->option('text') !!}",
            type: "{{ notify()->type() }}",
            @if (notify()->option('timer'))
                timer:{{ notify()->option('timer') }},
                showConfirmButton: false
            @endif
        });
    </script>
@endif



