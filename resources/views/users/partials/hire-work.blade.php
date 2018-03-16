

@if(Auth::check())

    {{--update field when login by facebook--}}
    @if(Auth::user()->type == null OR Auth::user()->user_type == null OR Auth::user()->email == null OR Auth::user()->mobile_number == null  )
        @include('users.partials.yoyo')
    @else



    {{--update field when login by facebook--}}

    @if(Auth::user()->type == 'hire')


        @if(Auth::user()->user_type == 'hire_individual')
            @include('users.hire.hire-individual-basic-detail',['countries' => $countries])
        @endif


        @if(Auth::user()->user_type == 'hire_organization' || Auth::user()->user_type == 'real_estate_firm_companies')

            @include('users.hire.hire-organization-basic-detail')

        @endif
    @endif


  {{--  {{ dd(Auth::user()->type) }}--}}

    @if(Auth::user()->type == 'work')

        @if(Auth::user()->user_type == 'work_individual')

            @include('users.work.work-individual-basic-detail')
        @endif


        @if(Auth::user()->user_type == 'work_architecture_firm_companies' 
            OR 
        Auth::user()->user_type == 'work_architecture_organizations' 
            OR 
        Auth::user()->user_type == 'work_architecture_college')
            @include('users.work.work-architecture-basic-detail')
        @endif
    @endif
        @endif


@endif