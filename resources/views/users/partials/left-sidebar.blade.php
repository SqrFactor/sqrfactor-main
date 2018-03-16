@if(Auth::check())

   @if(Auth::user()->type == 'hire')



       @if(Auth::user()->user_type == 'hire_individual')
           <div class="col-xl-3">
               <div class="ui-block">
                   <div class="ui-block-title">
                       <h6 class="title"> Profile Completion </h6>
                   </div>
                   <div class="ui-block-content">
                       <ul class="account-settings-menu">

                           <li><a href="{{ route('profile.edit') }}" class="{{ isActiveRoute('profile.edit'),"active"}} ">Basic Details</a>

                               {{--profile complete--}}
                               @if(Auth::user()->first_name !== null &&  Auth::user()->last_name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->userDetail->gender !== null && Auth::user()->mobile_number !== null)
                                   <img src="{{ asset('img/complete.png') }}" alt=""> @endif
                               {{--end profile complete--}}

                           </li>
                           @if(Auth::user()->password != Null)
                           <li><a href="{{ route('change.password') }}" class="{{ isActiveRoute('change.password'),"active"}} " class="{{ isActiveRoute('change.password'),"active"}} ">Change Password</a></li>
                           @endif
                       </ul>
                   </div>
                  {{-- <div class="ui-block-title">
                       <h6 class="title"> Notifications </h6>
                   </div>--}}
               </div>
           </div>
       @endif


       @if(Auth::user()->user_type == 'hire_organization' || Auth::user()->user_type == 'real_estate_firm_companies')

           <div class="col-xl-3">
               <div class="ui-block">
                   <div class="ui-block-title">
                       <h6 class="title">Profile Completion </h6>
                   </div>
                   <div class="ui-block-content">
                       <ul class="account-settings-menu">

                           <li><a href="{{ route('profile.edit') }}" class="{{ isActiveRoute('profile.edit'),"active"}} ">Basic Details</a>
                               {{--profile complete--}}
                               @if(Auth::user()->name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->mobile_number !== null)
                                   <img src="{{ asset('img/complete.png') }}" alt=""> @endif
                               {{--end profile complete--}}
                           </li>
                           <li><a href="{{ route('hire.hireOrganizationEmployeeDetail') }}" class="{{ isActiveRoute('hire.hireOrganizationEmployeeDetail'),"active"}} ">Employee Details</a></li>
                           @if(Auth::user()->password != Null)
                           <li><a href="{{ route('change.password') }}" class="{{ isActiveRoute('change.password'),"active"}} ">Change Password</a></li>
                           @endif

                       </ul>
                   </div>
                    {{--<div class="ui-block-title">
                       <h6 class="title"> Notifications </h6>
                   </div>--}}
               </div>
           </div>

           @endif




       @endif
      


    @if(Auth::user()->type == "work")
        @if(Auth::user()->user_type == 'work_individual')
            <div class="col-xl-3">
                <div class="ui-block">
                    <div class="ui-block-title">
                        <h6 class="title"> Profile Completion </h6>
                    </div>
                    <div class="ui-block-content">
                        <ul class="account-settings-menu">


                            <li><a href="{{ route('profile.edit') }}" class="{{ isActiveRoute('profile.edit'), "active"}}">Basic Details</a>
                                {{--profile complete--}}
                                @if(Auth::user()->first_name !== null &&  Auth::user()->last_name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->userDetail->gender !== null && Auth::user()->mobile_number !== null)
                                    <img src="{{ asset('img/complete.png') }}" alt=""> @endif
                                {{--end profile complete--}}
                            </li>
                            <li><a href="{{ route('work.workIndividualEducationDetails') }}" class="{{ isActiveRoute('work.workIndividualEducationDetails'),"active"}} ">Education Details </a>
                                {{--profile complete--}}

                                @if(Auth::user()->usersEducationDetails->first() != null && Auth::user()->usersEducationDetails->first()->course  != null && Auth::user()->usersEducationDetails->first()->college_university  != null && Auth::user()->usersEducationDetails->first()->year_of_admission   != null && Auth::user()->usersEducationDetails->first()->year_of_graduation != null)
                                    <img src="{{ asset('img/complete.png') }}" alt=""> @endif
                               {{--end profile complete--}}
                            </li>
                            <li><a href="{{ route('work.workIndividualProfessionalDetails') }}" class="{{ isActiveRoute('work.workIndividualProfessionalDetails'),"active"}}">Professional Details </a></li>
                            <li><a href="{{ route('work.workIndividualOtherDetails') }}" class="{{ isActiveRoute('work.workIndividualOtherDetails'),"active"}}"> Other Details </a></li>
                            @if(Auth::user()->password != Null)
                            <li><a href="{{ route('change.password') }}" class="{{ isActiveRoute('change.password'),"active"}} ">Change Password</a></li>
                            @endif
                            
                            
                        </ul>
                    </div>


                </div>
            </div>
        @endif

<!--  work_architecture -->

        @if(Auth::user()->user_type == 'work_architecture_firm_companies' OR Auth::user()->user_type == 'work_architecture_organizations' OR Auth::user()->user_type == 'work_architecture_college')
            <div class="col-xl-3">
                <div class="ui-block">
                    <div class="ui-block-title">
                        <h6 class="title"> Profile Completion </h6>
                    </div>
                    <div class="ui-block-content">
                        <ul class="account-settings-menu">


                            
                            <li><a href="{{ route('profile.edit') }}" class="{{ isActiveRoute('profile.edit'),"active"}} ">Basic Details</a>
                                {{--profile complete--}}
                                @if(Auth::user()->name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->mobile_number !== null)
                                    <img src="{{ asset('img/complete.png') }}" alt=""> @endif
                                {{--end profile complete--}}
                            </li>
                            <li><a href="{{ route('work.workArchitectureCompanyFirmDetails') }}" class="{{ isActiveRoute('work.workArchitectureCompanyFirmDetails'),"active"}} ">Company Firm Details</a></li>
                             <li><a href="{{ route('work.workArchitectureMemberDetail') }} "  class="{{ isActiveRoute('work.workArchitectureMemberDetail'),"active"}} ">Employee/Member Details</a></li>
                            @if(Auth::user()->password != Null)
                            <li><a href="{{ route('change.password') }}" class="{{ isActiveRoute('change.password'),"active"}} ">Change Password</a></li>
                            @endif

                             
                            



                        </ul>
                    </div>

                </div>
            </div>
        @endif

        @endif

    @endif