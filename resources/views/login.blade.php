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
    </form>
   <div class="row center">
      <span class="red-text" style="font-size: 20px;">{{session('error')}}</span> <br>
       <span>
           <a href="">Forgot password?</a>
       </span>
       <br>
       <span>
          Dont have an accont?<a href="#dropdown3" class="dropdown-trigger"> Register Now!</a>
       </span>
    
</div>
   
@endsection