@extends('layouts.app-news-feed')
 

@section('title') {{$competition->competition_title}} | submission | competition | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

{{--@section('onload')--}}
    {{--onload="getCompetitionSubmissionHTML('{{$competition->id}}','newest')"--}}
{{--@endsection--}}

@section('content')
    @include('users.partials.competitions-header')
    <!-- How to submit design -->
    <div class="modal fade" id="gifModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img src="{{asset('img/gif/how.gif')}}" style="width:100% !important;">
                </div>

            </div>
        </div>
    </div>
    {{-- / How to submit design --}}
    @include('users.partials.competitions-design-modal')
    <div class="container">
        <div class="competition-submissions">

            <!-- top -->
            <div class="competition-submissions-top font-color-gray d-flex flex-wrap align-items-center mb-5">
                <div class="competition-submission-filter mr-auto pt-2 pb-2">
                    <a href="#" class="h6 mr-3 link-inverse" data-toggle="modal" data-target="#gifModal">How to submit designs in competition correctly?</a>
                </div>
                <div class="competition-submission-sort ml-auto">
                    <div class="d-flex align-items-center">
                        <span class="h6 mr-3">Sort by : </span>
                        <div class="form-group is-select mb-0">
                            <select class="selectpicker form-control select-filter select-filter-right" id="competition_submission_selectpicker">
                                <option value="newest" selected>Newest</option>
                                <option value="oldest">Oldest</option>
                            </select>
                        </div>
                    </div>
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
@endsection
