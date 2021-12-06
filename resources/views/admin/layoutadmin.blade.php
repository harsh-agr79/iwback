<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/sastyle.css')}}">
    <link rel="icon" href="{{asset('assets/images/title.png')}}">
    <title>Super Admin</title>
</head>
<body>
    <header>
        <nav class="white">
            <div class="nav-wrapper">
              <a href="#!" class="brand-logo hide-on-med-and-down"><img src="../assets/images/iw.png" height="60" style="margin-left: 20px;" alt=""></a>
              <a href="#!" class="brand-logo hide-on-large-only"><img src="../assets/images/iw.png" height="60" alt=""></a>
              <a href="#" data-target="slide-out" class="sidenav-trigger left"><i class="material-icons black-text">menu</i></a>
              <ul class="right hide-on-med-and-down">
                <li><a class="black-text" href=""><i class="material-icons">notifications</i></a></li>
                <li><a class="black-text" href="{{url('admin/logout')}}"><i class="material-icons">exit_to_app</i></a></li>
                <li></li>
              </ul>
            </div>
          </nav>
    </header>
    <ul id="slide-out" class="theme sidenav sidenav-fixed">
        <li><a href="#!" class="white-text">Super Admin</a></li>
        <li><a href="" class="white-text">DashBoard</a></li>
        <li><a href="{{url('admin/company')}}" class="white-text">Companies</a></li>
        <li><a href="#!" class="white-text">Employees</a></li>
        @if($user['0']->username == 'harshagr')
        <li><a href="{{url('admin/sectors')}}" class="white-text">Sector</a></li>
        <li><a href="{{url('admin/admins')}}" class="white-text">Admins</a></li>
        <li><a href="{{url('admin/skills')}}" class="white-text">Skills</a></li>
        <li><a href="{{url('admin/edithome')}}" class="white-text">Edit Home page</a></li>
        @endif
        <li><a href="#!" class="white-text">Contact Messages</a></li>
      </ul>
        <main>
            @yield('main')
        </main>
      {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      <script src="{{asset('assets/sascript.js')}}"></script>
</body>
</html>