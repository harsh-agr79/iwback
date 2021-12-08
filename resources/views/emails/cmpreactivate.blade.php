@component('mail::message')

<h2>Greetings {{$data['name']}}</h2> <br>
<h3>Glad to have you back! :)</h3><br>
<br>
<h3>Continue to reactivate your account here</h3>

@component('mail::button', ['url' => url('cmpreactivate/'.$data['reactivatelink'].'/'.$data['randomid'])])
reactivate
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent