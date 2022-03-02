
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
    <link rel="stylesheet" href="{{asset('assets/dashboard.css')}}">
    <link rel="icon" href="{{asset('assets/images/icon.png')}}">
    <meta name="theme-color" content="#0082cc"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/favicon-16x16.png') }}">
    <link rel="mask-icon" href="{{asset('icons/safari-pinned-tab.svg')}}" color="#0082cc">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <title>{{$title}}</title>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
@if(session()->has('ADMIN_LOGIN'))
<span class="hide">{{$usercu = 'admin'}}</span>  
@else
<span class="hide">{{$usercu = 'guest'}}</span> 
@endif
<body>
@if (session()->has('CMPY_LOGIN'))
<div class="notification-drop">
  <div style="padding: 10px; font-weight: 600;">
      <span class="right btn-flat dropdown-trigger" data-target="dropdown1">
          <i class="material-icons">
              more_vert
          </i>
      </span>
      <h6>Notifications</h6>
      <ul id='dropdown1' class='dropdown-content'>
          <li><a href="{{url('company/notifmar')}}" class="black-text"><i class="material-icons theme-text">visibility</i>Mark All as Read</a></li>
          <li><a href="{{url('company/notifdel')}}" class="black-text"><i class="material-icons red-text">delete</i>Clear Notifications</a></li>
        </ul>
  </div>
  <div class="notification-inner">
      @foreach ($user[0]->unReadNotifications as $notification)
      @php
          $cand = DB::table('employees')->where('id', $notification->data['cand'])->first();   
          $job = DB::table('jobs')->where('jobid', $notification->data['job'])->first();
      @endphp
      <a href="{{url('/company/notification/'.$notification->id.'/'.$notification->data['job'])}}">
      <div class="notification-item unread">
        @if ($cand->canddp == NULL)
        <img class="notif-img" src="{{asset('assets/pngs/candidate.png')}}">
        @else
        <img class="notif-img" src="{{asset('candidate/dp/'.$cand->canddp)}}">
        @endif
          <span class="notif-detail">
              <h2  style="font-weight: 600;">{{$cand->firstname}} {{$cand->lastname}}</h2>
              <p>{{$notification->data['msg']}} <span style="font-weight: 600;">{{$job->title}}</span></p>
              <p style="font-size: 10px; margin-top:2px;"><span class="hide">{{$start = $notification->created_at}}</span>
                  {{date('Y-m-d H:i',strtotime('+5 hour +45 minutes',strtotime($start)));}}</p>
          </span>
      </div>
      </a>
      @endforeach
      @foreach ($user[0]->ReadNotifications as $notification)
      @php
          $cand = DB::table('employees')->where('id', $notification->data['cand'])->first();   
          $job = DB::table('jobs')->where('jobid', $notification->data['job'])->first();
      @endphp
      <a href="{{url('managejob/'.$notification->data['job'])}}" class="black-text">
      <div class="notification-item">
        @if ($cand->canddp == NULL)
        <img class="notif-img" src="{{asset('assets/pngs/candidate.png')}}">
        @else
        <img class="notif-img" src="{{asset('candidate/dp/'.$cand->canddp)}}">
        @endif
          <span class="notif-detail">
              <h2 style="font-weight: 600;">{{$cand->firstname}} {{$cand->lastname}}</h2>
              <p>{{$notification->data['msg']}} <span style="font-weight: 600;">{{$job->title}}</span></p>
              <p style="font-size: 10px; margin-top:2px;"><span class="hide">{{$start = $notification->created_at}}</span>
                  {{date('Y-m-d H:i',strtotime('+5 hour +45 minutes',strtotime($start)));}}</p>
          </span>
      </div>
      </a>
      @endforeach

  </div>
</div> 
  <div class="navbar-fixed">
    <nav class="grey lighten-5">
        <div class="nav-wrapper">
            <a href="{{url('/')}}" class="brand-logo hide-on-med-and-down" style="margin-left: 10px; margin-top: 5px;">
                <img src="{{asset('assets/images/Main-light-transparent.png')}}" height="40" alt="">
            </a>
            <a href="{{url('/')}}" class="brand-logo hide-on-large-only">
                <img src="{{asset('assets/images/short-transparent.png')}}" height="50" alt="">
            </a>
                  @php
                         $lastmsg = DB::table('chats')->where(['sid'=>$user[0]->id])->orwhere(['rid'=>$user[0]->id])->orderBy('id', 'desc')->first();
                         if($lastmsg==NULL){
                          $chatid = '0';
                         }
                         else{
                          if($lastmsg->sid == $user[0]->id)
                            {
                                $chatid = $lastmsg->rid;
                            }   
                            else{
                               $chatid = $lastmsg->sid;
                            }
                         }
                         
                    @endphp
            <a class="right hide-on-large-only" href="{{url('company/chatlist')}}" style="margin-right:10px;">
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
                    <a class="black-text" href="{{url('/contact')}}">Contact Us</a>
                </li>
                <li>
                  <a href="{{url('company/messages/'.$chatid)}}" class="btn-floating white">
                      <i class="material-icons" style="color: #0082cc">message</i>               
                  </a>
                </li>
                <li onclick="notif()">
                  <a href="#" class="btn-floating white">
                      @if($user[0]->unReadNotifications->count() > 0)
                      <i class="material-icons red-text">notifications_active</i>
                      @else
                      <i class="material-icons" style="color: #0082cc">notifications</i>               
                      @endif
                  </a>
                  <script>
                    const notificationDrop = document.querySelector('.notification-drop')
                
                    const notif = (e) => {
                        notificationDrop.classList.toggle('show')
                
                        if(!e.target.classList.contains('notification-drop')){
                            notificationDrop.classList.remove('show')
                        }
                    }
                </script>
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
                        <li><a href="{{url('company/savedcandidates')}}" class="black-text"><i class="material-icons theme-text">groups</i>Saved Candidates</a></li>
                        <li><a href="{{url('company/settings')}}" class="black-text"><i class="material-icons theme-text">settings</i>Account Settings</a></li>
                        <li><a href="{{url('company/logout')}}" class="black-text"><i class="material-icons theme-text">logout</i>Logout</a></li>
                      </ul>
                      <ul id='accountdrop2' class='dropdown-content'>
                        <li><a href="{{url('company/profile')}}" class="black-text"><i class="material-icons theme-text">account_circle</i>Profile</a></li>
                        <li><a href="{{url('company/jobsmanager')}}" class="black-text"><i class="material-icons theme-text">business_center</i>Jobs posted</a></li>
                        <li><a href="{{url('company/savedcandidates')}}" class="black-text"><i class="material-icons theme-text">groups</i>Saved Candidates</a></li>
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
        <a class="bottom-tab" href="{{url('company/savedcandidates')}}">
            <i class="material-icons">group</i>
            <p>Saved Candidates</p>
        </a>
        <a class="bottom-tab active" href="{{url('company/postajob')}}">
            <i class="material-icons">add_box</i>
            <p>Post Job</p>
        </a>
        <a class="bottom-tab" href="{{url('company/notif')}}">
          @if($user[0]->unReadNotifications->count() > 0)
          <i class="material-icons red-text">notifications_active</i>
          @else
          <i class="material-icons">notifications</i>               
          @endif
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
    @elseif(session()->has('CAND_LOGIN'))
    <div class="notification-drop">
      <div style="padding: 10px; font-weight: 600;">
          <span class="right btn-flat dropdown-trigger" data-target="dropdown1">
              <i class="material-icons">
                  more_vert
              </i>
          </span>
          <h6>Notifications</h6>
          <ul id='dropdown1' class='dropdown-content'>
              <li><a href="{{url('candidate/notifmar')}}" class="black-text"><i class="material-icons theme-text">visibility</i>Mark All as Read</a></li>
              <li><a href="{{url('candidate/notifdel')}}" class="black-text"><i class="material-icons red-text">delete</i>Clear Notifications</a></li>
            </ul>
      </div>
      <div class="notification-inner">
          @foreach ($user[0]->unReadNotifications as $notification)
          @php
              $cmpy = DB::table('companies')->where('id', $notification->data['cmpy'])->first();   
              $job = DB::table('jobs')->where('jobid', $notification->data['job'])->first();
          @endphp
          <a href="{{url('/candidate/notification/'.$notification->id.'/'.$notification->data['job'])}}">
          <div class="notification-item unread">
            @if ($cmpy->cmpydp == NULL)
            <img class="notif-img" src="{{asset('assets/pngs/company.png')}}">
            @else
            <img class="notif-img" src="{{asset('company/dp/'.$cmpy->cmpydp)}}">
            @endif
              <span class="notif-detail">
                  <h2  style="font-weight: 600;">{{$cmpy->cmpyname}}</h2>
                  <p>{{$notification->data['msg']}} <span style="font-weight: 600;">{{$job->title}}</span></p>
                  <p style="font-size: 10px; margin-top:2px;"><span class="hide">{{$start = $notification->created_at}}</span>
                      {{date('Y-m-d H:i',strtotime($start));}}</p>
              </span>
          </div>
          </a>
          @endforeach
          @foreach ($user[0]->ReadNotifications as $notification)
          @php
              $cmpy = DB::table('companies')->where('id', $notification->data['cmpy'])->first();   
              $job = DB::table('jobs')->where('jobid', $notification->data['job'])->first();   
          @endphp
          <a href="{{url('/candidate/job/'.$notification->data['job'])}}" class="black-text">
              <div class="notification-item">
                @if ($cmpy->cmpydp == NULL)
                <img class="notif-img" src="{{asset('assets/pngs/company.png')}}">
                @else
                <img class="notif-img" src="{{asset('company/dp/'.$cmpy->cmpydp)}}">
                @endif
                  <span class="notif-detail">
                      <h2  style="font-weight: 600;">{{$cmpy->cmpyname}}</h2>
                      <p>{{$notification->data['msg']}} <span style="font-weight: 600;">{{$job->title}}</span></p>
                      <p style="font-size: 10px; margin-top:2px;"><span class="hide">{{$start = $notification->created_at}}</span>
                          {{date('Y-m-d H:i',strtotime($start));}}</p>
                  </span>
              </div>
          </a>
          @endforeach
      </div>
  </div>
    <div class="navbar-fixed">
      <nav class="grey lighten-5">
          <div class="nav-wrapper">
              <a href="{{url('/')}}" class="brand-logo hide-on-med-and-down" style="margin-left: 10px; margin-top: 5px;">
                  <img src="{{asset('assets/images/Main-light-transparent.png')}}" height="40" alt="">
              </a>
              <a href="{{url('/')}}" class="brand-logo hide-on-large-only">
                  <img src="{{asset('assets/images/short-transparent.png')}}" height="50" alt="">
              </a>
              @php
                         $lastmsg = DB::table('chats')->where(['sid'=>$user[0]->id])->orwhere(['rid'=>$user[0]->id])->orderBy('id', 'desc')->first();
                         if($lastmsg==NULL){
                          $chatid = '0';
                         }
                         else{
                          if($lastmsg->sid == $user[0]->id)
                            {
                                $chatid = $lastmsg->rid;
                            }   
                            else{
                               $chatid = $lastmsg->sid;
                            }
                         }
                         
                    @endphp
              <a class="right hide-on-large-only" href="{{url('candidate/chatlist')}}" style="margin-right:10px;">
                  <i class="material-icons black-text">message</i>
              </a>
              <span class="hide-on-large-only">
                @if ($user[0]->canddp == NULL)
                <a href="#" data-target="mobile-demo" class="sidenav-trigger">
                    <i class="material-icons" style="color: #0082cc">account_circle</i>
               </a>
                @else
                <a href="#" data-target="mobile-demo" class="valign-wrapper sidenav-trigger">
                    <img height="40" style="border-radius: 50%" src="{{asset('candidate/dp/'.$user[0]->canddp)}}" alt="">
               </a>
                    
                @endif
                
            </span>
              <ul class="right hide-on-med-and-down">
                  <li>
                      <a class="black-text" href="{{url('/')}}">Home</a>
                  </li>
                  <li>
                      <a class="black-text" href="{{'/candidate/profile'}}">Dashboard</a>
                  </li>
                  <li>
                      <a class="black-text" href="{{url('/candidate/findjobs')}}">Find Jobs</a>
                  </li>
                  <li>
                      <a class="black-text" href="{{url('/contact')}}">Contact Us</a>
                  </li>
                  <li>
                    <a href="{{url('candidate/messages/'.$chatid)}}" class="btn-floating white">
                        <i class="material-icons" style="color: #0082cc">message</i>               
                    </a>
                  </li>
                  <li>
                      <a href="#" class="btn-floating white" onclick="notif()">
                        @if($user[0]->unReadNotifications->count() > 0)
                        <i class="material-icons red-text">notifications_active</i>
                        @else
                        <i class="material-icons" style="color: #0082cc">notifications</i>               
                        @endif
                      </a>
                      <script>
                        const notificationDrop = document.querySelector('.notification-drop')
                    
                        const notif = (e) => {
                            notificationDrop.classList.toggle('show')
                    
                            if(!e.target.classList.contains('notification-drop')){
                                notificationDrop.classList.remove('show')
                            }
                        }
                    </script>
                  </li>
                  <li>
                    <a href="#" data-target="accountdrop" class="btn-floating dropdown-trigger white">
                      @if ($user[0]->canddp == NULL)
                      <i class="material-icons" style="color: #0082cc">account_circle</i>
                      @else
                      <img height="40" src="{{asset('candidate/dp/'.$user[0]->canddp)}}" alt="">
                      @endif
                  </a>
                      <ul id='accountdrop' class='dropdown-content'>
                          <li><a href="{{url('/candidate/profile')}}" class="black-text"><i class="material-icons theme-text">account_circle</i>Profile</a></li>
                          <li><a href="{{url('candidate/appliedjobs')}}" class="black-text"><i class="material-icons theme-text">business_center</i>Jobs Applied</a></li>
                          <li><a href="{{url('/candidate/savedcompanies')}}" class="black-text"><i class="material-icons theme-text">groups</i>Saved Companies</a></li>
                          <li><a href="{{url('/candidate/settings')}}" class="black-text"><i class="material-icons theme-text">settings</i>Account Settings</a></li>
                          <li><a href="{{url('/candidate/logout')}}" class="black-text"><i class="material-icons theme-text">logout</i>Logout</a></li>
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
          <a class="bottom-tab" href="{{url('/candidate/savedcompanies')}}">
              <i class="material-icons">group</i>
              <p>Saved Companies</p>
          </a>
          <a class="bottom-tab" href="{{url('/candidate/findjobs')}}">
              <i class="material-icons">work</i>
              <p>Find Job</p>
          </a>
          <a class="bottom-tab" href="{{url('candidate/notif')}}">
            @if($user[0]->unReadNotifications->count() > 0)
            <i class="material-icons red-text">notifications_active</i>
            @else
            <i class="material-icons">notifications</i>               
            @endif
            <p>Notifications</p>
        </a>
          <a class="bottom-tab final-tab" href="{{url('candidate/appliedjobs')}}">
              <i class="material-icons">business_center</i>
              <p>Jobs Applied</p>
          </a>
      </aside>
  </div>
  
  <ul class="sidenav" id="mobile-demo">
      <div class="dashboard-tabs section-card">
          <a class="tab-menu" href="{{url('/candidate/profile')}}">
              <i class="material-icons">account_circle</i>
              <p class="menu-text">{{$user['0']->firstname}}</p>
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
          <a class="tab-menu" href="{{url('/candidate/logout')}}">
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
      url:"{{url('candidate/reactivate')}}",
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

  @else
      
  <header>
    <ul id='dropdown1' class='dropdown-content'>
      <li><a class="" href="{{url('registeremployer')}}">As a Employer</a></li>
      <li><a class="" href="{{url('registeremployee')}}">As a Employee</a></li>
    </ul>
    <ul id='dropdown2' class='dropdown-content'>
      <li><a class="" href="{{url('registeremployer')}}">As a Employer</a></li>
      <li><a class="" href="{{url('registeremployee')}}">As a Employee</a></li>
    </ul>
    <ul id='dropdown3' class='dropdown-content'>
      <li><a class="" href="{{url('registeremployer')}}">As a Employer</a></li>
      <li><a class="" href="{{url('registeremployee')}}">As a Employee</a></li>
    </ul>
    <div class="">
      <nav class="grey lighten-5">
          <div class="nav-wrapper">
            <a href="{{url('/')}}" class="brand-logo hide-on-med-and-down" style="margin-left: 10px; margin-top: 5px;"><img src="{{asset('assets/images/Main-light-transparent.png')}}" height="40" alt=""></a>
            <a href="{{url('/')}}" class="brand-logo hide-on-large-only"><img src="{{asset('assets/images/short-transparent.png')}}" height="50" alt=""></a>
            
            <ul class="right hide-on-large-only ">
              @if($usercu == 'admin')
              <li><a class="black-text right" style="margin-right:10px;" href="{{url('admin/logout')}}"><i class="material-icons">exit_to_app</i></a></li>
              @else
              <li><a class="btn-flat" href="{{url('login')}}"><span ><img src="{{asset('assets/pngs/login.png')}}" height="30" alt=""></span></a></li>
              {{-- <li><a class="right" style="margin-right:10px;" href="{{url('login')}}"><span><img src="{{asset('assets/pngs/login.png')}}" height="25" alt=""></span></a></li> --}}
              @endif
            </ul>
             
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons black-text">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li><a class="black-text" href="{{url('/findjobs')}}">Find Internships / Freshers Jobs</a></li>
              <li><a class="black-text" href="{{url('/contact')}}">Contact Us</a></li>
              @if($usercu == 'admin')
              <li><a class="btn-small theme-text white loginbtn" href="{{url('admin/logout')}}"><i class="material-icons">exit_to_app</i></a></li>
              @else
              <li><a class="btn-small theme-text white loginbtn" href="{{url('login')}}">Login</a></li>
              <li><a class="white-text btn-small waves-effect theme dropdown-trigger" style="border-radius: 20px;" data-target="dropdown1">register<i class="material-icons right">expand_more</i></a></li>
              @endif
            </ul>
          </div>
        </nav>
    </div>
  
    <ul class="sidenav" id="mobile-demo">
      <li><a class="black-text" href="{{url('/findjobs')}}">Find Internships / Freshers Jobs</a></li>
      <li><a class="black-text" href="{{url('/contact')}}">Contact Us</a></li>
      <li><div class="divider"></div></li>
      <li><a class="black-text" href="{{url('registeremployer')}}">Register as a Employer</a></li>
      <li><a class="black-text" href="{{url('registeremployee')}}">Register as A Employee</a></li>
      <li><div class="divider"></div></li>
      <li><a class="black-text" href="{{url('login')}}">Login</a></li>
      <li><div class="divider"></div></li>
    </ul>
  </header>
  <main>
    @yield('main')
</main>
  @endif

</div>
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
                  <li><a class="grey-text text-lighten-3" href="{{url('/about')}}">About Us</a></li>
                  <li><a class="grey-text text-lighten-3" href="{{url('/guide')}}">User Guide</a></li>
                  {{-- <li><a class="grey-text text-lighten-3" href="#!">Our services</a></li> --}}
                  <li><a class="grey-text text-lighten-3" href="{{url('/termsandconditions')}}">Terms & Conditions</a></li>
                  <li><a class="grey-text text-lighten-3" href="{{url('/privacy')}}">Privacy</a></li>
                  <li><a class="grey-text text-lighten-3" href="{{url('/contact')}}">Contact us</a></li>
                </ul>
              </div>
          </div>
        </div>
        <div class="footer-copyright">
          <div class="container">
          © 2021 Copyright InternWheel
          <a class="grey-text text-lighten-4 right" href="#!" id="install"><span class="white black-text btn" style="border-radius: 20px;">Install App</span></a>
          </div>
        </div>
      </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="{{asset('assets/script.js')}}"></script>
    <script src="{{asset('assets/dashboard.js')}}"></script>
    <script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
<script>
  // document.addEventListener('contextmenu', event => event.preventDefault());
  
 let deferredPrompt;
const addBtn = document.querySelector('#install');
// const card = document.querySelector('#flash');
addBtn.style.display = 'none';
// card.style.display = 'none';

window.addEventListener('beforeinstallprompt', (e) => {
// Prevent Chrome 67 and earlier from automatically showing the prompt
e.preventDefault();
// Stash the event so it can be triggered later.
deferredPrompt = e;
// Update UI to notify the user they can add to home screen
addBtn.style.display = 'block';
// card.style.display = 'block';

addBtn.addEventListener('click', (e) => {
 // hide our user interface that shows our A2HS button
 addBtn.style.display = 'none';
// card.style.display = 'none';
 // Show the prompt
 deferredPrompt.prompt();
 // Wait for the user to respond to the prompt
 deferredPrompt.userChoice.then((choiceResult) => {
     if (choiceResult.outcome === 'accepted') {
       console.log('User accepted the A2HS prompt');
     } else {
       console.log('User dismissed the A2HS prompt');
     }
     deferredPrompt = null;
   });
});
});
</script>
</body>
</html>