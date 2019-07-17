@component('mail::message')
# {{ $title }}

{{$message}}

@component('mail::button', ['url' => $link, 'color' => 'success'])
{{$eventName}}
@endcomponent

Cordialement,<br>
<img src="{{URL::asset('/img/logo.png')}}" alt="événements!">
@endcomponent
