@extends('company/layoutcmpy')

@section('main')
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
                        <img class="avatar-img" src="{{asset('candidate/dp/'.$cand->canddp)}}">
                        <div class="avatar-title">
                            <h4>{{$cand->firstname}} {{$cand->lastname}}</h4>
                            <p class="location">{{$cand->title}}</p>
                        </div>
                    </div>
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
                    <a href="{{url('account/candidate/'.$cand->username)}}">{{url('account/candidate/'.$cand->username)}}</a>
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
            <a onclick="shortlistBtn()">
                <h5>Save Candidate</h5>
                <i class="material-icons stlist-icon">turned_in_not</i>
            </a>
        </div>
        <div class="job-poster section-card" style="margin-top: 10px;">
            <a>
                <h5>Send Message</h5>
                <i class="material-icons stlist-icon">send</i>
            </a>
        </div>
    </section>
</div>
<script>
     let shortlist = document.querySelector('.stlist-icon')
    var shortlistBtn = () => {
        if(shortlist.innerHTML == 'turned_in_not'){
            shortlist.innerHTML = 'turned_in'
        }
        else{
            shortlist.innerHTML = 'turned_in_not'
        }
    }
</script>
@endsection