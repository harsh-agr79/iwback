@extends('company/layoutcmpy')

@section('main')
<div class="main-content">
    <section class="left-section">
        <div class="settings-section section-card">
            <h1>Account Settings</h1>
            <div class="divider"></div>
            <div class="settings-items">
                <div class="settings-item">
                    <h3 class="item-title">Full Name</h3>
                    <i class="material-icons">edit</i>
                    <span class="current-data">{{$company['0']->firstname}} {{$company['0']->lastname}}</span>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Username</h3>
                    <i class="material-icons">edit</i>
                    <span class="current-data">{{$company['0']->username}}</span>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Company Name</h3>
                    <i class="material-icons">edit</i>
                    <span class="current-data">{{$company['0']->cmpyname}}</span>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Email</h3>
                    <i class="material-icons">edit</i>
                    <span class="current-data">{{$company['0']->email}}</span>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Password</h3>
                    <i class="material-icons">edit</i>
                    <span class="current-data">**********</span>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Contact No.</h3>
                    <i class="material-icons">edit</i>
                    <span class="current-data">98********</span>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Deactivate Account</h3>
                    <i class="material-icons deactivate-btn">warning</i>
                </div>
            </div>
        </div>
    </section>
    <section class="profile-sidebar">
        <div class="job-poster section-card">
            <a href="postAJob.html">
                <h5>Post a job</h5>
                <i class="material-icons">add_circle</i>
            </a>
        </div>
        <div class="dashboard-tabs section-card">
            <a class="tab-menu" href="{{url('company/profile')}}">
                <i class="material-icons">account_circle</i>
                <p class="menu-text">Company Profile</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="job-manager.html">
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