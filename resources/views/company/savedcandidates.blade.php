@extends('company/layoutcmpy')

@section('main')
<div class="main-content">
    <section class="left-section cd-list">
        <div class='cd-search-section'>
            <h1>Saved Candidates</h1>
        </div>
        <div class="section-card">
           
                @foreach ($savedcand as $item)
                @php
                    $cand = DB::table('employees')->where('id',$item->candid)->first();
                @endphp
                <div class="cd-item">
                    @if ($cand->canddp == NULL)
                    <img class="cd-avatar" src="{{asset('assets/pngs/candidate.png')}}" alt="Avatar" style="height:60px;">
                    @else
                    <img class="cd-avatar" src="{{asset('/candidate/dp/'.$cand->canddp)}}" alt="Avatar" style="height:60px;">
                    @endif
                    <div class="user-info-cd">
                        <h6><a href="{{url('/company/candidate/'.$cand->username)}}" class="black-text" style="font-weight:600;">{{$cand->firstname}} {{$cand->lastname}}</a></h6>
                        <div class="verify-stamp" style="margin-top:3px; ">
                            <i class="material-icons white-text" style="font-size: 1.3rem;">verified</i>
                            <span class="v-text" style="font-size: 1rem;">{{$cand->email}}</span>
                        </div>
                    </div>
                    <div class="more-function">
                        <form id="usc" action="{{route('unsavecand')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" name="cmpyid" value="{{$user[0]->id}}">
                        <input type="hidden" name="candid" value="{{$cand->id}}">
                        </form>
                        <span class="material-icons more-icon theme-text" onclick="document.getElementById('usc').submit()">turned_in</span>
                    </div>
                </div>
                <div class="divider"></div>
                @endforeach 
           
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
@endsection