@extends('layouts.app-news-feed')
@section('content')
    @if(Auth::check())
    @include('users.partials.model')
    @endif
    @endsection