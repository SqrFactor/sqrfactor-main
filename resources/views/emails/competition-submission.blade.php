@component('mail::message')
<body>
    <p>Dear {{$content['name']}},</p>
    <p>
        Your submission was successful. Thank you for submitting your design for <b>{{$content['competition_title']}}</b>
    </p>
    <p>
        If you have any queries, please mail us at <a href="mailto:create@sqrfactor.com">create@sqrfactor.com</a> or <a
                href="mailto:competitions@sqrfactor.com">competitions@sqrfactor.com</a> with subject as Competition name.
    </p>

    <p>Best of luck!<br>
    SqrFactor Competitions</p>
</body>
@endcomponent










