@extends('layout')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main')
<div style="padding: 20px; margin-top: 10vh; border-radius:10px;" class="white container z-depth-1">
    <div class="center">
        <div style="width: 35vw;" class="container center">
            <img src="./assets/images/Main-light-transparent.png" height="90" class="responsive-img" alt="">
        </div>
    </div>
    
      <h4 class="center-align" id="emailmsg">Register as a Employee</h4>
      <div id="loadercont" class="center">
      
      </div>
      <form id="regemployee" enctype="multipart/form-data" class="row container">
          @csrf
          <div class="input-field col s12 m6">
              <input placeholder="First Name" name="firstname" id="first_name" type="text" class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input placeholder="Last Name" type="text" name="lastname" required class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input id="email" type="email" placeholder="Email" name="email" required class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input type="number" placeholder="Phone Number" name="phonenumber" required class="validate">
            </div>
            <div class="input-field col s12">
              <input placeholder="Make a user name" name="username" type="text" required class="validate">
            </div>
      
                <div class='input-field col s12 m6'>
                  <input class='validate' type='password' name="password" required placeholder="Password" name='password' id='password' />
                  <span toggle="#password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>
                 </div>
            
                <div class='input-field col s12 m6'>
                  <input class='validate' onkeyup="passwordcheck()" type='password' required placeholder="Confirm Password" name='confirm-password' id='confirm-password' />
                  <span toggle="#confirm-password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>
                </div>
            <div id="pwmsg">

            </div>
            <div class="col s12">
                <label>
                    <input required type="checkbox" id="agreebox" name="agree"/>
                    <span>Agree to our <a href="">Terms and Conditions</a> and <a href="">Privary Policy</a></span>
                  </label>
            </div>
            <div class="col s12 center" style="margin-top: 10vh;">
              <button type="submit" onclick="M.toast({html: 'Please wait!'})" id="subbtn" class="disabled modal-close waves-effect waves-green btn-large theme">Register</button>
            </div>
            <div class="col s12" style="display: flex; justify-content:center; margin-top:20px;">
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
  

</div>
<style>
    span.field-icon {
    float: right;
    position: absolute;
    right: 10px;
    top: 10px;
    cursor: pointer;
    z-index: 2;
}
</style>
<script src="{{asset('assets/ajaxjs/registercand.js')}}">
   
</script>
@endsection