@component('mail::message')

<h2>Welcome {{$data['name']}}</h2> <br>
<h3>We are glad to have you here at Internwheel</h3> <br>
<h3>Please continue to verify</h3> <br>

@component('mail::button', ['url' => url('verification/'.$data['verifylink'])])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
