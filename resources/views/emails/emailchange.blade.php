@component('mail::message')

<h2>Welcome {{$data['name']}}</h2> <br>
<h3>You have changed your email please verify the new email</h3><br>

@component('mail::button', ['url' => url('emailchange/'.$data['verifylink'].'/'.$data['randomid'])])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent