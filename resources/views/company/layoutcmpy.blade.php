
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- materialize css cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../assets/dashboard.css">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="icon" href="../assets/images/title.png">
    <title>Internwheel | Dashboard</title>
</head>
<body>
    <div class="main-container">
        <div class="navbar-fixed">
            <nav class="grey lighten-5">
                <div class="nav-wrapper">
                    <a href="{{url('/')}}" class="brand-logo hide-on-med-and-down" style="margin-left: 10px; margin-top: 5px;">
                        <img src="{{asset('assets/images/iwmain.png')}}" height="40" alt="">
                    </a>
                    <a href="{{url('/')}}" class="brand-logo hide-on-large-only">
                        <img src="{{asset('assets/images/iw.png')}}" height="50" alt="">
                    </a>
                    <a class="right hide-on-large-only" style="margin-right:10px;">
                        <i class="material-icons black-text">message</i>
                    </a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger">
                         <i class="material-icons" style="color: #006994">account_circle</i>
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a class="black-text" href="{{url('/')}}">Home</a>
                        </li>
                        <li>
                            <a class="black-text" href="{{url('company/profile')}}">Dashboard</a>
                        </li>
                        <li>
                            <a class="black-text" href="">Post Jobs</a>
                        </li>
                        <li>
                            <a class="black-text" href="">Contact Us</a>
                        </li>
                        <li>
                            <a href="#" class="btn-floating white">
                                <i class="material-icons" style="color: #006994;">notifications</i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="accountdrop" class="btn-floating dropdown-trigger white">
                                <i class="material-icons" style="color: #006994">account_circle</i>
                            </a>
                            <ul id='accountdrop' class='dropdown-content'>
                                <li><a href="{{url('company/profile')}}" class="black-text"><i class="material-icons theme-text">account_circle</i>Profile</a></li>
                                <li><a href="#!" class="black-text"><i class="material-icons theme-text">business_center</i>Jobs posted</a></li>
                                <li><a href="#!" class="black-text"><i class="material-icons theme-text">groups</i>Saved Candidates</a></li>
                                <li><a href="{{url('company/settings')}}" class="black-text"><i class="material-icons theme-text">settings</i>Account Settings</a></li>
                                <li><a href="{{url('company/logout')}}" class="black-text"><i class="material-icons theme-text">logout</i>Logout</a></li>
                              </ul>
                              <ul id='accountdrop2' class='dropdown-content'>
                                <li><a href="{{url('company/profile')}}" class="black-text"><i class="material-icons theme-text">account_circle</i>Profile</a></li>
                                <li><a href="#!" class="black-text"><i class="material-icons theme-text">business_center</i>Jobs posted</a></li>
                                <li><a href="#!" class="black-text"><i class="material-icons theme-text">groups</i>Saved Candidates</a></li>
                                <li><a href="{{url('company/settings')}}" class="black-text"><i class="material-icons theme-text">settings</i>Account Settings</a></li>
                                <li><a href="{{url('company/logout')}}" class="black-text"><i class="material-icons theme-text">logout</i>Logout</a></li>
                              </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <aside class="bottom-nav">
                <a class="bottom-tab" href="{{url('/')}}">
                    <i class="material-icons">home</i>
                    <p>Home</p>
                </a>
                <a class="bottom-tab" href="#">
                    <i class="material-icons">group</i>
                    <p>Saved Candidates</p>
                </a>
                <a class="bottom-tab active" href="#">
                    <i class="material-icons">add_box</i>
                    <p>Post Job</p>
                </a>
                <a class="bottom-tab" href="#">
                    <i class="material-icons">notifications</i>
                    <p>Notifications</p>
                </a>
                <a class="bottom-tab final-tab" href="#">
                    <i class="material-icons">business_center</i>
                    <p>Jobs Posted</p>
                </a>
            </aside>
        </div>
        
        <ul class="sidenav" id="mobile-demo">
            <div class="dashboard-tabs section-card">
                <a class="tab-menu" href="{{url('company/profile')}}">
                    <i class="material-icons">account_circle</i>
                    <p class="menu-text">{{$user['0']->cmpyname}}</p>
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
        </ul>

        <main>
            @if ($user['0']->emailverification == 'verified')
            
                @yield('main')
            @else
                <div style="height: 40vh;">
                
                </div>
                <div class="center-align" style="font-size: 30px;">Please verify Your Email first to access <img src="{{asset('assets/images/iwmain.png')}}" class="inline-icon" height="50" alt=""></div>
                <div style="height: 40vh;">
                
                </div>
            @endif
            </main>

        <footer class="page-footer theme" style="margin-top: 10vh;">
            <div class="">
                <div class="row">
                    <div class="col l3 s12">
                        <h5 class="white-text">InternWheel</h5>
                        <p class="grey-text text-lighten-4">Register as a candidate and post your vacancies to find the best candidates for your job. Register as a candidate, and you can find your ideal career whether it be full time, part time, or internship.</p>
                        <div class="row">
                            <div class="col s3"></div>
                            <div class="col s6 row">
                                <div class="col s4"><a href="" class=""><img src="../assets/svgs/fb.svg" height="70" alt=""></a></div>
                                <div class="col s4"><a href="" class=""><img src="../assets/svgs/ig.svg" height="70" alt=""></a></div>
                                <div class="col s4"><a href="" class=""><img src="../assets/svgs/li.svg" height="70" alt=""></a></div>
                            </div>
                            <div class="col s3"></div>
                            
                        </div>
                    </div>
                    <div class="col l3 s12">
                        <h5 class="white-text">Internship By Stream</h5>
                        <ul>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Sales</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Marketing</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Programming</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Designing</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l3 s12">
                        <h5 class="white-text">Quick Links</h5>
                        <ul>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Home</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Internships</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Jobs</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Freshers Job</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l3 s12">
                        <h5 class="white-text">About Internwheel</h5>
                        <ul>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">About US</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Hire Interns From Us</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Team</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Blog</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Our services</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Terms & Conditions</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Privacy</a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="#!">Contact us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    © 2021 Copyright InternWheel
                    <a class="grey-text text-lighten-4 right" href="#!">
                        <span class="white black-text btn" style="border-radius: 20px;">
                            Install App
                        </span>
                    </a>
                </div>
            </div>
        </footer>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="../assets/dashboard.js"></script>
</html>