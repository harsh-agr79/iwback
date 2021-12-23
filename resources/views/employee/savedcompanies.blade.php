@extends('employee/layoutcand')

@section('main')
<div class="main-content">
    <section class="left-section cd-list">
        <div class='cd-search-section'>
            <h1>Companies Shortlist</h1>
        </div>
        <div class="section-card">
           
                @foreach ($savedcmpy as $item)
                @php
                    $cmpy = DB::table('companies')->where('id',$item->cmpyid)->first();
                @endphp
                <div class="cd-item">
                    <img class="cd-avatar" src="{{asset('company/dp/'.$cmpy->cmpydp)}}" alt="Avatar" style="height:60px;">
                    <div class="user-info-cd">
                        <h6><a href="{{url('/candidate/company/'.$cmpy->username)}}" class="black-text" style="font-weight:600;">{{$cmpy->cmpyname}}</a></h6>
                        @if ($cmpy->adminverification == 'verified')
                        <div class="verify-stamp" style="margin-top:3px; ">
                            <i class="material-icons" style="font-size: 1.3rem;">verified</i>
                            <span class="v-text" style="font-size: 1rem;">Verified</span>
                        </div>
                        @else
                            
                        @endif
                        
                    </div>
                    <div class="more-function">
                        <form id="usc" action="{{route('unsavecmpy')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" name="candid" value="{{$user[0]->id}}">
                        <input type="hidden" name="cmpyid" value="{{$cmpy->id}}">
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
            <a href="{{url('candidate/findjobs')}}">
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
            <a class="tab-menu" href="{{url('candidate/appliedjobs')}}">
                <i class="material-icons">business_center</i>
                <p class="menu-text">Jobs Applied</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{url('/candidate/savedcompanies')}}">
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
@endsection