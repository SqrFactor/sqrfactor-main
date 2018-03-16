@extends('layouts.app-sqrfactor')

@section('content')

    @include('users.partials.competitions-header')



    <div class="competition-detail font-color-gray">
        <div class="container">
            <div class="row">
                <!-- main content -->
                <div class="col-lg-9">
                    <div class="ui-block">
                        <div class="ui-block-content">
                            <h3>Brief</h3>
                        {!!  $competition->brief !!}
                        <!-- awards -->
                            <h3>Prizes & Awards</h3>
                            <div class="competition-awards">
                                @if(count($competition->usersCompetitionsAward) > 0)
                                    @foreach($competition->usersCompetitionsAward as $item)
                                        <div class="ui-block">
                                            <div class="ui-block-content">
                                                <div class="media">
                                                    @if($item->award_type == "1_prize")
                                                        <img class="d-flex"
                                                             src="{{asset('assets/images/competition-award-1.png')}}"
                                                             alt="1st Prize">
                                                    @elseif($item->award_type == "2_prize")
                                                        <img class="d-flex"
                                                             src="{{asset('assets/images/competition-award-2.png')}}"
                                                             alt="2nd Prize">
                                                    @elseif($item->award_type == "3_prize")
                                                        <img class="d-flex"
                                                             src="{{asset('assets/images/competition-award-3.png')}}"
                                                             alt="3rd Prize">
                                                    @else
                                                        <img class="d-flex"
                                                             src="{{asset('assets/images/competition-award-4.png')}}"
                                                             alt="Prize">
                                                    @endif

                                                    <div class="media-body">
                                                        <h5>{{$item->award_currency}} {{$item->award_amount}}</h5>
                                                        {{$item->award_extra}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <!-- end awards -->
                            <!-- content -->
                            <div class="competition-detail-content mt-5">
                                <h3>Eligibility Criteria</h3>
                                {!! $competition->eligibility_criteria !!}

                                <h3>Awards Other Details</h3>
                                {!! $competition->honourable_mentions !!}

                                {{--<h3>Rules and Regulations</h3>--}}
                                {{--<ul>--}}
                                {{--<li>Participant teams will be disqualified if any of the competition rules or--}}
                                {{--submission requirements are not considered.--}}
                                {{--</li>--}}
                                {{--<li>Participation assumes acceptance of the regulations.</li>--}}
                                {{--<li>Registration number is the only means of identification of a team as it is an--}}
                                {{--anonymous competition.--}}
                                {{--</li>--}}
                                {{--<li>The official language of the competition is English.</li>--}}
                                {{--<li>The registration fee is non-refundable.</li>--}}
                                {{--<li>Contacting the Jury is prohibited.</li>--}}
                                {{--<li>SqrFactor as the competition organizer, reserves the right to modify the--}}
                                {{--competition schedule if deemed necessary.--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--<h3>Terms and Conditions</h3>--}}
                                {{--<p>Please see the terms and conditions section on www.sqrfactor.in</p>--}}

                                <h3>Jury</h3>
                                <div class="d-flex flex-wrap">
                                    @if(count($competition->userCompetitionJury) > 0)
                                        @foreach($competition->userCompetitionJury as $item)
                                            @if($item->jury_id != null)
                                                <div class="jury-item">
                                                    <img style="margin-bottom: 5px;"
                                                         src="{{asset($item->user->profile)}}">
                                                    <h6><a target="_blank"
                                                           href="{{route("profileView",$item->user->user_name)}}">{{ $item->user->fullName()}}</a>
                                                    </h6>
                                                    {{@$item->user->userDetail->name_of_the_company}},
                                                    {{@$item->user->userDetail->city->name}}
                                                </div>
                                            @else
                                                <div class="jury-item">
                                                    @if(empty($item->jury_logo))
                                                        <img style="margin-bottom: 5px;"
                                                             src="{{asset('assets/images/avatar.png')}}">
                                                    @else
                                                        <img style="margin-bottom: 5px;"
                                                             src="{{asset($item->jury_logo)}}">
                                                    @endif
                                                    <h6>{{$item->jury_fullname}}</h6> {{$item->jury_firm_company}}
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                                <h3>In Association with</h3>
                                {{-- Partner --}}
                                <div class="d-flex flex-wrap">
                                    @foreach($competition->userCompetitionPartner as $item)
                                        @if($item->partner_id != null)
                                            <div class="association-item">
                                                <img src="{{asset($item->user->profile)}}">
                                                <h6><a target="_blank"
                                                       href="{{route('profileView',$item->user->slug)}}">{{$item->user->name}}</a>
                                                </h6>
                                            </div>
                                        @else
                                            <div class="association-item">
                                                <img src="{{asset($item->partner_logo)}}">
                                                <div>{{$item->partner_name}}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <h3>Download Attachment</h3>
                                @foreach($competition->userCompetitionAttachment as $item)
                                    <p>
                                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                                        <a target="_blank" href="{{asset($item->attach_documents)}}">Attachment File</a>
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end main content -->
                <!-- Right side -->
                <div class="col-lg-3">
                    @if($competition->competition_type == "paid")
                        <ul class="widget w-personal-info item-block">
                            <li>
                                <div class="text">
                                    <b>Early Bird Registration</b>
                                    <br>
                                    From {{$competition->early_bird_registration_start_date}}
                                    to {{$competition->early_bird_registration_end_date}}
                                    @foreach($competition->userCompetitionRegistrationType->where("registration_type","early_bird") as $item)
                                        <br> {{$item->currency}} {{$item->amount}} ({{$item->type}})
                                    @endforeach
                                </div>
                            </li>
                            <li>
                                <div class="text">
                                    <b>Advance Registration</b>
                                    <br>
                                    From {{$competition->advance_registration_start_date}}
                                    to {{$competition->advance_registration_end_date}}
                                    @foreach($competition->userCompetitionRegistrationType->where("registration_type","advance") as $item)
                                        <br> {{$item->currency}} {{$item->amount}} ({{$item->type}})
                                    @endforeach
                                </div>
                            </li>
                            <li>
                                <div class="text">
                                    <b>Last Minute Registration</b>
                                    <br>
                                    From {{$competition->last_minute_registration_start_date}}
                                    to {{$competition->last_minute_registration_end_date}}
                                    @foreach($competition->userCompetitionRegistrationType->where("registration_type","last_minute") as $item)
                                        <br> {{$item->currency}} {{$item->amount}} ({{$item->type}})
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    @endif
                    <div class="ui-block mb-4">
                        <div class="ui-block-content p-3">
                            <strong>Note</strong>: It will not be possible to amend or update any information relating
                            to your registration including the names of team members once validated.
                        </div>
                    </div>
                    <a href="#" class="btn btn-lg font-size-base btn-gray-lighter btn-block font-weight-bold">Register
                        For Competition</a>
                </div>
                <!-- End Right side -->
            </div>
        </div>
    </div>

@endsection
