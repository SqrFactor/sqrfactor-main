<!-- jquery -->
<!-- <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

<!-- Bootstrap script -->
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/tether/dist/js/tether.min.js') }}"></script>
<!-- <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script> -->
<!-- Js effects for material design. + Tooltips -->
<script src="{{ asset('assets/js/material.min.js') }}"></script>
<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
<script src="{{ asset('assets/js/theme-plugins.js') }}"></script>
<!-- Init functions -->
<script src="{{ asset('assets/js/main.min.js') }}"></script>
<!-- vendor script -->
<!-- script -->
<!-- app script -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>

<script src='{{ asset('js/nprogress.js') }}'></script>
<!-- main sqrfactor js -->
<script src="{{ asset('js/main-sqrfactor.js') }}"></script>
<script src='{{ asset('js/nprogress.min.js') }}'></script>

<script src='{{ asset('js/nprogress.min.js') }}'></script>

{{--sweet alert--}}
<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

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