@component('mail::message')
Dear {{$content['name']}},
<p>
    <b>{{$content['subject']}}</b>
</p>
<p>
    {!!$content['description']!!}
</p>

Best of luck!<br>
SqrFactor Competitions
@endcomponent
