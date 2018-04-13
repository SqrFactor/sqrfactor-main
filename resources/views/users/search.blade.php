@extends('layouts.app-news-feed')
@section('title') Search  | SqrFactor @endsection
@section('content')
    <div class="header-spacer hidden-xs-down"></div>
    <div class="header-spacer-fit hidden-sm-up"></div>

    <div class="container">
        <div class="row" class="pagination-parents">
            <!-- Main Content -->
            <div class="col-xl-6 push-xl-3 ">
                {{-- Notification --}}

                <div class="ui-block">
                    <div class="ui-block-title">
                        <h6 class="title"> Search results for <span class="text-uppercase">{{$search}}...</span> </h6>
                        <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
                    </div>
                      @if(count($results) > 0 )
                            @foreach ($results as $user)
                                <ul class="notification-list all-notification">
                                    @if(!empty($user->name))
                                        <!-- $name = $user->name; -->
                                        @if(Auth::id() == $user->id)
                                                       <!-- $route = route('profile'); -->
                                                       <li>
                                                        <div style="width:20%; text-align: center;">
                                                        <a href="{{route('profile')}}">
                                                        <img src="{{asset($user->profile)}}" style="height:50px; margin-right:15px">
                                                        </div>
                                                        <div style="width:80%">
                                                        <span>{{$user->name}} 
                                                       </span></a>
                                                        </div>
                                                        </li>
                                                @else
                                                   <!-- $route = route("profileView",$user->user_name); -->
                                                    
                                                <li>
                                                    <div style="width:20%;text-align: center;">
                                                    <a href="{{route('profileView', $user->user_name)}}">
                                                    <img src="{{asset($user->profile)}}" style="height:50px; margin-right:15px">
                                                    </div>
                                                    <div style="width:80%">
                                                    <span> {{ $user->name }} </span></a>
                                                    </div>
                                                    </li>
                                                  
                                             @endif
                                         @elseif(!empty($user->first_name))
                                            <!-- $name = $user->first_name $user->last_name; -->
                                            @if(Auth::id() == $user->id)
                                                       <!-- $route = route('profile'); -->
                                                       <li>
                                                        <div style="width:20%;text-align: center;">
                                                        <a href="{{route('profile')}}">
                                                        <img src="{{asset($user->profile)}}" style="height:50px; margin-right:15px">
                                                        </div>
                                                        <div style="width:80%">
                                                        <span>{{ $user->first_name  }} {{$user->last_name}} </span></a>
                                                        </div>
                                                        </li>
                                                @else
                                                   <!-- $route = route("profileView",$user->user_name); -->
                                                    
                                                <li>
                                                    <div style="width:20%;text-align: center;">
                                                    <a href="{{route('profileView', $user->user_name)}}">
                                                    <img src="{{asset($user->profile)}}" style="height:50px; margin-right:15px">
                                                    </div>
                                                    <div style="width:80%">
                                                    <span>{{ $user->first_name }} {{$user->last_name}} </span></a>
                                                    </div>
                                                    </li>
                                                  
                                            @endif  
                                     @endif   


                                 </ul>                  
                             @endforeach
                             @else
                             <h6 style="padding: 10px; margin-left: 18px;"> No results Found.... </h6>
                         @endif
                </div>

                {{-- / Notification --}}
            </div>

            

        </div>
    </div>
@endsection


