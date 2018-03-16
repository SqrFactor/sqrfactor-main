@extends('layouts.app-sqrfactor')

@section('content')
    <center>
        <p style="font-size: 200px">404</p>
        <h1>Page not found</h1>
        <a href="{{URL::to("/")}}" class="btn btn-lg btn-secondary " style="font-size: 1.125rem;border-radius: 7.3rem;    padding: 5px 20px!important;
    text-transform: none!important;
    font-weight: 400;
    margin-top: 8px!important;background-color: #FB4343;border: 2px solid #FB4343 !important;">Go Back</a>
        <br>
        <br>
    </center>
@endsection