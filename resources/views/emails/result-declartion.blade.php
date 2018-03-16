@component('mail::message')

<body>
	<p>Dear {{$content['name']}},</p><br>
	<p>Results for the competitions have been announced. Please check the results tab of <b>{{$content['competition_title']}}</b></p>
	@component('mail::button', ['url' => 'https://www.sqrfactor.com/competition/'.$content["slug"].'/results'])
	View Results
	@endcomponent
	<p>Thank you so much again for participating in {{$content['competition_title']}}.</p> 

	<p>Best, 
	SqrFactor Competitions</p>

</body>
@endcomponent



