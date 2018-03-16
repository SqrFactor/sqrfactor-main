@extends('layouts.app-news-feed')

@section('title') What's Red  | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')
    <div class="header-spacer hidden-xs-down"></div>
    <div class="header-spacer-fit hidden-sm-up"></div>

    <div class="container">
        <div class="newsfeed-main-buttons">
            <div class="row">
                <div class="col-6">
                    <a href="{{ route('home') }}" class="btn btn-block">News Feed</a>
                </div>
                <div class="col-6">
                    <a href="{{ route('whatsRed') }}" class="btn btn-block active">What's Red ?</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        {{--users like model--}}
        @include('users.partials.users-like')

        @include('users.partials.required-filed')

        <div class="row">
            <!-- Main Content -->
            <div class="col-xl-6 push-xl-3 ">


                <!-- newsfeed -->
                <div id="newsfeed-items-grid">
                    @if($posts != null)

                        @foreach($posts as $post )
                            {{-- Design --}}
                            @include("users.partials.news-feed-n-profile-post",compact('post'))
                            {{-- /Design --}}
                        @endforeach
                   @endif
                </div>

                <input type="hidden" id="whatsred-counter" value="1">

                <a id="whatsred-load-more" href="#" class="btn btn-control btn-more btn-load-new" data-container="newsfeed-items-grid">
                    Load more  
                    <div class="ripple-container"></div>
                </a>
                 <p class="text-center load-more-text" style="display: none !important;"></p>   
            </div>

            <!-- Left Sidebar -->
            @include('users.partials.user-left-sidebar2')
           <!-- End Left Sidebar -->

            <!-- Right Sidebar -->
            @include('users.partials.user-right-sidebar')

        </div>
    </div>

    @include('users.partials.post-detail-view-model')


@endsection

