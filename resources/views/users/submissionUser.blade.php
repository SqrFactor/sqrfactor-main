@extends('layouts.app-users')

@section('content')
<div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-xl-3">
                <!-- Personal Info -->
                @include('users.partials.user-left-sidebar')
            </div>
            <!-- End Left Sidebar -->
            <!-- Main Content -->
            <div class="col-xl-9">
                 {{-- / How to submit design --}}
                @include('users.partials.competitions-design-modal')
                <div class="container">
                    <div class="competition-submissions">

                        <!-- top -->
                        <div class="competition-submissions-top font-color-gray d-flex flex-wrap align-items-center mb-5">
                            <div class="competition-submission-filter mr-auto pt-2 pb-2">
                                <a href="#" class="h6 mr-3 link-inverse" >Design submission</a>
                            </div>
                            
                        </div>
                        <!-- end top -->

                        <!-- submission list -->
                        <div class="composition-submission-list">
                            <div class="row" id="html-dump">
                                @include('users.partials.users-like')
                                @foreach($items as $item)
                               
                                    <div class="col-lg-4 col-md-6">
                                        @include('users.partials.competition-submission-card-item')
                                    </div>
                                @endforeach
                            </div>
                            {{$items->render()}}
                        </div>
                        <!-- end submission list -->

                    </div>
                </div>
            </div>
            <!-- End Main Content -->
        </div>
</div>
@endsection

