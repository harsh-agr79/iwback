
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <link rel="icon" href="{{asset('assets/images/title.png')}}">
    <title>{{$title}}</title>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
  <header>
    <ul id='dropdown1' class='dropdown-content'>
      <li><a class="" href="./registeremployer.html">As a Employer</a></li>
      <li><a class="" href="./registeremployee.html">As a employee</a></li>
    </ul>
    <ul id='dropdown2' class='dropdown-content'>
      <li><a class="" href="./registeremployer.html">As a Employer</a></li>
      <li><a class="" href="./registeremployee.html">As a employee</a></li>
    </ul>
    <ul id='dropdown3' class='dropdown-content'>
      <li><a class="" href="./registeremployer.html">As a Employer</a></li>
      <li><a class="" href="./registeremployee.html">As a employee</a></li>
    </ul>
    <div class="">
      <nav class="grey lighten-5">
          <div class="nav-wrapper">
            <a href="{{url('/')}}" class="brand-logo hide-on-med-and-down" style="margin-left: 10px; margin-top: 5px;"><img src="{{asset('assets/images/iwmain.png')}}" height="40" alt=""></a>
            <a href="{{url('/')}}" class="brand-logo hide-on-large-only"><img src="{{asset('assets/images/iw.png')}}" height="50" alt=""></a>
            <span class="right">
              <a class="hide-on-large-only btn theme white-text" style="margin-right:10px;" href="{{url('login')}}">Login</a>
            </span>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons black-text">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li><a class="black-text" href="jobs.html">Internships</a></li>
              <li><a class="black-text" href="jobs.html">Freshers Jobs</a></li>
              <li><a class="black-text" href="jobs.html">Jobs</a></li>
              <li><a class="black-text" href="mobile.html">Contact Us</a></li>
              <li><a class="btn-small theme-text white loginbtn" href="{{url('login')}}">Login</a></li>
              <li><a class="white-text btn-small waves-effect theme dropdown-trigger" style="border-radius: 20px;" data-target="dropdown1">register<i class="material-icons right">expand_more</i></a></li>
  
            </ul>
          </div>
        </nav>
    </div>
  
    <ul class="sidenav" id="mobile-demo">
      <li><a class="black-text" href="jobs.html">Internships</a></li>
      <li><a class="black-text" href="jobs.html">Freshers Jobs</a></li>
      <li><a class="black-text" href="jobs.html">Jobs</a></li>
      <li><a class="black-text" href="mobile.html">Contact Us</a></li>
      <li><div class="divider"></div></li>
      <li><a class="black-text" href="./registeremployer.html">Register as a Employer</a></li>
      <li><a class="black-text" href="./registeremployee.html">Register as A Employee</a></li>
      <li><div class="divider"></div></li>
      <li><a class="black-text" href="{{url('login')}}">Login</a></li>
      <li><div class="divider"></div></li>
    </ul>
  </header>

<main>
    @yield('main')
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
                    <div class="col s4"><a href="" class=""><img src="./assets/svgs/fb.svg" height="70" alt=""></a></div>
                    <div class="col s4"><a href="" class=""><img src="./assets/svgs/ig.svg" height="70" alt=""></a></div>
                    <div class="col s4"><a href="" class=""><img src="./assets/svgs/li.svg" height="70" alt=""></a></div>
                  </div>
                  <div class="col s3"></div>
                
              </div>
            </div>
            <div class="col l3 s12">
              <h5 class="white-text">Internship By Stream</h5>
              <ul>
                <li><a class="grey-text text-lighten-3" href="#!">Sales</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Marketing</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Programming</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Designing</a></li>
              </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Quick Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Internships</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Jobs</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Freshers Job</a></li>
                </ul>
              </div>
              <div class="col l3 s12">
                <h5 class="white-text">About Internwheel</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">About US</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Hire Interns From Us</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Team</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Blog</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Our services</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Terms & Conditions</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Privacy</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Contact us</a></li>
                </ul>
              </div>
          </div>
        </div>
        <div class="footer-copyright">
          <div class="container">
          © 2021 Copyright InternWheel
          <a class="grey-text text-lighten-4 right" href="#!"><span class="white black-text btn" style="border-radius: 20px;">Install App</span></a>
          </div>
        </div>
      </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="{{asset('assets/script.js')}}"></script>
</body>
</html>