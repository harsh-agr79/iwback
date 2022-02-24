@extends('company/layoutcmpy')
@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@php
  $skills = explode('|', $cand->skills);
  $eduorg = explode('|', $cand->eduorganization);
  $educou = explode('|', $cand->educourse);
  $edutfm = explode('|', $cand->edutimefrommonth);
  $edutfy = explode('|', $cand->edutimefromyear);
  $eduttm = explode('|', $cand->edutimetomonth);
  $edutty = explode('|', $cand->edutimetoyear);
  $exporg = explode('|', $cand->exporganization);
  $exppst = explode('|', $cand->exppost);
  $exptfm = explode('|', $cand->exptimefrommonth);
  $exptfy = explode('|', $cand->exptimefromyear);
  $expttm = explode('|', $cand->exptimetomonth);
  $exptty = explode('|', $cand->exptimetoyear);
@endphp
<div class="main-content">
    <section class="profile-dashboard">
        <div class="profile-info section-card">
            <div class="img-container">
                <div class="cover-pic" style="background-image: url('/candidate/cp/{{$cand->candcp}}') ">

                </div>
                <div class="avatar">
                    <div class="avatar-pic">
                        @if ($cand->canddp == NULL)
                        <img class="avatar-img" src="{{asset('assets/pngs/candidate.png')}}">
                        @else
                        <img class="avatar-img" src="{{asset('candidate/dp/'.$cand->canddp)}}">
                        @endif
                        <div class="avatar-title">
                            <h4>{{$cand->firstname}} {{$cand->lastname}}</h4>
                            <p class="location">{{$cand->title}}</p>
                            <a href="{{url('/company/msgs/'.$cand->id)}}" class="hide-on-large-only right" style="padding: 6px; cursor: pointer;">                    
                                <i class="material-icons theme-text" id="iconsave2">send</i>                      
                            </a>
                        </div>
                    </div>
                    <span class="avatar-edit-btn hide-on-large-only" onclick="saveformsub()">                    
                    @if (count($saved)>0)
                        <i class="material-icons" id="iconsave2">turned_in</i>
                    @else
                        <i class="material-icons" id="iconsave2">turned_in_not</i>
                    @endif                           
                    </span>
                    
                </div>
                @if ($cand->about == NULL)
                    
                @else
                <div class="about-user">
                    <h4>About Me</h4>
<pre>{{$cand->about}}</pre>
                </div>
                @endif
                
            </div>
        </div>
        @if (count($skills)>1)
        <div class="overview-section skill-section section-card">
            <h3>
             Skills
            </h3>
            <ul class="skill-list">
            @foreach ($skills as $item)
                @if ($item == NULL)
                    
                @else
                    <li>{{$item}}</li>
                @endif
            @endforeach
            
        </ul>
        </div>
        @else
           
        @endif
        

        @if (count($eduorg)>1)
        <div class="exp-section section-card">
            <h3>
                Education
            </h3>
            <div class="exp-grid-section">
                @for ($i = 0; $i < count($eduorg); $i++)
                @if ($eduorg[$i] == NULL)

                @else
                    <div class="exp-item">
                        <img class="ins-icon" src="{{asset('assets/pngs/education-hat.png')}}">
                        <div class="ins-info">
                            <h5>{{$eduorg[$i]}}</h5>
                            <p>{{$educou[$i]}}</p>
                            <span>{{$edutfm[$i]}} {{$edutfy[$i]}} - @if($eduttm[$i] == 'Present'){{$eduttm[$i]}} @else{{$eduttm[$i]}} {{$edutty[$i]}} @endif</span>
                        </div>
                    </div>
                @endif
               
                @endfor
                
            </div>
        </div>
        @else
            
        @endif
        
        @if (count($exporg)>1)
        <div class="exp-section section-card">
            <h3>
                Experience
            </h3>
            <div class="exp-grid-section">
                @for ($i = 0; $i < count($eduorg); $i++)
                    @if ($exporg[$i] == NULL)
                        
                    @else
                    <div class="exp-item">
                        <img class="ins-icon" src="{{asset('assets/pngs/experience.png')}}">
                        <div class="ins-info">
                            <h5>{{$exporg[$i]}}</h5>
                            <p>{{$exppst[$i]}}</p>
                            <span>{{$exptfm[$i]}} {{$exptfy[$i]}} - @if($expttm[$i] == 'Present'){{$expttm[$i]}} @else{{$expttm[$i]}} {{$exptty[$i]}} @endif</span>
                        </div>
                    </div>
                    @endif
                @endfor
                
            </div>
        </div>
        @else
            
        @endif
       

        <div class="extra-info contact-info section-card">
            <h1>
                Contact Info
            </h1>
            <div class="contact-item exp-item">
                <i class="material-icons">account_circle</i>
                <div class="ins-info">
                    <h5>Your Profile</h5>
                    <a href="{{url('account/candidate/'.$cand->username)}}" style="overflow-wrap: anywhere;">Profile Link</a>
                </div>
            </div>
            @if ($cand->portfoliowebsite == NULL)
                
            @else
            <div class="contact-item exp-item">
                <i class="material-icons">article</i>
                <div class="ins-info">
                    <h5>Portfolio</h5>
                    <a href="https://{{$cand->portfoliowebsite}}">https://{{$cand->portfoliowebsite}}</a>
                </div>
            </div>
            @endif
            
            <div class="contact-item exp-item">
                <i class="material-icons">email</i>
                <div class="ins-info">
                    <h5>Email</h5>
                    <p>{{$cand->email}}</p>
                </div>
            </div>
        </div>
    </section>
   
    <section class="profile-sidebar">
        <div class="job-poster section-card">
            <form id="saveform">
                <input type="hidden" name="candid" value="{{$cand->id}}">
                <input type="hidden" name="cmpyid" value="{{$user[0]->id}}">
            </form>
           
            <span  onclick="saveformsub()">
                <h5>Save Candidate</h5>
                @if (count($saved)>0)
                    <i class="material-icons" id="iconsave">turned_in</i>
                @else
                    <i class="material-icons" id="iconsave">turned_in_not</i>
                @endif
            </span>
        </div>
        <div class="job-poster section-card" style="margin-top: 10px;">
            <a href="{{url('/company/messages/'.$cand->id)}}">
                <h5>Send Message</h5>
                <i class="material-icons stlist-icon">send</i>
            </a>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function saveformsub(){
        $('#saveform').submit();
    }
    $(document).ready(function(){
        $('#saveform').submit(function(e){
            e.preventDefault();
            let formData = new FormData($('#saveform')[0]);
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:'/company/savecand',
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                // M.toast({html: result.pw})
                if (result.pw == 'Candidate Saved!') {
                    $('#iconsave').html('turned_in')
                    $('#iconsave2').html('turned_in')
                } else {
                    $('#iconsave').html('turned_in_not')
                    $('#iconsave2').html('turned_in_not')
                }
                }
            })
        })
    })
    
</script>
@endsection