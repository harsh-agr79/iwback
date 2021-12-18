@extends('layout')
@section('main')
<div style="padding: 20px;margin-top: 10vh; border-radius:10px;" class="white container z-depth-1">
    <div class="center">
        <div style="width: 35vw;" class="container center">
            <img src="./assets/images/iwmain.png" height="90" class="responsive-img" alt="">
        </div>
    </div>
    <h4 class="center-align" style="margin-top: 4vh;">Log In</h4>
<form action="{{route('auth')}}" method="post" class="row container">
  @csrf
      <div class="input-field col s12">
        <input id="email" type="text" name="user" placeholder="Email or Username" class="validate">
      </div>
      <div class="input-field col s12">
        <input id="password" type="password" name="password" placeholder="password" class="validate">
      </div>
      
      <div class="col s12 center">
        <button class="modal-close waves-effect waves-green btn-large theme">Log In</button>
      </div>
      <span class="red-text" style="font-size: 20px;">{{session('error')}}</span> <br>
      <div class="col s12 center-align" style="margin-top: 20px; font-size:20px;">
        Are you a candidate?
      </div>
      <div class="col s12" style="display: flex; justify-content:center; margin-top:5px;">
        <div class="z-depth-1" style="border-radius:5px;">
            <a href="{{url('google')}}">
                <div style="display: flex; align-item:center; justify-content:center; padding:5px; margin:5px; ">
                    <span style="font-size: 15px;" class="theme-text">Continue with google</span>
                    <img style="margin-left: 5px;" src="{{asset('assets/svgs/google.svg')}}" height="20" alt="">
                </div>
            </a>
        </div>   
  </div>
    </form>
   <div class="row center">
       <span>
           <a href="{{url('forgotpassword')}}">Forgot password?</a>
       </span>
       <br>
       <span>
          Dont have an accont?<a href="#dropdown3" class="dropdown-trigger"> Register Now!</a>
       </span>
    
</div>
   
@endsection