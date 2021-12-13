@extends('employee/layoutcand')

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
                        <img class="avatar-img" src="../../assets/images/icon.png">
                        <div class="avatar-title">
                            <h4>Harsh Agarwal</h4>
                            <p class="location">Full Stack Developer</p>
                        </div>
                    </div>
                    <span class="avatar-edit-btn">
                        <i class="material-icons">mode_edit</i>                            
                    </span>
                </div>
                <div class="about-user">
                    <h4>About Me</h4>
                    <p>Qui est laboris culpa minim occaecat officia pariatur nisi. Aute ad occaecat tempor veniam. Pariatur dolore anim eu aliqua eiusmod proident. Magna laborum consectetur ut labore elit nulla enim sunt sint quis cupidatat proident consectetur eu. Anim minim magna ipsum enim et irure minim minim cupidatat esse.</p>
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
                <i class="material-icons">edit</i>
            </h3>
            <ul class="skill-list">
                <li>Adobe Photoshop</li>
                <li>HTML/CSS</li>
                <li>React</li>
                <li>Node.js</li>
            </ul>
            <span class="view_more">See All</span>
        </div>

        <div class="exp-section section-card">
            <h3>
                Education
                <i class="material-icons">edit</i>
            </h3>
            <div class="exp-grid-section">
                <div class="exp-item">
                    <img class="ins-icon" src="../../assets/slider/particles.png">
                    <div class="ins-info">
                        <h5>NCIT College</h5>
                        <p>Bachelors of Software Engineering</p>
                        <span>Apr 2019 - Present</span>
                    </div>
                </div>
                <div class="exp-item">
                    <img class="ins-icon" src="../../assets/slider/particles.png">
                    <div class="ins-info">
                        <h5>Kathmandu Model Secondary School</h5>
                        <p>+2 in Science</p>
                        <span>Jun 2017 - Feb 2019</span>
                    </div>
                </div>
                <div class="exp-item">
                    <img class="ins-icon" src="../../assets/slider/particles.png">
                    <div class="ins-info">
                        <h5>KMC School</h5>
                        <p>SEE</p>
                        <span>Mar 2017</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="exp-section section-card">
            <h3>
                Experience
                <i class="material-icons">edit</i>
            </h3>
            <div class="exp-grid-section">
                <div class="exp-item">
                    <img class="ins-icon" src="../../assets/slider/particles.png">
                    <div class="ins-info">
                        <h5>Horizonlair</h5>
                        <p>Full Stack Developer</p>
                        <span>Apr 2019 - Present</span>
                    </div>
                </div>
                <div class="exp-item">
                    <img class="ins-icon" src="../../assets/slider/particles.png">
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
            <a class="tab-menu" href="../account-settings.html">
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