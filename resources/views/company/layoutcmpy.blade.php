
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- materialize css cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <link rel="icon" href="{{asset('assets/images/icon.png')}}">
    <title>Internwheel | Dashboard</title>
</head>
<body>
    <div class="main-container">
        <div class="navbar-fixed">
            <nav class="grey lighten-5">
                <div class="nav-wrapper">
                    <a href="{{url('/')}}" class="brand-logo hide-on-med-and-down" style="margin-left: 10px; margin-top: 5px;">
                        <img src="{{asset('assets/images/Main-light-transparent.png')}}" height="40" alt="">
                    </a>
                    <a href="{{url('/')}}" class="brand-logo hide-on-large-only">
                        <img src="{{asset('assets/images/short-transparent.png')}}" height="50" alt="">
                    </a>
                    <a class="right hide-on-large-only" style="margin-right:10px;">
                        <i class="material-icons black-text">message</i>
                    </a>
                    <span class="hide-on-large-only">
                        @if ($user[0]->cmpydp == NULL)
                        <a href="#" data-target="mobile-demo" class="sidenav-trigger">
                            <i class="material-icons" style="color: #0082cc">account_circle</i>
                       </a>
                        @else
                        <a href="#" data-target="mobile-demo" class="valign-wrapper sidenav-trigger">
                            <img height="40" style="border-radius: 50%" src="{{asset('company/dp/'.$user[0]->cmpydp)}}" alt="">
                       </a>
                            
                        @endif
                        
                    </span>
                    
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a class="black-text" href="{{url('/')}}">Home</a>
                        </li>
                        <li>
                            <a class="black-text" href="{{url('company/profile')}}">Dashboard</a>
                        </li>
                        <li>
                            <a class="black-text" href="{{url('company/postajob')}}">Post Jobs</a>
                        </li>
                        <li>
                            <a class="black-text" href="">Contact Us</a>
                        </li>
                        <li>
                            <a href="#" class="btn-floating white">
                                <i class="material-icons" style="color: #0082cc;">notifications</i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-target="accountdrop" class="btn-floating dropdown-trigger white">
                                @if ($user[0]->cmpydp == NULL)
                                <i class="material-icons" style="color: #0082cc">account_circle</i>
                                @else
                                <img height="40" src="{{asset('company/dp/'.$user[0]->cmpydp)}}" alt="">
                                @endif
                            </a>
                            <ul id='accountdrop' class='dropdown-content'>
                                <li><a href="{{url('company/profile')}}" class="black-text"><i class="material-icons theme-text">account_circle</i>Profile</a></li>
                                <li><a href="{{url('company/jobsmanager')}}" class="black-text"><i class="material-icons theme-text">business_center</i>Jobs posted</a></li>
                                <li><a href="#!" class="black-text"><i class="material-icons theme-text">groups</i>Saved Candidates</a></li>
                                <li><a href="{{url('company/settings')}}" class="black-text"><i class="material-icons theme-text">settings</i>Account Settings</a></li>
                                <li><a href="{{url('company/logout')}}" class="black-text"><i class="material-icons theme-text">logout</i>Logout</a></li>
                              </ul>
                              <ul id='accountdrop2' class='dropdown-content'>
                                <li><a href="{{url('company/profile')}}" class="black-text"><i class="material-icons theme-text">account_circle</i>Profile</a></li>
                                <li><a href="{{url('company/jobsmanager')}}" class="black-text"><i class="material-icons theme-text">business_center</i>Jobs posted</a></li>
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
                <a class="bottom-tab active" href="{{url('company/postajob')}}">
                    <i class="material-icons">add_box</i>
                    <p>Post Job</p>
                </a>
                <a class="bottom-tab" href="#">
                    <i class="material-icons">notifications</i>
                    <p>Notifications</p>
                </a>
                <a class="bottom-tab final-tab" href="{{url('company/jobsmanager')}}">
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
                <a class="tab-menu" href="{{url('company/jobsmanager')}}l">
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
            @if($user['0']->deactivate === 'on')
        <div style="height: 40vh;">
        
        </div>
        <div class="center-align" style="font-size: 30px;">Your account is Deactivated, if you want to reactivate your account please <br><span class="btn theme waves-effect modal-trigger" href="#reactivate"> click here </span><br><img src="{{asset('assets/images/Main-light-transparent.png')}}" class="inline-icon" height="50" alt=""></div>
        
        <div id="reactivate" class="modal">
            <div class="modal-content">
                <div id="loadercont" class="center">

                </div>
                <div id="emailmsg">

                </div>
              <form action="" method="POST" enctype="multipart/form-data" id="reactivateacc">
                @csrf
                  <div class="center">
                    <h4>Reactivate account</h4>
                    <input type="hidden" name="id" value="{{$user['0']->id}}">
                    <button class="btn theme waves-effect">Reactivate</button>
                  </div>
                 
              </form>
            </div>
           
          </div>
                  
        <div style="height: 40vh;">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
              $(document).ready(function(){
                    $('.modal').modal();

                    $('#reactivateacc').submit(function(e){
            e.preventDefault();
            $('#reactivateacc').toggle();
            $('#loadercont').append('<div id="loader" class="preloader-wrapper big active">\
    <div class="spinner-layer spinner-blue-only">\
      <div class="circle-clipper left">\
        <div class="circle"></div>\
      </div><div class="gap-patch">\
        <div class="circle"></div>\
      </div><div class="circle-clipper right">\
        <div class="circle"></div>\
      </div>\
    </div>\
  </div>');
            let formData = new FormData($('#reactivateacc')[0]);
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('company/reactivate')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                M.toast({html: result.pw})
                if(result.pw === 'Check Your email to reactivate your account'){
                    $('#loader').remove();
                    $('#emailmsg').text('Please check Your email to Reactivate your account, check the spam folder incase you do not find the mail')
                }
            }
            })
        });
              });
        </script>
        </div>
    @elseif ($user['0']->emailverification == 'verified')
    
        @yield('main')
    
    @else
        <div style="height: 40vh;">
        
        </div>
        <div class="center-align" style="font-size: 30px;">Please verify Your Email first to access <img src="{{asset('assets/images/Main-light-transparent.png')}}" class="inline-icon" height="50" alt=""></div>
        <div style="height: 40vh;">
        
        </div>
    @endif
            </main>

            <div class="hide-on-large-only" style="height: 100px;">

            </div>

        <footer class="page-footer hide-on-med-and-down theme" style="margin-top: 10vh;">
            <div class="">
                <div class="row">
                    <div class="col l3 s12">
                        <h5 class="white-text">InternWheel</h5>
                        <p class="grey-text text-lighten-4">Register as a candidate and post your vacancies to find the best candidates for your job. Register as a candidate, and you can find your ideal career whether it be full time, part time, or internship.</p>
                        <div class="row">
                            <div class="col s3"></div>
                            <div class="col s6 row">
                                <div class="col s4"><a href="" class=""><img src="{{asset('assets/svgs/fb.svg')}}" height="70" alt=""></a></div>
                                <div class="col s4"><a href="" class=""><img src="{{asset('assets/svgs/ig.svg')}}" height="70" alt=""></a></div>
                                <div class="col s4"><a href="" class=""><img src="{{asset('assets/svgs/li.svg')}}" height="70" alt=""></a></div>
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
<script src="{{asset('assets/dashboard.js')}}"></script>
</html>