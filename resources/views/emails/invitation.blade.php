@component('mail::message')
{{ $content['title'] }}

{{ $content['title2'] }}

{{ $content['body'] }}

@component('mail::button', ['url' => URL::to("/").$content['button_url']])
    {{ $content['button'] }}
@endcomponent

{{ $content['link'] }}

Best,<br>
Team {{ config('app.name') }}

@endcomponent
