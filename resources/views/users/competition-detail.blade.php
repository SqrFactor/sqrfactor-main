@extends('layouts.app-news-feed')

@section('title') {{$competition->competition_title}} | competition | SqrFactor @endsection
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

@section('styles')
    @include('users.partials.medium-editor-css')
    @endsection

@section('content')
    {{-- Show edit modal only when i am the owner of the page --}}
    @if(Auth::id() == $competition->user_id)
        @include('users.partials.competitions-edit-modal')
    @endif

    @include('users.partials.competitions-header')

    <div class="competition-detail font-color-gray">
        <div class="container">
            <div class="row">
                <!-- main content -->
                <div class="col-lg-9">
                    <div class="ui-block">
                        <div class="ui-block-content">
                            <h3>Brief
                                @if(Auth::id() == $competition->user_id)
                                    <a href="#editBrief" class="btn btn-primary btn-sm" data-toggle="modal">
                                        <i class="fa fa-pencil"></i>
                                        <div class="ripple-container"></div>
                                    </a>
                                @endif
                            </h3>
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
                                                        <h5>
                                                            @if($item->award_type == "1_prize")
                                                                1st Prize
                                                            @elseif($item->award_type == "2_prize")
                                                                2nd Prize
                                                            @elseif($item->award_type == "3_prize")
                                                                3rd Prize
                                                            @else
                                                                {{$item->award_type}}
                                                            @endif
                                                            @if($item->award_amount != 0)
                                                            - {{$item->award_currency}} {{$item->award_amount}}
                                                            @endif
                                                            </h5>
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
                               <!--  <h3>Eligibility Criteria @if(Auth::id() == $competition->user_id)
                                        <a href="#eligibilityCriteria_awardstherDetails" class="btn btn-primary btn-sm"
                                           data-toggle="modal">
                                            <i class="fa fa-pencil"></i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endif</h3>
                                {!! $competition->eligibility_criteria !!}

                                @if(strlen($competition->honourable_mentions) <= 7 && Auth::id() != $competition->user_id)
                                    <h3>Awards Other Details</h3>
                                    {!! $competition->honourable_mentions !!}
                                @endif
 -->
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

                                <h3>Jury
                                    @if(Auth::id() == $competition->user_id)
                                        <a href="#editJury" class="btn btn-primary btn-sm" data-toggle="modal">
                                            <i class="fa fa-pencil"></i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endif
                                </h3>
                                <div class="d-flex flex-wrap">
                                    @if(count($competition->userCompetitionJury) > 0)
                                        @foreach($competition->userCompetitionJury as $item)

                                            @if($item->jury_id != null)

                                                <div class="jury-item">
                                                    <img style="width:100px;margin-bottom: 5px;"
                                                         src="{{asset($item->user->profile)}}">
                                                    <h6><a target="_blank"
                                                           href="{{route("profileView",$item->user->user_name)}}">{{ $item->user->fullName()}}</a>
                                                    </h6>
                                                    {{--{{@$item->user->userDetail->name_of_the_company}},--}}
                                                    {{--{{@$item->user->userDetail->city->name}}--}}
                                                </div>
                                            @elseif(Auth::id() == $competition->user_id)
                                          
                                                <div class="jury-item">
                                                    @if(empty($item->jury_logo))
                                                        <img style="width:100px;margin-bottom: 5px;"
                                                             src="{{asset('assets/images/avatar.png')}}">
                                                    @else
                                                        <img style="width:100px;margin-bottom: 5px;"
                                                             src="{{asset($item->jury_logo)}}">
                                                    @endif
                                                    <h6>{{$item->jury_fullname}}</h6>
                                                    {{--{{$item->jury_firm_company}}--}}
                                                </div>
                                                @else
                                               
                                                 <div class="jury-item">
                                                   
                                                    <h6>No Jury</h6>
                                                   
                                                </div>
                                            @endif
                                        @endforeach
                                        @else
                                         <div class="jury-item">
                                                   
                                            <h6>No Jury</h6>
                                           
                                        </div>
                                    @endif
                                </div>

                              
                                @if(count($competition->userCompetitionPartner) > 0 || Auth::id() == $competition->user_id)

                                    <h3>In Association with
                                        @if(Auth::id() == $competition->user_id)
                                            <a href="#inAssociationWith" class="btn btn-primary btn-sm"
                                               data-toggle="modal">
                                                <i class="fa fa-pencil"></i>
                                                <div class="ripple-container"></div>
                                            </a>
                                        @endif
                                    </h3>
                                    {{-- Partner --}}
                                    <div class="d-flex flex-wrap">
                                        @foreach($competition->userCompetitionPartner as $item)
                                            @if($item->partner_id != null)
                                                <div class="association-item">
                                                    <img src="{{asset($item->user->profile)}}">
                                                    <h6><a target="_blank"
                                                           href="{{route('profileView',$item->user->user_name)}}">{{$item->user->fullName()}}</a>
                                                    </h6>
                                                </div>
                                            @elseif(Auth::id() == $competition->user_id)

                                                <div class="association-item">
                                                    <img src="{{asset($item->partner_logo)}}">
                                                    <h6>{{$item->partner_name}}</h6>
                                                </div>
                                                @else
                                                 <div class="jury-item">
                                                   
                                                    <h6>No Association</h6>
                                                   
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                                {{--<h3>Download Attachment @if(Auth::id() == $competition->user_id)--}}
                                {{--<a href="#downloadAttachment" class="btn btn-primary btn-sm" data-toggle="modal">--}}
                                {{--<i class="fa fa-pencil"></i>--}}
                                {{--<div class="ripple-container"></div></a>--}}
                                {{--@endif</h3>--}}
                                {{--@foreach($competition->userCompetitionAttachment as $item)--}}
                                {{--<p>--}}
                                {{--<i class="fa fa-paperclip" aria-hidden="true"></i>--}}
                                {{--<a target="_blank" href="{{asset($item->attach_documents)}}">Attachment File</a>--}}
                                {{--</p>--}}
                                {{--@endforeach--}}




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
                        <div class="ui-block-content p-3">
                            <strong>Download Attachment @if(Auth::id() == $competition->user_id)
                                    <a href="#downloadAttachment" class="btn btn-primary btn-sm" data-toggle="modal">
                                        <i class="fa fa-pencil"></i>
                                        <div class="ripple-container"></div>
                                    </a>
                                @endif
                            </strong>
                            @foreach($competition->userCompetitionAttachment as $item)
                                <p>
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                    <a target="_blank" href="{{asset($item->attach_documents)}}">Download Brief</a>
                                </p>
                            @endforeach
                        </div>
                    </div>

                     <div class="ui-block mb-4">
                        <div class="ui-block-content p-3">
                            <h4>Eligibility Criteria @if(Auth::id() == $competition->user_id)
                                <a href="#eligibilityCriteria_awardstherDetails" class="btn btn-primary btn-sm"
                                   data-toggle="modal">
                                    <i class="fa fa-pencil"></i>
                                    <div class="ripple-container"></div>
                                </a>
                            @endif</h4>
                        </div>
                        <div class="ui-block-content p-3">
                             {!! $competition->eligibility_criteria !!}

                                @if(strlen($competition->honourable_mentions) <= 7 && Auth::id() != $competition->user_id)
                                    <h3>Awards Other Details</h3>
                                    {!! $competition->honourable_mentions !!}
                                @endif
                           
                        </div>
                    </div>

                    <a href="javascript:void(0)"
                       class="btn btn-lg font-size-base btn-gray-lighter btn-block font-weight-bold participate_in_competition">Register
                        For Competition</a>
                </div>
                <!-- End Right side -->
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @include('users.partials.medium-editor-js')
    <script>
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () {
            null
        };

        var editor = new MediumEditor('.editable');

        $('.editable').mediumInsert({
            editor: editor
        });

//        var editor = new MediumEditor('.editable');
//
//        $(function () {
//            $('.editable').mediumInsert({
//                editor: editor
//            });
//        });
    </script>
@endsection
