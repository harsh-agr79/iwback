@component('mail::message')

<h2>Greetings {{$data['name']}}</h2> <br>
<h3>You have been verified!</h3><br>
<br>
<p>
Your PAN number and certificate have been verified, You will now be able to post new jobs/internships and talk to candidates via messages</p><br>
<p>Welcome To Internwheel</p><br>
<h3>Happy Recruiting!</h3>


@component('mail::button', ['url' => url('/')])
Go To Internwheel
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent