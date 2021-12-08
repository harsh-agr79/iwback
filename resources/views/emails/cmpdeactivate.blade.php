@component('mail::message')

<h2>Greetings {{$data['name']}}</h2> <br>
<h3>Please continue by clicking the following button to deactivate your Account</h3><br>
<br>
<pre>Dear {{$data['name']}},
You can continue to deactivate your account and you can only reactivate your account until after 30 DAYS of deactivation and your account will be completely removed after 30 days of your deactivation

We request you to proceed with caution</pre>

@component('mail::button', ['url' => url('cmpdeactivate/'.$data['deactivatelink'].'/'.$data['randomid'])])
Deactivate
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent