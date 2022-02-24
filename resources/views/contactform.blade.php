@extends('layout')

@section('main')
<div class="contact-section section-card">
    <div class="form">
        <form action="{{route('contactmsg')}}" autocomplete="off" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row form-container">
             <h4>Contact Us</h4>
             <div class="divider"></div>
                <div class="col s12 m6 inp-container">
                    <label class="inplbl">Name</label>
                    <input type="text" placeholder="Name" class="browser-default inpfield" name="name" required>
                 </div>
                    <div class="col s12 m6 inp-container">
                        <label class="inplbl">Account Type</label>
                        <select name="type" class="browser-default inpfield" required>
                            <option value="" disabled selected>Select Type</option>
                            <option value="Employer">Employer</option>
                            <option value="Candidate">Candidate</option>
                        </select>
                    </div>
                    
                    <div class="col s12 inp-container">
                        <div class="">
                            <label class="inplbl">Email </label>
                            <input type="email" placeholder="Email" name="email" id="email" class="salary-field inpfield browser-default" required>
                        </div>
                    </div>
                    <div class="col s12 inp-container">
                        <div class="">
                            <label class="inplbl">Contact No. <i>(optional)</i> </label>
                            <input type="text" placeholder="Phone No." name="phone" id="phone" class="salary-field inpfield browser-default">
                        </div>
                    </div>
                    <div class="col s12 inp-container">
                        <label class="inplbl">Message</label>
                        <textarea type="text" placeholder="Message" name="message" class="browser-default inpfield"required></textarea>
                     </div>
                     <div class="center col s12">
                        <button class="btn-large waves-effect waves-light theme" style="border-radius: 30px;  margin-top:20px; margin-bottom: 20px;">Send</button>
                     </div>
                     <div class="center center-align">
                        <span class="green-text center-align" style="font-size: 20px;">{{session('error')}}</span>
                     </div>
             </div>
             
        </form>
         {{-- <div class="confirmation-page" id="confirmation-page">
             <i class="material-icons">offline_pin</i>
             <h1>Thank You for Submitting!</h1>
             <p>Thank you for submitting, your job has been published. If you need help please contact us via email admin@internwheel.com</p>
             <div class="cnf-links">
                 <a href="job-manager.html">Manage Jobs</a>
                 <a href="#">View Job</a>
             </div>
         </div> --}}
    </div>
</div>
@endsection