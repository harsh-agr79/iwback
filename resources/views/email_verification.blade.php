@component('mail::message')
Welcome {{$name}}<br>
@component('mail::panel')
Please Verify Your email
@endcomponent
@component('mail::button', ['url' => url('/verification/'.$verifylink)])
Verify Account
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent