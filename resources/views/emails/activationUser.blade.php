@component('mail::message')


{{ $content['title'] }}

{{ $content['body'] }}

@component('mail::button', ['url' => URL::to("/").'/activate/token/'.$content['url_link'].''])
    Verify email
@endcomponent

Best,<br>
{{ config('app.name') }} Support

@endcomponent
