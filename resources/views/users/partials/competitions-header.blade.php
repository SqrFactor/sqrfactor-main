<input type="hidden" id="competition_id" value="{{$competition->id}}">

<div class="header-spacer-fit"></div>
<!-- top banner -->
<div class="modal fade" id="compition-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Participation details</h5>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal"  aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="participate-form">
                            <div class="form-group label-floating">
                                <label class="control-label">Participate</label>
                                <input type="text" name="participate[]"
                                       class="form-control compition-search"
                                       @if(Auth::check())
                                       value="{{ Auth::user()->fullName()}}"
                                        @endif >
                                <input type="hidden" name="participate_id[]"  @if(Auth::check())  value="{{Auth::user()->id}}" @endif >

                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Participate</label>
                                <input type="text" name="participate[]" class="form-control compition-search">
                                <ul class="people-search account-settings ajax_search competitions-jury competitions-participation"></ul>
                                <input type="hidden" name="participate_id[]" value="">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Participate </label>
                                <input type="text" name="participate[]" class="form-control compition-search">
                                <ul class="people-search account-settings ajax_search competitions-jury competitions-participation"></ul>
                                <input type="hidden" name="participate_id[]" value="">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Participate </label>
                                <input type="text" name="participate[]" class="form-control compition-search">
                                <ul class="people-search account-settings ajax_search competitions-jury competitions-participation"></ul>
                                <input type="hidden" name="participate_id[]" value="">

                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Participate </label>
                                <input type="text" name="participate[]" class="form-control compition-search">
                                <ul class="people-search account-settings ajax_search competitions-jury competitions-participation"></ul>
                                <input type="hidden" name="participate_id[]" value="">

                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Mentor </label>
                                <input type="text" name="mentor[]" class="form-control compition-search">
                                <ul class="people-search account-settings ajax_search competitions-jury competitions-participation"></ul>
                                <input type="hidden" name="mentor_id[]" value="">

                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Mentor </label>
                                <input type="text" name="mentor[]" class="form-control compition-search">
                                <ul class="people-search account-settings ajax_search competitions-jury competitions-participation"></ul>
                                <input type="hidden" name="mentor_id[]" value="">
                            </div>
                            <input type="hidden" name="compition_id" value="{{$competition->id}}">
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" id="participate_btn">Participate</button>
            </div>
        </div>
    </div>
</div>

<div class="competition-banner" style="background-image: url({{asset($competition->cover_image)}})">
    <div class="container">
        <h1 class="title">{{$competition->competition_title}}
            @if($competition->user_id ==  Auth::id())
                <a href="#editNameAndCover" class="btn btn-outline btn-sm" data-toggle="modal">
                    <i class="fa fa-pencil fa-2x"></i>
                </a>
            @endif</h1>
        <div class="deadline">Deadline {{$competition->schedule_close_date_of_registration}}</div>
        {{--
            Cash Prize
        --}}
        <div class="cash-prize">
            @if($competition->usersCompetitionsAward->where("award_type","1_prize")->first()->award_amount != 0)
            PRIZE
            @if($competition->usersCompetitionsAward->where("award_type","1_prize")->first()->award_currency == "USD")
                <i class="fa fa-dollar"></i>
            @elseif($competition->usersCompetitionsAward->where("award_type","1_prize")->first()->award_currency == "INR")
                <i class="fa fa-rupee"></i>
            @endif
            {{$competition->usersCompetitionsAward->where("award_type","1_prize")->first()->award_amount}}
            @endif
        </div>
        <!-- data-toggle="modal" data-target="#compition-modal" -->
        <div class="button-actions">
            <a href="javascript:void(0)" class="btn btn-secondary btn-lg participate_in_competition"  >Participate in
                Competition</a>
            <a href="{{route("competition.submit.design",$competition->slug)}}" id="submit_design_in_competition"
               class="btn btn-primary btn-lg" data-work="false">Submit Design in Competition</a>
        </div>
        <div class="social-share">
            <a href="{{Share::load(route('competition',$competition->slug), $competition->competition_title)->facebook()}}"
               target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="{{Share::load(route('competition',$competition->slug), $competition->competition_title)->twitter()}}"
               target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="{{Share::load(route('competition',$competition->slug),$competition->competition_title)->gplus()}}"
               target="_blank"><i class="fa fa-google-plus"></i></a>
            <a href="{{Share::load(route('competition',$competition->slug),$competition->competition_title)->linkedin()}}"
               target="_blank"><i class="fa fa-linkedin"></i></a>
        </div>
    </div>
</div>
<!-- end top banner -->

<!-- navbar -->
<div class="competition-navbar">
    <div class="container">
        <div class="row">
            <div class="offset-xl-2 offset-lg-1">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link {{isActiveRoute('competition')}}"
                           href="{{route("competition",$competition->slug)}}">Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ isActiveRoute('competition.wall')}}"
                           href="{{route("competition.wall",$competition->slug)}}">Wall</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{isActiveRoute("competition.submission")}}"
                           href="{{route('competition.submission',$competition->slug)}}">Submissions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{isActiveRoute("competition.result")}}"
                           href="{{route('competition.result',$competition->slug)}}">Results</a>
                    </li>
                    @if(Auth::id() == $competition->user_id)
                        <li class="nav-item">
                            <a class="nav-link {{isActiveRoute("competition.competitionadmin")}}"
                               href="{{route('competition.competitionadmin',$competition->slug)}}">Submit Results
                                (Admin)</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end navbar -->