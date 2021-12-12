@extends('company/layoutcmpy')

@section('main')
<div class="main-content">
    <section class="left-section">
        <div class="posted-jobs">
            <h1>Jobs Posted</h1>
            <div class="posted-job-box">
                {{-- {{$jobs}} --}}
                @foreach ($jobs as $item)
                <div class="jobbox z-depth-1">
                    <div class="row">
                        <div class="col s12 row valign-wrapper" style="margin-bottom:0">
                            <div class="col s11 m11">
                                <h4 class="title">{{$item->title}}</h4>
                            </div>
                            {{-- <button data-target="{{$item->id}}" class="col s1 m1 more_btn">
                                <i class="material-icons">more_vert</i>
                            </button>
                            <button id="{{$item->id}}" class="right-align dropdown-content btn waves-effect waves-light red">
                                Delete Post 
                                <i class="material-icons">delete</i>
                            </button> --}}
                            <a class='dropdown-trigger btn-flat' href='#' data-target='{{$item->id}}'><i class="material-icons">more_vert</i></a>

                            <!-- Dropdown Structure -->
                            <ul id='{{$item->id}}' class='dropdown-content z-depth-0' style="background: transparent;">
                                <button style="border-radius:20px;" class="btn waves-effect waves-light red">
                                    Delete Post 
                                    <i class="material-icons right">delete</i>
                                </button>
                            </ul>
                        </div>
                        <div class="col s12" style="margin-top: 0px;">
                            <div class="center" style="margin-top: 0;">
                                <span class="text" class="center-align">{{$item->orientation}}</span>
                            </div>
                        </div>
                        <div class="col s12 row hide-on-med-and-down" style="margin-top: 15px;">
                            <div class="col s4 center-align">
                                <span class="text text-extras"><i class="material-icons inline-icon theme-text">people</i>Applicants</span>
                               <span class="text2">0 Applicants</span>
                            </div>
                            <div class="col s4 center-align"> 
                                <span class="text text-extras"><i class="material-icons inline-icon theme-text">face</i>Shortlisted</span>
                                <span class="text2">0 Candidates</span></div>
                            <div class="col s4 center-align">
                                <span class="text text-extras"><i class="material-icons inline-icon theme-text">hourglass_empty</i>Expire Time</span>
                                <span class="text2">{{$item->deadline}}</span>
                            </div>
                        </div>
                        <div class="col s12 row hide-on-large-only" style="margin-top: 15px;">
                            <div class="col s6 left-align">
                                <span class="text2"><i class="material-icons inline-icon theme-text">people</i>0 Applicants</span>
                            </div>
                            <div class="col s6 left-align"> 
                                <span class="text2"><i class="material-icons inline-icon theme-text">face</i>0 Candidates</span>
                                </div>
                            <div class="col s6 left-align">
                                <span class="text2"><i class="material-icons inline-icon theme-text">hourglass_empty</i>{{$item->deadline}}</span>
                            </div>
                        </div>
                        <div class="col s12 row" style="margin-top: 10px; margin-bottom: 0;">
                            <div class="col s6 left-align">
                                <span class="jobtype">{{$item->type}}</span>
                            </div>
                            <div class="col s6 right-align">
                                <a href="{{url('job/'.$item->jobid)}}">
                                    View Details 
                                    <i class="material-icons right">arrow_forward</i>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                @endforeach
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
@endsection