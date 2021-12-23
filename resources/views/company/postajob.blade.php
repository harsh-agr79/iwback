@extends('company/layoutcmpy')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main')
@if($company['0']->adminverification == 'verified')
<div class="main-content">
    <section class="left-section">
        <div class="section-card">
            <form id="postjobform" autocomplete="off">
                @csrf
               <div class="row form-container">
                <h4>Post a new job</h4>
                <div class="divider"></div>
                   <div class="col s12 inp-container">
                       <label class="inplbl">Job title</label>
                       <input type="text" placeholder="Job title" class="browser-default inpfield" name="title">
                    </div>
                    <div class="col s12 inp-container">
                        <label class="inplbl">Job Description</label>
                        <textarea type="text" placeholder="Job Description" name="aboutjob" class="browser-default inpfield" name="title"></textarea>
                     </div>
                     <div class="col s12 m6 inp-container">
                        <label class="inplbl">Application Deadline</label>
                        <input type="date" class="browser-default inpfield" id="application-deadline" name="deadline">
                     </div>
                     <div class="col s12 m6 inp-container">
                        <label class="inplbl">Sector</label>
                        <select name="sector" class="browser-default inpfield">
                            <option value="" disabled selected>Select Sector</option>
                            @foreach ($sector as $item)
                                <option value="{{$item->sector}}">{{$item->sector}}</option>
                            @endforeach
                          </select>
                     </div>
                     <div class="col s12 inp-container">
                        <label class="inplbl">Job Type</label>
                        <select name="type" class="browser-default inpfield">
                            <option value="" disabled selected>Select Job Type</option>
                            <option value="Fresher">Fresher</option>
                            <option value="Internship">Internship</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Full Time">Full Time</option>
                          </select>
                     </div>
                     <div class="col s12 m6 inp-container">
                        <label class="inplbl">Orientation</label>
                        <select name="orientation" class="browser-default inpfield">
                            <option value="" disabled selected>Work in Home/Office</option>
                            <option value="Work Form Home">Work Form Home</option>
                            <option value="Work On Site">Work On Site</option>
                          </select>
                     </div>
                     <div class="col s12 inp-container" style="margin-top: 10px;">
                        <label class="check">
                            <input name="work-based-stipend" type="checkbox" name="work-based-stipend" id="wbs" />
                            <span class="inplbl">Work Based Salary</span>
                        </label>
                     </div>
                     
                     <div class="col s12 inp-container">
                        <div class="" id="salary-div">
                            <label class="inplbl">Salary </label>
                            <input type="number" placeholder="Salary" name="salary" id="salaryfld" class="salary-field inpfield browser-default" required/>
                        </div>
                     </div>
                     <style>
                         span.field-icon {
                             float: right;
                             position: absolute;
                             right: 10px;
                             top: 8px;
                             cursor: pointer;
                             z-index: 2;
                             }
                     </style>

                     <div class="col s12">
                        <label class="inplbl">Skills</label>
                         <div class="row">
                            <div class='input-field hide col s12 m3' id="skillinp">
                                <input class='validate browser-default inpfield autocomplete skills' type='text' placeholder="Skill" name='skill[]'/>
                                <span class="field-icon toggle-password" onclick="this.parentNode.remove()"><span class="material-icons">clear</span></span>
                            </div>
                             
                             <div id="skillsrow">
                                 <div class='input-field col s12 m3'>
                                    <input class='validate browser-default inpfield autocomplete skills' type='text' placeholder="Skill"  name='skill[]'/>
                                    {{-- <span class="field-icon toggle-password" ><span class="material-icons">clear</span></span> --}}
                                </div>
                             </div>
                            
                             <div class="col s12 m2 center" style="margin-top:15px;">
                                <div class="center">
                                    <span class="btn theme" id="addskill" style="border-radius:10px;">Add Skill</span>
                                </div>
                             </div>
                         </div>
                         
                        
                     </div>

                     <div class="col s12">
                        <h4>Other Information</h4>
                        <div class="divider"></div>
                     </div> 
                     <div class="col s12 inp-container">
                        <label class="inplbl">Job Requirements</label>
                        <textarea type="text" placeholder="Job Requirements" class="browser-default inpfield" name="jobrequirements"></textarea>
                     </div>
                     <div class="col s12 inp-container">
                        <label class="inplbl">No. Of Openings</label>
                        <input type="text" placeholder="Number Of Openings" class="browser-default inpfield" name="openings">
                     </div>
                     <div class="col s12 m6 inp-container">
                        <label class="inplbl">Experience</label>
                        <select name="experience" class="browser-default inpfield">
                            <option value="" disabled selected>Select Experience Level</option>
                            <option value="Fresher">Fresher</option>
                            <option value="1year">1 Year</option>
                            <option value="2years">2 Years</option>
                            <option value="3years">3 Years</option>
                            <option value="4years">4 Years</option>
                            <option value="4+years">4+ Years</option>
                          </select>
                     </div>
                     <div class="col s12 m6 inp-container">
                        <label class="inplbl">Branch</label>
                        <select name="branches" class="browser-default inpfield">
                            <option value="" disabled selected>Select Branch Of the job</option>
                            <option value="Bagbazaar, Kathmandu">Bagbazaar, Kathmandu</option>
                            <option value="Balkumari, Lalitpur">Balkumari, Lalitpur</option>
                            <option value="Buddhanagar, Kathmandu">Buddhanagar, Kathmandu</option>
                          </select>
                     </div>
                     {{-- <div class="col s12 m6 inp-container">
                        <label class="inplbl">Perks(Optional) </label>
                        <input type="text" name="perks" class="browser-default inpfield" id="qualification2" placeholder="please seperate each perk with a comma(,)" required>
                    </div>  --}}

                    <div class="col s12">
                        <label class="inplbl">Perks</label>
                         <div class="row">
                            
                             <div class='input-field hide col s12 m3' id="perkinp">
                                <input class='validate browser-default inpfield' type='text' placeholder="Perks" name='perk[]'/>
                                <span class="field-icon toggle-password" onclick="this.parentNode.remove()"><span class="material-icons">clear</span></span>
                            </div>
                             <div id="perksrow">
                                 <div class='input-field col s12 m3'>
                                    <input class='validate browser-default inpfield' type='text' placeholder="Perks"  name='perk[]'/>
                                    {{-- <span class="field-icon toggle-password" ><span class="material-icons">clear</span></span> --}}
                                </div>
                             </div>
                             <div class="col s12 m2 center" style="margin-top:15px;">
                                <div class="center">
                                    <span class="btn theme" id="addperk" style="border-radius:10px;">Add Perk</span>
                                </div>
                             </div>
                         </div>
                         
                        
                     </div>
                     <div class="col s12 inp-container">
                        <label class="inplbl">Work Duration(Optional)</label>
                        <input type="text" placeholder="Work Duration" class="browser-default inpfield" name="duration">
                     </div>
                      <input type="hidden" name="cmpyname" value="{{$user['0']->cmpyname}}">
                      <input type="hidden" name="cmpyemail" value="{{$user['0']->email}}">
                      <input type="hidden" name="cmpyusername" value="{{$user['0']->username}}">
                      <input type="hidden" name="cmpyabout" value="{{$user['0']->about}}">
                      <input type="hidden" name="webiste" value="{{$user['0']->website}}">
                      <input type="hidden" name="cmpyid" value="{{$user['0']->id}}">
                      <input type="hidden" name="cmpyimg" value="{{$user['0']->cmpydp}}">
                      <div class="col s12 center">
                          <button class="btn-large theme waves-effect">Post <i class="material-icons right">send</i></button>
                      </div>
                </div>
                
           </form>
            <div class="confirmation-page" id="confirmation-page" style="display: none;">
                <i class="material-icons">offline_pin</i>
                <h1>Your Job has been Posted!</h1>
                <p>Your job has been published. If you need help please contact us via email contact@internwheel.com</p>
                <div class="cnf-links">
                    <a href="{{url('company/jobsmanager')}}">Manage Jobs</a>
                </div>
            </div>
        </div>
    </section>
    <section class="profile-sidebar">
        <div class="job-poster section-card">
            @if($user[0]->adminverification === 'verified')
            <a href="{{url('company/postajob')}}">
                <h5>Post a job</h5>
                <i class="material-icons">add_circle</i>
            </a>
            @else
            <a href="#" class="tooltipped" data-position="bottom" data-tooltip="You cannot post a job yet">
                <h5 class="grey-text">Post a job</h5>
                <i class="material-icons grey-text">add_circle</i>
            </a>
            @endif
        </div>
        <div class="dashboard-tabs section-card">
            <a class="tab-menu" href="{{url('company/profile')}}">
                <i class="material-icons">account_circle</i>
                <p class="menu-text">Company Profile</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{url('company/jobsmanager')}}">
                <i class="material-icons">business_center</i>
                <p class="menu-text">Jobs Posted</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{url('company/savedcandidates')}}">
                <i class="material-icons">groups</i>
                <p class="menu-text">Saved Candidates</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{url('company/settings')}}">
                <i class="material-icons">settings</i>
                <p class="menu-text">Account Settings</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{url('company/logout')}}">
                <i class="material-icons">logout</i>
                <p class="menu-text">Log Out</p>
            </a>
        </div>
    </section>
</div>
@else
<div style="height: 30vh">

</div>
<div class="center">
    <div>
        <h3>Your PAN number has not yet been verified, You cannot post a job yet <br></h3>
        <h4>for more queries contact Internwheel Management at <span class="blue-text">contact@internwheel.com</span></h4>
    </div>
</div>
<div style="height: 40vh">

</div>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
       $(document).ready(function(){
           skillget()
               function skillget(){
                $.ajax({
              type:'get',
              url:'{!!URL::to('findskill')!!}',
              success:function(response){

                // console.log(response)
                var custarray = response;
                var datacust = {};
                for(var i=0; i< custarray.length; i++){

                  datacust[custarray[i].skill] =null;
                }
                console.log(datacust)
                $('input.skills').autocomplete({
                  data: datacust,
                });
              }
            })
           }
           $('#addskill').click(function(){
            var sinp = $('#skillinp').clone()
                var sinp2 = sinp.removeClass('hide')
                sinp2.appendTo("#skillsrow")
                skillget()
           })  
           $('#addperk').click(function(){
            var sinp = $('#perkinp').clone()
                var sinp2 = sinp.removeClass('hide')
                sinp2.appendTo("#perksrow")
           })  
           $('#postjobform').submit(function(e){
                 e.preventDefault();
                 let formData = new FormData($('#postjobform')[0]);
                 $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"{{url('addjob')}}",
                    data:formData,
                    contentType: false,
                    processData: false,
                    type:'POST',
                    success:function(response){
                        $('#postjobform')['0'].reset();
                        $('#postjobform').toggle();
                        $('#confirmation-page').toggle();
                        M.toast({html: 'Job Posted!'})
                    }
                 })
            });

        })
        var salaryDiv = document.querySelector('#salary-div')

$('#wbs').change(() => {
    if($('#salaryfld').attr('required')){
        $('#salaryfld').removeAttr('required')
        salaryDiv.classList.add('hide')
    }
    else{
        $('#salaryfld').attr('required','required')
        salaryDiv.classList.remove('hide')
    }
})

    

 

</script>
@endsection