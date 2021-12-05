@component('mail::message')

<h2>Welcome {{$data['name']}}</h2> <br>
<h3>Click on the button to continue with verification</h3> <br>

@component('mail::button', ['url' => url('verification/'.$data['verifylink'])])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
