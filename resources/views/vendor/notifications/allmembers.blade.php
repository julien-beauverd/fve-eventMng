@component('mail::message')
# {{ $title }}

{{$message}}
    
@component('mail::button', ['url' => $link, 'color' => 'success'])
Voir les prochains événements
@endcomponent

Cordialement,<br>
<img src="{{URL::asset('/img/logo.png')}}" alt="événements!">
@endcomponent
