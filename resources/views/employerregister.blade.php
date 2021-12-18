@extends('layout')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main')
<div style="padding: 20px; margin-top: 10vh; border-radius:10px;" class="white container z-depth-1">
    <div class="center">
        <div style="width: 35vw;" class="container center">
            <img src="./assets/images/Main-light-transparent.png" height="90" class="responsive-img" alt="">
        </div>
    </div>
    
      <h4 class="center-align" id="emailmsg">Register as a Employer</h4>
      <div id="loadercont" class="center">
      
      </div>
      <form id="regemployer" enctype="multipart/form-data" method="POST" class="row container">
          @csrf
          <div class="input-field col s12 m6">
              <input placeholder="First Name" name="firstname" id="first_name" type="text" class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input placeholder="Last Name" type="text" name="lastname" required class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input placeholder="Company Name" type="text" name="cmpyname" required class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input id="email" type="email" placeholder="Email" name="email" required class="validate">
            </div>
            {{-- @error('email')
            <div class="red-text">{{$message}}</div>
            @enderror --}}
            <div class="input-field col s12 m6">
              <input type="number" placeholder="Phone Number" name="phonenumber" required class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input placeholder="Make a user name" name="username" type="text" required class="validate">
            </div>
            {{-- @error('username')
            <div class="red-text">{{$message}}</div>
            @enderror --}}
            <div class="input-field col s12 m6">
                <input placeholder="Enter Your PAN/VAT Number" name="pannumber" required type="text" class="validate">
              </div>
              <div class="file-field col s12 m6 input-field">
                <div class="btn theme">
                  <span>File</span>
                  <input type="file" name="pancertificate" required>
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" required placeholder="PAN Certificate Verification">
                </div>
              </div>
              {{-- @error('pancertificate')
              <div class="red-text">{{$message}}</div>
              @enderror --}}
                <div class='input-field col s12'>
                  <input class='validate' type='password' name="password" required placeholder="Password" name='password' id='password' />
                  <span toggle="#password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>
                 </div>
            
                <div class='input-field col s12'>
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
<script src="{{asset('assets/ajaxjs/registercmp.js')}}">
    
</script>
@endsection