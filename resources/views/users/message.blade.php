@extends('layouts.app-users')

@section('title'){{ $user->fullName() }} | SqrFactor @endsection
@section('content_description')
    @if($user->userDetail->short_bio != null)
        {{ $user->userDetail->short_bio }}
    @else An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!
    @endif
@endsection

@section('styles')
    <!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="{{asset('css/chat-realtime.css')}}" rel="stylesheet">-->
@endsection

@section('content')

    <div class="header-spacer-fit hidden-sm-up"></div>
    <div class="container">
        {{--users like model--}}
        @include('users.partials.users-like')

        @include('users.partials.required-filed')


        <div class="container">
            <div class="ui-block">
                <div class="ui-block-title">
                    <h6 class="title">Chat / Messages</h6>
                    <a href="#" class="more">
                        <svg class="olymp-three-dots-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#olymp-three-dots-icon"></use>
                        </svg>
                    </a>
                </div>
                <div class="row">
                    <!-- right column -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <!-- padding-l-0 -->
                        <!-- chat field -->
                        <div class="chat-field b-l-0 ">
                            <div class="ui-block-title">
                                <h6 class="title"><b>{{$user->user_name}}({{$user->first_name}} {{$user->last_name}})</b></h6>
                                <a href="#" class="more">
                                    <svg class="olymp-three-dots-icon">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#olymp-three-dots-icon"></use>
                                    </svg>
                                </a>
                            </div>
                            <div class="mCustomScrollbar scroll-bottom ps ps--theme_default ps--active-y" data-mcs-theme="dark" data-ps-id="55671391-f5ad-efa0-3b6d-fc4bbdc4d632">



                                <input type="hidden" id="from" value="{{Auth::user()->id}}"/>
                                <input type="hidden" id="from_name" value="{{Auth::user()->user_name}}"/>
                                <input type="hidden" id="to" value="{{$user->id}}"/>
                                <input type="hidden" id="to_name" value="{{$user->user_name}}"/>




                                <ul class="notification-list chat-message chat-message-field chat">
                                </ul>
                                <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 520px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 359px;"></div></div></div>
                            <form class="clearfix">
                                <div class="form-group label-floating mb-2 is-empty">
                                    <label class="control-label">Write your reply here...</label>
                                    <textarea class="form-control" placeholder="" id="message"></textarea>
                                    <span class="material-input"></span></div>
                                <div class="add-options-message">
                                    <a href="#" class="options-message">
                                        <svg class="olymp-computer-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#olymp-computer-icon"></use>
                                        </svg>
                                    </a>
                                    <a href="#" class="options-message">
                                        <svg class="olymp-computer-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#olymp-computer-icon"></use>
                                        </svg>
                                    </a>
                                    <div class="options-message smile-block">
                                        <svg class="olymp-happy-sticker-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#olymp-happy-sticker-icon"></use>
                                        </svg>

                                        <ul class="more-dropdown more-with-triangle triangle-bottom-right">
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat1.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat2.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat3.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat4.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat5.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat6.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat7.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat8.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat9.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat10.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat11.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat12.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat13.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat14.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat15.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat16.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat17.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat18.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat19.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat20.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat21.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat22.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat23.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat24.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat25.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat26.png" alt="icon">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="../assets/images/chat/icon-chat27.png" alt="icon">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <button class="btn btn-primary btn-sm" id="send" type="submit">Post Reply</button>
                                </div>
                            </form>
                        </div>
                        <!-- end chat field -->
                    </div>
                    <!-- end right column -->
                </div>
            </div>
        </div>
    </div>
    @include('users.partials.post-detail-view-model')

@endsection

@section('scripts')
    <script src="{{asset('assets/js/chat-realtime-static.js')}}"></script>
@endsection
