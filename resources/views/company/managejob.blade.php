@extends('company/layoutcmpy')

@section('main')
@php
    $company = DB::table('companies')->where('id',$job[0]->cmpyid)->get();
@endphp
@php
    $dis = '';
    foreach ($applicants as $item) {
        if ($item->hired == 'on') {
            $dis = 'disabled';
        }
    }
@endphp

<div class="main-content">
    <section class="left-section">
        <div class="self-contain">
            <div class="detpg">
              <div class="row detpgch">
                  <div class="col s12 row valign-wrapper" style="margin-bottom:0">
                      <div class="col s10 m10">
                          <h4 class="title">{{$job[0]->title}}</h4>
                      </div>
                      <div class="col s2 m2">
                          <img class="cmpimg" src="{{asset('company/dp/'.$company[0]->cmpydp)}}" alt="">
                      </div>
                  </div>
                  <div class="col s12 row" style="margin-top: 0;margin-bottom: 0;">
                      <div class="col s12" style="margin-bottom: 0;">
                          <h6 class="companyname" style="font-weight: 600;">{{$company[0]->cmpyname}}</h6>
                      </div>    
                  </div>
                  <div class="col s12" style="margin-top: 0px;">
                      <div class="center" style="margin-top: 0;">
                          <span class="text" class="center-align">{{$job[0]->orientation}}</span>
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
                          <span class="text2">{{$job[0]->duration}}</span></div>
                      <div class="col s3 center-align">
                        <span class="text"><i class="material-icons inline-icon theme-text">attach_money</i>Stipend</span>
                          <br>
                          <span class="text2">@if ($job[0]->stipend == 'on')
                            Work Based
                        @else
                        {{$job[0]->stipend}}</span>
                        @endif</span>
                      </div>
                      <div class="col s3 center-align">
                        <span class="text"><i class="material-icons inline-icon theme-text">access_time</i>Apply by</span>
                          <br>
                          <span class="text2">{{$job[0]->deadline}}</span>
                      </div>
                  </div>
                  <div class="col s12 row hide-on-large-only" style="margin-top: 15px;">
                    <div class="col s6 left-align">
                       <span class="text2"><i class="material-icons inline-icon theme-text">play_circle_filled</i>Immidiately</span>
                    </div>
                    <div class="col s6 left-align"> 
                        <span class="text2"><i class="material-icons inline-icon theme-text">date_range</i>{{$job[0]->duration}}</span>
                      </div>
                    <div class="col s6 left-align">
                      <span class="text2"><i class="material-icons inline-icon theme-text">attach_money</i>@if ($job[0]->stipend == 'on')
                        Work Based
                    @else
                    {{$job[0]->stipend}}</span>
                    @endif
                    </div>
                    <div class="col s6 left-align">
                        <span class="text2"><i class="material-icons inline-icon theme-text">access_time</i>{{$job[0]->deadline}}</span>
                    </div>
                </div>
                  <div class="col s12 row" style="margin-top: 10px; margin-bottom: 0;">
                    <div class="col s6 left-align">
                      <span class="jobtype">{{$job[0]->type}}</span>
                    </div>
                    <div class="col s6 right-align">
                      <a href=""><i class="material-icons right">share</i></a>
                      <a href="{{url('job/edit/'.$job[0]->jobid)}}"><i class="material-icons right">edit</i></a>
                    </div>
                  </div>
              </div>
            <hr>
                  <div>
                      <h5>Applicants</h5>
                  </div>
             <div>
                 <ul class="collapsible">
                    
                        @foreach ($applicants as $item)
                    <li>
                        @php
                            $aplt = DB::table('employees')->where('id',$item->candid)->first();
                        @endphp
                        <div class="valign-wrapper row collapsible-header" style="border-top:1px solid rgb(230, 230, 230);">
                            <div class="col s1">
                                <span style="margin: 0; padding: 0;">
                                    <img style="border-radius: 50%;" height="35" src="{{asset('candidate/dp/'.$aplt->canddp)}}" alt="">
                                </span>
                            </div>
                            <div class="col s4 center-align">
                                <span class="center-align" style="font-size: 17px;">
                                    {{$aplt->firstname}} {{$aplt->lastname}}
                                </span>
                            </div>
                            <div class="col s4" style="z-index: 3">
                                <span>
                                    <form class="shortlist">
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <label>
                                            @if ($item->shortlist == 'on')
                                                <input class="slbtn" name="sl" onclick="if(this.parentNode.querySelector('.sllbl').innerHTML == 'Shortlist')
                                                {
                                                    this.parentNode.querySelector('.sllbl').innerHTML = 'Shortlisted'
                                                }
                                                else
                                                {
                                                    this.parentNode.querySelector('.sllbl').innerHTML = 'Shortlist'
                                                }" checked {{$dis}} type="checkbox"/>
                                                <span class="sllbl">Shortlisted</span>
                                            @else
                                                <input class="slbtn" name="sl" {{$dis}} onclick="if(this.parentNode.querySelector('.sllbl').innerHTML == 'Shortlist')
                                                {
                                                    this.parentNode.querySelector('.sllbl').innerHTML = 'Shortlisted'
                                                }
                                                else
                                                {
                                                    this.parentNode.querySelector('.sllbl').innerHTML = 'Shortlist'
                                                }"  type="checkbox"/>
                                                <span class="sllbl">Shortlist</span>
                                            @endif
                                            
                                        </label>
                                    </form>
                                    
                                </span>
                            </div>
                            <div class="col s3"  style="z-index: 3">
                                <form method="POST" enctype="multipart/form-data" action="{{route('hire')}}">
                                    @csrf
                                <span>
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <label>
                                        @if ($item->hired == 'on' && $dis == 'disabled')
                                        <input name="hire" checked onclick="this.parentNode.parentNode.parentNode.submit()" type="checkbox"/>
                                        <span>Hire</span>
                                        @else
                                        <input name="hire" {{$dis}} onclick="this.parentNode.parentNode.parentNode.submit()" type="checkbox"/>
                                        <span>Hire</span>
                                        @endif
                                        
                                      </label>
                                </span>
                            </form>
                            </div>
                        </div>
                        <div class="collapsible-body">
                            <div>
                                <a class="btn waves-effect waves-light theme" href="{{url('company/candidate/'.$aplt->username)}}">View Profile</a>
                            </div>
<pre>{{$item->proposal}}</pre>
                        </div>
                    </li>
                @endforeach
                 </ul>
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
            <a href="{{url('company/postajob')}}" class="tooltipped" data-position="bottom" data-tooltip="You cannot post a job yet">
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
            <a class="tab-menu" href="saved-candidates.html">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
        function slfunc(){
           
        }
    $(document).ready(function(){
               $('.slbtn').on('click', function(e){
                let formData = $(this).closest('.shortlist').serialize()
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"/company/shortlist",
                    data: formData,
                    type:'POST',
                    success:function(result){
                        if(result.pw == 'on'){
                            M.toast({html: 'Shortlisted'})
                        }
                        else
                        {
                            M.toast({html: 'Removed From Shortlist'})
                        }
                    }
                })
            })
    })
</script>
@endsection