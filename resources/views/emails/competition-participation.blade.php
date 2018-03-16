@component('mail::message')
Dear {{$content['name']}},
<p>
    You have successfully registered for the competition. Thank you for participating in <b>{{$content['competition_title']}}</b> organized by <b>{{$content['competition_organizer']}}</b>. Your competition code is <b>{{$content['competition_code']}}</b>. Please use your competition code when submitting the designs.
</p>
<p>
    If you have any queries, please mail us at <a href="mailto:create@sqrfactor.com">create@sqrfactor.com</a> or <a
            href="mailto:competitions@sqrfactor.com">competitions@sqrfactor.com</a> with subject as Competition name.
</p>

Best of luck!<br>
SqrFactor Competitions
@endcomponent
