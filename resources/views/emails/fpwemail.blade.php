@component('mail::message')

<h2>Hi {{$data['name']}}!</h2> <br>
<h3>We recieved a request to reset your Internwheel password</h3><br>
<br>
<p>
Enter the following code to reset your password: {{$data['randomid']}}</p><br>

Regards,<br>
{{ config('app.name') }}
@endcomponent