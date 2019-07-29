<!-- the template mail that is used to send mail to participants -->

@component('mail::message')
# {{ $title }}

{{$message}}

@component('mail::button', ['url' => $link, 'color' => 'success'])
{{$eventName}}
@endcomponent

Cordialement,<br>
<img src="{{URL::asset('/img/logo.png')}}" alt="événements!">
@endcomponent
