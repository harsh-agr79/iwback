@extends('employee/layoutcand')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main')
<div class="main-content">
    <section class="profile-dashboard">
        <div class="profile-info section-card">
            <div class="img-container">
                <div class="cover-pic">
                    <span class="cover-edit-btn">
                        <i class="material-icons">mode_edit</i>
                    </span>
                </div>
                <div class="avatar">
                    <div class="avatar-pic">
                        <img class="avatar-img" src="{{asset('assets/images/icon.png')}}">
                        <div class="avatar-title">
                            <h4>{{$cand->firstname}} {{$cand->lastname}}</h4>
                            <p class="location" id="titletxt"></p>
                            <form method="POST" enctype="multipart/form-data" id="taform">
                            <p id="titleinp" style="display: none;">
                                <label class="inplbl">Title</label>
                                <input type="hidden" name="id" value="{{$cand->id}}">
                                <input type="text" class="inpfield browser-default" id="titleval" name="title" placeholder="title">
                            </p>
                        </div>
                    </div>
                    <span class="avatar-edit-btn" id="taedit">
                        <i class="material-icons" id="taeditico">mode_edit</i>                            
                        <i class="material-icons" style="display: none;" onclick="tasubmit()" id="tasaveico">save</i>                            
                    </span>
                </div>
                <div class="about-user">
                    <h4>About Me</h4>
<pre id="abouttxt"></pre>
<textarea name="about" style="display: none;" id="aboutinp" class="browser-default inpfield" placeholder="About"></textarea>
</form>
                </div>
            </div>
        </div>

        <div class="user-dashboard-section section-card">
            <h1>Your Dashboard</h1>
            <div class="article-count section-card">
                <div class="article-col col-1">
                    <span>2</span>
                    <a href="#jobs-posted">Jobs Applied</a>
                </div>
                <div class="article-col col-2">
                    <span>0</span>
                    <a href="#hired-info">Applications Accepted</a>
                </div>
                <div class="article-col col-3">
                    <span>1</span>
                    <a href="#active-jobs">Active Applications</a>
                </div>
            </div>
        </div>

        <div class="overview-section skill-section section-card">
            <h3>
                Skills
                <div id="editskill">
                    <i class="material-icons" id="skilled">edit</i>
                    <i class="material-icons" style="display: none;" onclick="skillsubmit()" id="skillsv">save</i>
                </div>
            </h3>
            <form action="{{route('candskill')}}" method="post" id="skillform" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$cand->id}}">
            <ul class="skill-list" id="skills-list">
                <li id="addskilltab" class="hide">
                    <div class="row">
                        <div class="col s11">
                            <input type="text" name="skill[]" id="skills" style="margin-top: 5px;" class="browser-default inpfield">
                            <label class="inplbl">Skill Level</label>
                            <select name="sl[]" class="browser-default inpfield">
                                <option value="" selected>Select Skill Level</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Competent">Competent</option>
                                <option value="Expert">Expert</option>
                              </select>
                        </div>
                        <div class="col s1">
                            <i class="material-icons red white-text z-depth-1" style="padding:5px;" onclick="this.parentNode.parentNode.parentNode.remove()">delete</i>
                        </div>
                    </div>
                </li>
                @php
                    $skills = explode('|',$cand->skills);
                    $skillslevel = explode('|',$cand->skillslevel);
                @endphp
                    @if (!empty($skills))
                        @for ($i = 0; $i < count($skills); $i++)
                            @if ($skills[$i] == NULL)

                            @else
                                <li> <div class="skilltxt"> {{$skills[$i]}} <span class="grey-text" style="font-size: 13px;">{{$skillslevel[$i]}}</span></div>
                                    <div class="skillinp row" style="display: none;">
                                        <div class="col s11">
                                            <input type="text" name="skill[]" id="skills" style="margin-top: 5px;" value="{{$skills[$i]}}" class="browser-default inpfield">
                                            <label class="inplbl">Skill Level</label>
                                            <select name="sl[]" class="browser-default inpfield">
                                                <option value="{{$skillslevel[$i]}}" selected>{{$skillslevel[$i]}} </option>
                                                <option value="Beginner">Beginner</option>
                                                <option value="Intermediate">Intermediate</option>
                                                <option value="Competent">Competent</option>
                                                <option value="Expert">Expert</option>
                                              </select>
                                        </div>
                                        <div class="col s1">
                                            <i class="material-icons red white-text z-depth-1" style="padding:5px;" onclick="this.parentNode.parentNode.parentNode.remove()">delete</i>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endfor
                    @endif  
            </ul>
        </form>
            <span class="view_more skillinp" style="display: none;" onclick="addskill()">Add skill</span>
        </div>

        <div class="exp-section section-card">
            <h3>
                Education
                <div id="editeducation">
                    <i class="material-icons" id="editedu">edit</i>
                    <i class="material-icons" style="display: none;" onclick="edusubmit()" id="saveedu">save</i>
                </div>
                
            </h3>
            <form action="{{route('candedu')}}" enctype="multipart/form-data" method="POST" id="eduform">
                @csrf
                <input type="hidden" name="id" value="{{$cand->id}}">
            <div class="exp-grid-section" id="edu-list">
                <div class="exp-item"  id="eduaddtab" style="display: none;">
                        {{-- <img class="edutxt ins-icon" src="{{asset('assets/pngs/education-hat.png')}}">
                        <div class="edutxt ins-info">
                            <h5>NCIT College</h5>
                            <p>Bachelors of Software Engineering</p>
                            <span>Apr 2019 - Present</span>
                        </div>  --}}
                        <div>
                            <div class="row">
                                <div class="col s11">
                                    <input type="text" name="insname[]" placeholder="Institute Name" class="browser-default inpfield"  id="">   
                                    <input style="margin-top:5px;" type="text" name="inscourse[]" placeholder="Course/Degree Name" class="browser-default inpfield"  id="">
                                    <div class="row">
                                            <div class="col s3">
                                                <label class="inplbl">From month</label>
                                                <select name="frommonth[]" class="browser-default inpfield">
                                                    <option value="" selected>Select Month</option>
                                                    <option value="Jan">Jan</option>
                                                    <option value="Feb">Feb</option>
                                                    <option value="Mar">Mar</option>
                                                    <option value="Apr">Apr</option>
                                                    <option value="May">May</option>
                                                    <option value="Jun">Jun</option>
                                                    <option value="Jul">Jul</option>
                                                    <option value="Aug">Aug</option>
                                                    <option value="Sept">Sept</option>
                                                    <option value="Oct">Oct</option>
                                                    <option value="Nov">Nov</option>
                                                    <option value="Dec">Dec</option>
                                                </select>
                                            </div>
                                            <div class="col s3">
                                                <label class="inplbl">From year</label>
                                                    <select name="fromyear[]" class="browser-default inpfield">
                                                        <option value="" selected>Select Year</option>
                                                        @for ($i = date('Y'); $i >= 1980; $i--)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                            </div>
                                            <div class="col s3">
                                                <label class="inplbl">To month</label>
                                                    <select name="tomonth[]" class="browser-default inpfield">
                                                        <option value="" selected>Select Month</option>
                                                        <option value="present">Present</option>
                                                        <option value="Jan">Jan</option>
                                                        <option value="Feb">Feb</option>
                                                        <option value="Mar">Mar</option>
                                                        <option value="Apr">Apr</option>
                                                        <option value="May">May</option>
                                                        <option value="Jun">Jun</option>
                                                        <option value="Jul">Jul</option>
                                                        <option value="Aug">Aug</option>
                                                        <option value="Sept">Sept</option>
                                                        <option value="Oct">Oct</option>
                                                        <option value="Nov">Nov</option>
                                                        <option value="Dec">Dec</option>
                                                    </select>
                                            </div>
                                            <div class="col s3">
                                                <label class="inplbl">To year</label>
                                                    <select name="toyear[]" class="browser-default inpfield">
                                                        <option value="" selected>Select Year</option>
                                                        @for ($i = date('Y'); $i >= 1980; $i--)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                            </div>
                                    </div>   
                                </div>
                                <div class="col s1">
                                    <i class="material-icons red white-text z-depth-1" style="padding:2px;" onclick="this.parentNode.parentNode.parentNode.parentNode.remove()">delete</i>
                                </div>
                            </div>
                           
                        </div> 

                </div>
                @php
                    $insname = explode('|',$cand->eduorganization);
                    $inscourse = explode('|',$cand->educourse);
                    $frommonth = explode('|',$cand->edutimefrommonth);
                    $fromyear = explode('|',$cand->edutimefromyear);
                    $tomonth = explode('|',$cand->edutimetomonth);
                    $toyear = explode('|',$cand->edutimetoyear);
                    $y = date('Y');
                @endphp  
                @for ($i = 0; $i < count($insname); $i++)
                @if ($insname[$i] == NULL)
                @else
                <div class="exp-item">
                    <img class="edutxt ins-icon" src="{{asset('assets/pngs/education-hat.png')}}">
                    <div class="edutxt ins-info">
                        <h5>{{$insname[$i]}}</h5>
                        <p>{{$inscourse[$i]}}</p>
                        <span>{{$frommonth[$i]}} {{$fromyear[$i]}} - @if($tomonth[$i] == 'Present'){{$tomonth[$i]}} @else{{$tomonth[$i]}} {{$toyear[$i]}} @endif</span>
                    </div> 
                    <div class="eduinp" style="display: none;">
                        <div class="row">
                            <div class="col s11">
                                <input type="text" name="insname[]" value="{{$insname[$i]}}" placeholder="Institute Name" class="browser-default inpfield"  id="">   
                                <input style="margin-top:5px;" type="text" value="{{$inscourse[$i]}}" name="inscourse[]" placeholder="Course/Degree Name" class="browser-default inpfield"  id="">
                                <div class="row">
                                        <div class="col s3">
                                            <label class="inplbl">From month</label>
                                            <select name="frommonth[]" class="browser-default inpfield">
                                                <option value="{{$frommonth[$i]}}" selected>{{$frommonth[$i]}}</option>
                                                <option value="Jan">Jan</option>
                                                <option value="Feb">Feb</option>
                                                <option value="Mar">Mar</option>
                                                <option value="Apr">Apr</option>
                                                <option value="May">May</option>
                                                <option value="Jun">Jun</option>
                                                <option value="Jul">Jul</option>
                                                <option value="Aug">Aug</option>
                                                <option value="Sept">Sept</option>
                                                <option value="Oct">Oct</option>
                                                <option value="Nov">Nov</option>
                                                <option value="Dec">Dec</option>
                                            </select>
                                        </div>
                                        <div class="col s3">
                                            <label class="inplbl">From year</label>
                                                <select name="fromyear[]" class="browser-default inpfield">
                                                    <option value="{{$fromyear[$i]}}" selected>{{$fromyear[$i]}}</option>
                                                    @while ($y >= 1980)
                                                        <option value="{{$y}}">{{$y}}</option>
                                                        {{$y--}}
                                                    @endwhile
                                                    {{$y = date('Y')}}
                                                </select>
                                        </div>
                                        <div class="col s3">
                                            <label class="inplbl">To month</label>
                                                <select name="tomonth[]" class="browser-default inpfield">
                                                    <option value="{{$tomonth[$i]}}" selected>{{$tomonth[$i]}}</option>
                                                    <option value="Present">Present</option>
                                                    <option value="Jan">Jan</option>
                                                    <option value="Feb">Feb</option>
                                                    <option value="Mar">Mar</option>
                                                    <option value="Apr">Apr</option>
                                                    <option value="May">May</option>
                                                    <option value="Jun">Jun</option>
                                                    <option value="Jul">Jul</option>
                                                    <option value="Aug">Aug</option>
                                                    <option value="Sept">Sept</option>
                                                    <option value="Oct">Oct</option>
                                                    <option value="Nov">Nov</option>
                                                    <option value="Dec">Dec</option>
                                                </select>
                                        </div>
                                        <div class="col s3">
                                            <label class="inplbl">To year</label>
                                                <select name="toyear[]" class="browser-default inpfield">
                                                    <option value="{{$toyear[$i]}}" selected>{{$toyear[$i]}}</option>
                                                    @while ($y >= 1980)
                                                        <option value="{{$y}}">{{$y}}</option>
                                                        {{$y--}}
                                                    @endwhile
                                                </select>
                                        </div>
                                </div>   
                            </div>
                            <div class="col s1">
                                <i class="material-icons red white-text z-depth-1" style="padding:2px;" onclick="this.parentNode.parentNode.parentNode.parentNode.remove()">delete</i>
                            </div>
                        </div>
                    </div> 
                </div>
                @endif
                
                @endfor
            </div>
            <span class="view_more eduinp" style="display: none;" onclick="addeducation()">Add Education</span>
        </div>
    </form>

        <div class="exp-section section-card">
            <h3>
                Experience
                <i class="material-icons">edit</i>
            </h3>
            <div class="exp-grid-section">
                <div class="exp-item">
                    <img class="ins-icon" src="{{asset('assets/pngs/experience.png')}}">
                    <div class="ins-info">
                        <h5>Horizonlair</h5>
                        <p>Full Stack Developer</p>
                        <span>Apr 2019 - Present</span>
                    </div>
                </div>
                <div class="exp-item">
                    <img class="ins-icon" src="{{asset('assets/pngs/experience.png')}}">
                    <div class="ins-info">
                        <h5>My Power</h5>
                        <p>Backend Developer</p>
                        <span>Mar 2017</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="extra-info contact-info section-card">
            <h1>
                Contact Info
                <i class="material-icons">edit</i>
            </h1>
            <div class="contact-item exp-item">
                <i class="material-icons">account_circle</i>
                <div class="ins-info">
                    <h5>Your Profile</h5>
                    <a href="#">https://www.internwheel.com/account/harsh-agarwal-we72edwa2</a>
                </div>
            </div>
            <div class="contact-item exp-item">
                <i class="material-icons">article</i>
                <div class="ins-info">
                    <h5>Portfolio</h5>
                    <a href="#">https://www.internwheel.com/</a>
                </div>
            </div>
            <div class="contact-item exp-item">
                <i class="material-icons">place</i>
                <div class="ins-info">
                    <h5>Address</h5>
                    <p>New Road, Kathmandu, Province 3, Nepal</p>
                </div>
            </div>
            <div class="contact-item exp-item">
                <i class="material-icons">email</i>
                <div class="ins-info">
                    <h5>Email</h5>
                    <p>agrharsh@iwhel.com</p>
                </div>
            </div>
            <div class="contact-item exp-item">
                <i class="material-icons">phone</i>
                <div class="ins-info">
                    <h5>Phone</h5>
                    <p>980-XXXXXXX</p>
                </div>
            </div>
        </div>

        <div class="recent-jobs section-card">
            <h1>Jobs Applied</h1>
            <div class="recent-job-box">
                <div class="jobbox z-depth-1">
                    <div class="row">
                        <div class="col s12 row valign-wrapper" style="margin-bottom:0">
                            <div class="col s10 m10">
                                <h4 class="title">Laravel Developer</h4>
                            </div>
                            <div class="col s2 m2">
                                <img class="cmpimg" src="../../assets/images/iw.png" alt="">
                            </div>
                        </div>
                        <div class="col s12 row" style="margin-top: 0;margin-bottom: 0;">
                            <div class="col s12" style="margin-bottom: 0;">
                                <h6 class="companyname" style="font-weight: 600;">My Power</h6>
                            </div>    
                        </div>
                        <div class="col s12" style="margin-top: 0px;">
                            <div class="center" style="margin-top: 0;">
                                <span class="text" class="center-align">Work On site</span>
                            </div>
                        </div>
                        <div class="col s12 row hide-on-med-and-down" style="margin-top: 15px;">
                            <div class="col s3 center-align">
                                <span class="text"><i class="material-icons inline-icon theme-text">play_circle_filled</i>Start date</span>
                               <br>
                               <span class="text2">Immidiately</span>
                            </div>
                            <div class="col s3 center-align"> 
                                <span class="text"><i class="material-icons inline-icon theme-text">date_range</i>Duration</span>
                                <br>
                                <span class="text2">2 Months</span></div>
                            <div class="col s3 center-align">
                                <span class="text"><i class="material-icons inline-icon theme-text">attach_money</i>Stipend</span>
                                <br>
                                <span class="text2">Work Based</span>
                            </div>
                            <div class="col s3 center-align">
                                <span class="text"><i class="material-icons inline-icon theme-text">access_time</i>Apply by</span>
                                <br>
                                <span class="text2">Dec 5</span>
                            </div>
                        </div>
                        <div class="col s12 row hide-on-large-only" style="margin-top: 15px;">
                            <div class="col s6 left-align">
                                <span class="text2"><i class="material-icons inline-icon theme-text">play_circle_filled</i>Immidiately</span>
                            </div>
                            <div class="col s6 left-align"> 
                                <span class="text2"><i class="material-icons inline-icon theme-text">date_range</i>2 Months</span>
                                </div>
                            <div class="col s6 left-align">
                                <span class="text2"><i class="material-icons inline-icon theme-text">attach_money</i>work based</span>
                            </div>
                            <div class="col s6 left-align">
                                <span class="text2"><i class="material-icons inline-icon theme-text">access_time</i>Dec 5</span>
                            </div>
                        </div>
                        <div class="col s12 row" style="margin-top: 10px; margin-bottom: 0;">
                            <div class="col s6 left-align">
                                <span class="jobtype">Internship</span>
                            </div>
                            <div class="col s6 right-align">
                                <a href="../../jobdetail.html">
                                    View Details 
                                    <i class="material-icons right">arrow_forward</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jobbox z-depth-1">
                    <div class="row">
                        <div class="col s12 row valign-wrapper" style="margin-bottom:0">
                            <div class="col s10 m10">
                                <h4 class="title">Laravel Developer</h4>
                            </div>
                            <div class="col s2 m2">
                                <img class="cmpimg" src="../../assets/images/iw.png" alt="">
                            </div>
                        </div>
                        <div class="col s12 row" style="margin-top: 0;margin-bottom: 0;">
                            <div class="col s12" style="margin-bottom: 0;">
                                <h6 class="companyname" style="font-weight: 600;">My Power</h6>
                            </div>    
                        </div>
                        <div class="col s12" style="margin-top: 0px;">
                            <div class="center" style="margin-top: 0;">
                                <span class="text" class="center-align">Work On site</span>
                            </div>
                        </div>
                        <div class="col s12 row hide-on-med-and-down" style="margin-top: 15px;">
                            <div class="col s3 center-align">
                                <span class="text"><i class="material-icons inline-icon theme-text">play_circle_filled</i>Start date</span>
                               <br>
                               <span class="text2">Immidiately</span>
                            </div>
                            <div class="col s3 center-align"> 
                                <span class="text"><i class="material-icons inline-icon theme-text">date_range</i>Duration</span>
                                <br>
                                <span class="text2">2 Months</span></div>
                            <div class="col s3 center-align">
                                <span class="text"><i class="material-icons inline-icon theme-text">attach_money</i>Stipend</span>
                                <br>
                                <span class="text2">Work Based</span>
                            </div>
                            <div class="col s3 center-align">
                                <span class="text"><i class="material-icons inline-icon theme-text">access_time</i>Apply by</span>
                                <br>
                                <span class="text2">Dec 5</span>
                            </div>
                        </div>
                        <div class="col s12 row hide-on-large-only" style="margin-top: 15px;">
                            <div class="col s6 left-align">
                                <span class="text2"><i class="material-icons inline-icon theme-text">play_circle_filled</i>Immidiately</span>
                            </div>
                            <div class="col s6 left-align"> 
                                <span class="text2"><i class="material-icons inline-icon theme-text">date_range</i>2 Months</span>
                                </div>
                            <div class="col s6 left-align">
                                <span class="text2"><i class="material-icons inline-icon theme-text">attach_money</i>work based</span>
                            </div>
                            <div class="col s6 left-align">
                                <span class="text2"><i class="material-icons inline-icon theme-text">access_time</i>Dec 5</span>
                            </div>
                        </div>
                        <div class="col s12 row" style="margin-top: 10px; margin-bottom: 0;">
                            <div class="col s6 left-align">
                                <span class="jobtype">Internship</span>
                            </div>
                            <div class="col s6 right-align">
                                <a href="../../jobdetail.html">
                                    View Details 
                                    <i class="material-icons right">arrow_forward</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="profile-sidebar">
        <div class="job-poster section-card">
            <a href="../../jobs.html">
                <h5>Look For Jobs</h5>
                <i class="material-icons">business_center</i>
            </a>
        </div>
        <div class="dashboard-tabs section-card">
            <a class="tab-menu" href="{{url('/candidate/profile')}}">
                <i class="material-icons">account_circle</i>
                <p class="menu-text">Account Profile</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="applied_jobs.html">
                <i class="material-icons">business_center</i>
                <p class="menu-text">Jobs Applied</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="saved_companies.html">
                <i class="material-icons">groups</i>
                <p class="menu-text">Saved Companies</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{'/candidate/settings'}}">
                <i class="material-icons">settings</i>
                <p class="menu-text">Account Settings</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{'/candidate/logout'}}">
                <i class="material-icons">logout</i>
                <p class="menu-text">Log Out</p>
            </a>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#taedit').click(function(){
        $('#taeditico').toggle();
        $('#tasaveico').toggle();
       $('#titletxt').toggle();
       $('#titleinp').toggle();
       $('#abouttxt').toggle();
       $('#aboutinp').toggle();
    })
    $('#editskill').click(function(){
        $('#skilled').toggle();
        $('#skillsv').toggle();
        $('.skilltxt').toggle();
        $('.skillinp').toggle();
    })
    $('#editeducation').click(function(){
        $('#editedu').toggle();
        $('#saveedu').toggle();
        $('.edutxt').toggle();
        $('.eduinp').toggle();
    })
    function addskill(){
        var sinp = $('#addskilltab').clone()
                var sinp2 = sinp.removeClass('hide')
                sinp2.appendTo("#skills-list")
    }
    function addeducation(){
            var sinp = $('#eduaddtab').clone()
                var sinp2 = sinp.css('display','block');
                sinp2.appendTo("#edu-list")
    }
        function tasubmit(){
            $('#taform').submit();
        }
        function skillsubmit(){
            $('#skillform').submit();
        }function edusubmit(){
            $('#eduform').submit();
        }
    $(document).ready(function(){
        fetchcand();
    function fetchcand(){
          $.ajax({
              type:"GET",
              url:"/candidateget",
              dataType:"json",
              success:function(response){
                  console.log(response.candidate.firstname)
                  $('#titletxt').html(response.candidate.title);
                  $('#titleval').val(response.candidate.title);
                  $('#abouttxt').text(response.candidate.about);
                  $('#aboutinp').val(response.candidate.about);
              }
          })
      }
        $('#taform').submit(function(e){
                 e.preventDefault();
                 let formData = new FormData($('#taform')[0]);
                 $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"{{url('candidate/taedit')}}",
                    data:formData,
                    contentType: false,
                    processData: false,
                    type:'POST',
                    success:function(response){
                        $('#taform')['0'].reset();
                        fetchcand();
                        M.toast({html: 'Title and About Updated!'})
                    }
                 })
            });
    })
</script>
@endsection