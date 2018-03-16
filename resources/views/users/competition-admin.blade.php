@extends('layouts.app-news-feed')

@section('og_title')
    {{$competition->competition_title}} | Sqrfactor Competition
@endsection

@section('og_description')
    {{$competition->competition_title}} competition Sqrfactor
@endsection

@section('og_image')
    {{asset($competition->cover_image)}}
@endsection

@section('content')

    @include('users.partials.competitions-header')
    <div class="container">
        <div class="row">
            <div class="col-xl-10">
                @include('error-message')

                <div class="competition-launch">
                    <h3 class="h3 mb-5">Result</h3>
                    <form id="award-declare" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div id="form-1">
                            {{-- title --}}
                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0 is-empty">
                                        <input type="text" class="form-control" placeholder="Enter the title"
                                               name="title"
                                               style="background-color: transparent;">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0 is-empty">
                                        <input type="text" class="form-control datepicker" placeholder="Enter date"
                                               name="time"
                                               style="background-color: transparent;">

                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <input type="hidden" name="competition_id" value="{{$competition->id}}">
                            </div>

                            @foreach($competition->usersCompetitionsAward as $award)
                                <div class="row form-group">
                                    <div class="col-lg-2">
                                        <label class=" col-form-label h6">
                                            @if($award->award_type =='1_prize' )
                                                {{"1st prize"}}
                                            @elseif($award->award_type =='2_prize')
                                                {{"2nd prize"}}
                                            @elseif($award->award_type =='3_prize')
                                                {{"3rd prize"}}
                                            @else
                                                {{$award->award_type}}
                                            @endif
                                        </label>
                                        <input type="hidden" name="result_id[]" value="{{$award->id}}">
                                    </div>
                                    <div class="col-lg-4">

                                        <select class="form-control award_selecter" data-placeholder="Award type"
                                                name="award_type[]">
                                            <option value="0" selected>Select</option>
                                            @foreach($competition->userCompetitionSubmission as $submission)
                                                <option value="{{$submission->id}}">{{$submission->code}} - {{$submission->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                            {{-- / title --}}
                            <div class="row pt-2">
                                <div class="col-lg-2 ">
                                    <button type="button" class="btn btn-primary btn-submit" id="award-declare-btn">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
