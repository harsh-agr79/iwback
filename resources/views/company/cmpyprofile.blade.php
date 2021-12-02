@extends('company/layoutcmpy')

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
                        <img class="avatar-img" src="../assets/images/icon.png">
                        <div class="avatar-title">
                            <h4>{{$company['0']->cmpyname}}</h4>
                            <p class="location">{{$company['0']->mainlocation}}</p>
                            <div></div>
                            <a class="contact-toggle modal-trigger" href="#modal1" data-target="modal1">Contact Info</a>
                        </div>
                    </div>
                    <span class="avatar-edit-btn">
                        <i class="material-icons">mode_edit</i>                            
                    </span>
                </div>
                <div class="about-user">
                    <h4>About Us</h4>
                    <p>{{$company['0']->about}}</p>
                </div>
            </div>
        </div>

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>{{$company['0']->cmpyname}}</h4>
                <div class="divider"></div>
                <div class="contact-edit">
                    <h6>Contact Info</h6>
                    <i class="material-icons">edit</i>
                </div>
                <ul class="contact-list">
                    <li>
                        <i class="material-icons">email</i>
                        <span class="contact-detail">
                            <h5>Email</h5>
                            <p>{{$company['0']->email}}</p>
                        </span>
                    </li>
                    <li>
                        <i class="material-icons">phone</i>
                        <span class="contact-detail">
                            <h5>Phone</h5>
                            <p>(+977) {{$company['0']->phonenumber}}</p>
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="user-dashboard-section section-card">
            <h1>Your Dashboard</h1>
            <div class="article-count section-card">
                <div class="article-col col-1">
                    <span>8</span>
                    <a href="#jobs-posted">Jobs Posted</a>
                </div>
                <div class="article-col col-2">
                    <span>12</span>
                    <a href="#hired-info">Applicants Hired</a>
                </div>
                <div class="article-col col-3">
                    <span>2</span>
                    <a href="#active-jobs">Active Vacancies</a>
                </div>
            </div>
        </div>

        <div class="overview-section section-card">
            <h3>Overview</h3>
<pre>{{$company['0']->overview}}</pre>
            <div class="extra-overview">
                <h6>Website</h6>
                <a href="{{$company['0']->website}}" target="_blank">{{$company['0']->website}}</a>
            </div>
            <div class="extra-overview">
                <h6>Location</h6>
                <p>{{$company['0']->mainlocation}}</p>
            </div>
            <div class="extra-overview">
                <h6>Company Size</h6>
                <p>{{$company['0']->cmpysize}}</p>
            </div>
            <div class="extra-overview">
                <h6>Estd.</h6>
                <p>{{$company['0']->cmpyestd}}</p>
            </div>
        </div>

        <div class="recent-jobs section-card">
            <h1>Recent Job Openings</h1>
            <div class="recent-job-box">
                <div class="jobbox z-depth-1">
                    <div class="row">
                        <div class="col s12 row valign-wrapper" style="margin-bottom:0">
                            <div class="col s10 m10">
                                <h4 class="title">Laravel Developer</h4>
                            </div>
                            <div class="col s2 m2">
                                <img class="cmpimg" src="../assets/images/iw.png" alt="">
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
                                <a href="./jobdetail.html">
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
                                <img class="cmpimg" src="../assets/images/iw.png" alt="">
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
                                <a href="./jobdetail.html">
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
            <a class="tab-menu" href="account-settings.html">
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