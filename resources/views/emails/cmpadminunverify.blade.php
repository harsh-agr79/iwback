@component('mail::message')

<h2>Greetings {{$data['name']}}</h2> <br>
<br>
<p>
Due to your violation of our terms and conditions your account verification has been revoked</p><br>
<p>Ask for help at contact@internwheel.com for further queries</p><br>


{{-- @component('mail::button', ['url' => url('/')])
Go To Internwheel
@endcomponent --}}

Regards,<br>
{{ config('app.name') }}
@endcomponent