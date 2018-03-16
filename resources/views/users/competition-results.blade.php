@extends('layouts.app-news-feed')

@section('title') {{$competition->competition_title}} | results | competition | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

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
    @include('users.partials.competitions-design-modal')
    @include('users.partials.users-like')
    <div class="container">

        <div class="competition-submissions">
            {{-- Loop through all the multiple awards --}}
            @foreach($competition->usersCompetitionDesignSubmitionAward as $itemMain)
                <h4 class="h4 mb-4">{{$itemMain->title}} <span class="pull-right">{{$itemMain->time}}</span></h4>
                <hr/>
                <div class="clearfix"></div>
                <div class="composition-submission-list">
                    <div class="row">
                    @foreach($itemMain->usersCompetitionDesignSubmitionAwardItem as $item)
                       
                        @if($item->usersCompetitionsDesign != null)
                                @if($item->usersCompetitionsAward->award_type == "1_prize" && $item->usersCompetitionsDesign != null)
                                {{-- Winner --}}
                                <div class="col-lg-12 col-md-12">
                                            <h6 class="h6 mb-4">Winner <img src="{{asset('assets/images/trophy-icon.png')}}"
                                                                            alt="">
                                            </h6>
                                            <div class="competition-submission-winner">
                                                 @if($item->usersCompetitionsDesign != null)
                                    @include('users.partials.competition-submission-card-item',[
                                        'item' => $item->usersCompetitionsDesign
                                    ])
                                @endif
                                        </div>
                                    </div>
                                    {{-- / WInner--}}
                                @else
                                    <!-- Check Design null to ny hai -->
                                    @if($item->usersCompetitionsDesign != null)
                                        {{-- Second & third & other --}}
                                        <div class="col-lg-4 col-md-6">
                                            @if($item->usersCompetitionsAward->award_type == "2_prize")
                                                <h6 class="h6 mb-4">2nd Prize</h6>
                                            @elseif($item->usersCompetitionsAward->award_type == "3_prize")
                                                <h6 class="h6 mb-4">3rd Prize</h6>
                                            @else
                                                <h6 class="h6 mb-4">{{$item->usersCompetitionsAward->award_type}}</h6>
                                            @endif

                                            @if($item->usersCompetitionsDesign != null)
                                                @include('users.partials.competition-submission-card-item',[
                                                    'item' => $item->usersCompetitionsDesign,
                                                    "submissionFlag" => 'y'
                                                ])
                                            @endif
                                        </div>
                                        {{-- / Second & third & other --}}
                                    @endif
                                @endif
                        @endif
                    @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
