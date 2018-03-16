@extends('layouts.app-users')

@section('title') {{ $user->fullName() }}  | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

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
                {{--basic detail--}}
                <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Basic Detail</h6>
                        </div>
                        <div class="ui-block-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title"> @if($user->first_name != null && $user->last_name != null) Full Name @elseif($user->name != null) Name Of The Company/Firm @endif  </span>
                                            <div class="text">
                                                @if($user->first_name != null && $user->last_name != null) {{ $user->fullName() }} @elseif($user->name != null) {{ $user->fullName() }} @endif
                                            </div>
                                        </li>

                                    </ul>
                                </div>

                                {{--mobile number--}}
                                @if($user->mobile_number != null)
                                <div class="col-md-6">
                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title">   Mobile Number  </span>
                                            <div class="text">
                                                {{ $user->mobile_number }}
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                                 @endif

                                {{--gender --}}
                                @if($user->userDetail->gender != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">Gender  </span>
                                                <div class="text">
                                                    {{ $user->userDetail->gender }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{--Email --}}
                                @if($user->email != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Email  </span>
                                                <div class="text">
                                                    {{ $user->email }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{--Address --}}
                                @if($user->userDetail->country_id != null && $user->userDetail->state_id != null && $user->userDetail->city_id != null && $user->userDetail->address != null )
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Address  </span>
                                                <div class="text">
                                                   {{ $user->userDetail->address }} , {{ $user->fullAddress() }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{--Pin code --}}
                                @if($user->userDetail->pin_code != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Pincode  </span>
                                                <div class="text">
                                                    {{ $user->userDetail->pin_code }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{--UID (Aadhar Id)   --}}
                                @if($user->userDetail->aadhar_id != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   UID (Aadhar Id)    </span>
                                                <div class="text">
                                                    {{ $user->userDetail->aadhar_id }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{--Date Of birth  --}}
                                @if($user->userDetail->date_of_birth != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Date Of Birth  </span>
                                                <div class="text">
                                                    {{ $user->userDetail->date_of_birth }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif


                                {{--Occupation --}}
                                @if($user->userDetail->occupation != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">  Occupation </span>
                                                <div class="text">
                                                    {{ $user->userDetail->occupation }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{--Short Bio  --}}
                                @if($user->userDetail->short_bio != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Short Bio </span>
                                                <div class="text">
                                                    {{ $user->userDetail->short_bio }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{--looking_for_an_architect  --}}
                                @if($user->userDetail->looking_for_an_architect != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Looking for an architect </span>
                                                <div class="text">
                                                    {{ $user->userDetail->looking_for_an_architect }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif




                                {{--business_description --}}
                                @if($user->userDetail->business_description != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">  Business Description </span>
                                                <div class="text">
                                                    {{ $user->userDetail->business_description }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{--Business Description  --}}
                                @if($user->userDetail->bsiness_description != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Business Description  </span>
                                                <div class="text">
                                                    {{ $user->userDetail->bsiness_description }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{--Firm/Company --}}
                                @if($user->userDetail->types_of_firm_company != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Firm/Company   </span>
                                                <div class="text">
                                                    {{ $user->userDetail->types_of_firm_company }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{-- Firm/Company Name--}}
                                @if($user->userDetail->firm_or_company_name != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Firm/Company Name  </span>
                                                <div class="text">
                                                    {{ $user->userDetail->firm_or_company_name }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{-- Firm/Company Registration Number--}}
                                @if($user->userDetail->firm_or_company_registration_number != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Firm/Company Registration Number  </span>
                                                <div class="text">
                                                    {{ $user->userDetail->firm_or_company_registration_number }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{-- facebook link--}}
                                @if($user->userDetail->facebook_link != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Facebook Link  </span>
                                                <div class="text">
                                                    <a href="{{ $user->userDetail->facebook_link }}" target="_blank" style="color: #888da8;" >{{ $user->userDetail->facebook_link }}</a>


                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{-- Twitter Link--}}
                                @if($user->userDetail->twitter_link != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Twitter Link  </span>
                                                <div class="text">
                                                    <a href="{{ $user->userDetail->twitter_link }}" style="color: #888da8;" target="_blank">{{ $user->userDetail->twitter_link }}</a>

                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{-- Linkedin Link--}}
                                @if($user->userDetail->linkedin_link != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">   Linkedin Link  </span>
                                                <div class="text">
                                                    <a href="{{ $user->userDetail->linkedin_link }}" target="_blank" style="color: #888da8;">{{ $user->userDetail->linkedin_link }}</a>

                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                {{-- instagram_link--}}
                                @if($user->userDetail->instagram_link != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">    Instagram Link  </span>
                                                <div class="text">
                                                    <a href="{{ $user->userDetail->instagram_link }}" style="color: #888da8;" target="_blank">{{ $user->userDetail->instagram_link }}</a>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                {{--end basic detail--}}

                {{--work--}}
                @if(Auth::user()->user_type == 'work_architecture_firm_companies' OR Auth::user()->user_type == 'work_architecture_organizations' OR Auth::user()->user_type == 'work_architecture_college')
                <!-- Company Firm Details -->
                <div class="ui-block">
                    <div class="ui-block-title">
                        <h6 class="title">Company Firm Details</h6>
                    </div>
                    <div class="ui-block-content">
                        <div class="row">

                            {{--year in service--}}
                            @if($user->userDetail->year_in_service)
                            <div class="col-md-6">
                                <ul class="widget w-personal-info item-block">
                                    <li>
                                        <span class="title">Years in Service</span>
                                        <div class="text"> {{ $user->userDetail->year_in_service }}
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            @endif

                            {{--Firm Size --}}
                            @if($user->userDetail->firm_size)
                                <div class="col-md-6">
                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title">Firm Size </span>
                                            <div class="text"> {{ $user->userDetail->firm_size }}
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            @endif

                            {{-- Services Offered. – See Buildtrail --}}
                            @if($user->userDetail->services_offered)
                                <div class="col-md-6">
                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title"> Services Offered</span>
                                            <div class="text"> {{ $user->userDetail->services_offered }}
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            @endif

                            {{-- Asset Served--}}
                            @if($user->userDetail->asset_served)
                                <div class="col-md-6">
                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title"> Asset Served</span>
                                            <div class="text"> {{ $user->userDetail->asset_served }}
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            @endif

                            {{-- City Served --}}
                            @if($user->userDetail->city_served)
                                <div class="col-md-6">
                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title"> City Served </span>
                                            <div class="text"> {{ $user->userDetail->city_served }}
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            @endif

                            {{-- Award Name  --}}
                            @if($user->userDetail->award_name)
                                <div class="col-md-6">
                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title"> Award Name </span>
                                            <div class="text"> {{ $user->userDetail->award_name }}
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            @endif

                            {{-- Project Name    --}}
                            @if($user->userDetail->project_name)
                                <div class="col-md-6">
                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title"> Project Name  </span>
                                            <div class="text"> {{ $user->userDetail->project_name }}
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            @endif



                        </div>
                    </div>
                </div>
                <!-- End Company Firm Details -->
                @endif

                {{--Employee/Member Details--}}


                @if($user->employeeDetail->count())
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Employee/Member Details</h6>
                        </div>
                        <div class="ui-block-content">
                            <div class="row">

                                {{--full name--}}
                                @foreach($user->employeeDetail as $employee)
                                    {{--image--}}
                                    <div class="col-md-12">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <img class="author-thumb " src="@if($employee->profile != null) {{ asset($employee->profile) }} @else{{ asset('assets/images/avatar.png') }} @endif" alt="" style="width: 50px;">

                                            </li>

                                        </ul>
                                    </div>

                                    <div class="col-md-12">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">Full Name</span> - {{ $employee->fullName() }}

                                            </li>

                                        </ul>
                                    </div>

                                    <div class="col-md-12">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">Role </span> - {{ $employee->role }}

                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">Mobile Number </span> - {{ $employee->phone_number }}

                                            </li>

                                        </ul>
                                    </div>

                                    <div class="col-md-12">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">Aadhar Id </span> - {{ $employee->aadhar_id }}

                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">Email Address </span> - {{ $employee->email }}

                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title"> Country </span> - {{ $employee->country->name }}

                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">State  </span> - {{ $employee->state->name }}

                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">City  </span> - {{ $employee->city->name }}

                                            </li>

                                        </ul>
                                    </div>

                                    <hr width="100%"/>




                                @endforeach




                            </div>
                        </div>
                    </div>
                    <!-- End Company Firm Details -->

                @endif




                <!-- Education -->
                @if($user->usersEducationDetails->count())
                <div class="ui-block">
                    <div class="ui-block-title">
                        <h6 class="title">Education</h6>
                    </div>
                    <div class="ui-block-content">
                        <div class="row">

                                @foreach($user->usersEducationDetails as $educationDetail)
                            <div class="col-md-6">
                                <ul class="widget w-personal-info item-block">
                                    <li>
                                        <span class="title">{{ $educationDetail->college_university }}</span>
                                        <div class="text">
                                            <small>{{ $educationDetail->year_of_admission }} - {{ $educationDetail->year_of_graduation }}</small>
                                            <br> {{ $educationDetail->course }}
                                        </div>
                                    </li>
                                </ul>
                            </div>

                                @endforeach



                        </div>
                    </div>
                </div>
                @endif
                <!-- End Education -->


                {{--Professional Details--}}
                @if($user->usersProfessionalDetail->count())
                <div class="ui-block">
                    <div class="ui-block-title">
                        <h6 class="title">Professional Details</h6>
                    </div>
                    <div class="ui-block-content">

                        <div class="row">



                        @foreach($user->usersProfessionalDetail as $professionalDetail)
                                @if($user->userDetail->coa_registration != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title"> COA/Registration  </span> - {{ $user->userDetail->coa_registration }}

                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                @if($user->userDetail->years_since_service != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">  Years Since Service  </span> - {{ $user->userDetail->years_since_service }}

                                            </li>

                                        </ul>
                                    </div>
                                @endif

                            @if($professionalDetail->role != null)
                                     <div class="col-md-6">
                                <ul class="widget w-personal-info item-block">
                                    <li>
                                        <span class="title"> Role </span> - {{ $professionalDetail->role }}

                                    </li>

                                </ul>
                            </div>
                            @endif

                            @if($professionalDetail->company_firm_or_college_university != null)
                                    <div class="col-md-6">
                                          <ul class="widget w-personal-info item-block">
                                              <li>
                                                  <span class="title"> Company/Firm Or College/University </span> - {{ $professionalDetail->company_firm_or_college_university }}

                                              </li>

                                          </ul>
                                      </div>
                            @endif

                            @if($professionalDetail->start_date != null)
                                <div class="col-md-6">
                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title"> Start Date </span> - {{ $professionalDetail->start_date }}

                                        </li>

                                    </ul>
                                </div>
                            @endif

                                @if($professionalDetail->end_date_of_working_currently != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title"> End Date of Working Currently </span> - {{ $professionalDetail->end_date_of_working_currently }}

                                            </li>

                                        </ul>
                                    </div>
                                @endif

                                @if($professionalDetail->salary_stripend != null)
                                    <div class="col-md-6">
                                        <ul class="widget w-personal-info item-block">
                                            <li>
                                                <span class="title">Salary/Stripend</span> - {{ $professionalDetail->salary_stripend }}

                                            </li>

                                        </ul>
                                    </div>
                                @endif



                                <hr width="100%">
                         @endforeach



                        </div>
                    </div>
                </div>
                 @endif

                {{--Other Details--}}



                @if($user->usersDetail->count())
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Other Details</h6>
                        </div>
                        <div class="ui-block-content">

                            <div class="row">





                                @foreach($user->usersDetail as $userDetail)

                                    @if($userDetail->award != null)
                                        <div class="col-md-6">
                                            <ul class="widget w-personal-info item-block">
                                                <li>
                                                    <span class="title"> Awards </span> - {{ $userDetail->award }}

                                                </li>

                                            </ul>
                                        </div>
                                    @endif

                                    @if($userDetail->award_name != null)
                                        <div class="col-md-6">
                                            <ul class="widget w-personal-info item-block">
                                                <li>
                                                    <span class="title"> Award Name  </span> - {{ $userDetail->award_name }}

                                                </li>

                                            </ul>
                                        </div>
                                    @endif

                                    @if($userDetail->project_name != null)
                                        <div class="col-md-6">
                                            <ul class="widget w-personal-info item-block">
                                                <li>
                                                    <span class="title">  Project Name  </span> - {{ $userDetail->project_name }}

                                                </li>

                                            </ul>
                                        </div>
                                    @endif

                                    @if($userDetail->services_offered != null)
                                        <div class="col-md-6">
                                            <ul class="widget w-personal-info item-block">
                                                <li>
                                                    <span class="title">  Services Offered   </span> - {{ $userDetail->services_offered }}

                                                </li>

                                            </ul>
                                        </div>
                                    @endif

                                        <hr width="100%">




                                @endforeach



                            </div>
                        </div>
                    </div>
                @endif


            </div>
            <!-- End Main Content -->
        </div>
    </div>


    @endsection


