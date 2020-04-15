@component('mail::message')
### Hello {{$user->first_name}},

Welcome onboard.

@component('mail::button', ['url' => env('APP_URL')])
Visit {{config('app.name')}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
