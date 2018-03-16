@extends('layouts.app-users')
@section('title') {{ Auth::user()->fullName() }} | SqrFactor @endsection
@section('content_description')@if(Auth::user()->userDetail->short_bio != null) {{ Auth::user()->userDetail->short_bio }} @else
        An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!
    @endif
@endsection

@section('content')
    <div class="header-spacer-fit hidden-sm-up"></div>

    <div class="container">

        {{--users like model--}}
        @include('users.partials.users-like')

        @include('users.partials.required-filed')

        <div class="row">
            <!-- Main Content -->
            <div class="col-xl-6 push-xl-3 ">

            {{-- include news feed form--}}
            @include("users.partials.news-feed-post-from")

            <!-- newsfeed -->
                <div id="newsfeed-items-grid" class="post-data">
                    @foreach($posts as $post)
                        {{-- Design --}}
                        @include("users.partials.news-feed-n-profile-post",compact('post'))
                        {{-- /Design --}}
                    @endforeach
                </div>

                {{ $posts->links() }}

            </div>
            <!-- Left Sidebar -->
            <div class="col-xl-3 pull-xl-6 col-lg-6">
                @include('users.partials.user-left-sidebar')
            </div>
            <!-- End Left Sidebar -->
            <!-- Right Sidebar -->
            @include('users.partials.user-right-sidebar')
        </div>

    </div>

    @include('users.partials.post-detail-view-model')


@endsection