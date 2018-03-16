@if(Auth::check())
    @if(Auth::user()->user_type == 'work_individual')
        @if(Auth::user()->first_name == null || Auth::user()->last_name == null || Auth::user()->userDetail->country_id == null || Auth::user()->userDetail->state_id == null || Auth::user()->userDetail->city_id == null || Auth::user()->userDetail->gender == null || Auth::user()->mobile_number == null)
            <h4 style="text-align: center;color: #515365;margin-bottom: 32px;" class="data_message_alert"
                data-message-alert="true" data-user_type="{{ Auth::user()->user_type }}">Your profile is incomplete.
                Please fill your profile details <a href="{{ asset('profile/edit?simple=true') }}">Click here</a></h4>
        @endif
    @endif
    @if(Auth::user()->user_type == 'work_architecture_firm_companies'|| Auth::user()->user_type == 'work_architecture_organizations' || Auth::user()->user_type == 'work_architecture_college')
        @if(Auth::user()->name == null  || Auth::user()->userDetail->country_id == null || Auth::user()->userDetail->state_id == null || Auth::user()->userDetail->city_id == null  || Auth::user()->mobile_number == null)
            <h4 style="text-align: center;color: #515365;margin-bottom: 32px;" class="data_message_alert"
                data-message-alert="true" data-user_type="{{ Auth::user()->user_type }}">Your profile is incomplete.
                Please fill your profile details <a href="{{ asset('profile/edit') }}">Click here</a></h4>

        @endif
    @endif
@endif