@extends('layout')
@section('main')
<div style="padding: 20px; margin-top: 10vh; border-radius:10px;" class="white container z-depth-1">
    <div class="center">
        <div style="width: 35vw;" class="container center">
            <img src="./assets/images/iwmain.png" height="90" class="responsive-img" alt="">
        </div>
    </div>
      <h4 class="center-align">Register as a Employer</h4>
      <form action="" class="row container">
          <div class="input-field col s12 m6">
              <input placeholder="First Name" id="first_name" type="text" class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input placeholder="Last Name" type="text" required class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input placeholder="Company Name" type="text" required class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input id="email" type="email" placeholder="Email" required class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input type="number" placeholder="Phone Number" required class="validate">
            </div>
            <div class="input-field col s12 m6">
              <input placeholder="Make a user name" type="text" required class="validate">
            </div>
            <div class="input-field col s12 m6">
                <input placeholder="Enter Your PAN/VAT Number" required type="text" class="validate">
              </div>
              <div class="file-field col s12 m6 input-field">
                <div class="btn theme">
                  <span>File</span>
                  <input type="file" required>
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" required placeholder="PAN Certificate Verification">
                </div>
              </div>
                <div class='input-field col s12'>
                  <input class='validate' type='password' required placeholder="Password" name='password' id='password' />
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
                    <input required type="checkbox" />
                    <span>Agree to our <a href="">Terms and Conditions</a> and <a href="">Privary Policy</a></span>
                  </label>
            </div>
            <div class="col s12 center" style="margin-top: 10vh;">
              <button type="submit" id="subbtn" class="disabled modal-close waves-effect waves-green btn-large theme">Register</button>
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
<script>
    var clicked = 0;

$(".toggle-password").click(function (e) {
   e.preventDefault();

  $(this).toggleClass("toggle-password");
    if (clicked == 0) {
      $(this).html('<span class="material-icons">visibility_off</span >');
       clicked = 1;
    } else {
       $(this).html('<span class="material-icons">visibility</span >');
        clicked = 0;
     }

  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
     input.attr("type", "text");
  } else {
     input.attr("type", "password");
  }
});

function passwordcheck(){
    $('#pwmsg').html("")
   var cp = $('#confirm-password').val()
   var p = $('#password').val();

   if(cp == p){
       console.log('password matching')
    $('#pwmsg').html("")
    $('#subbtn').removeClass('disabled')
   }
   else{
    $('#pwmsg').html("<span class='red-text'>Password Dont Match!</span>")
    $('#subbtn').addClass('disabled')
       console.log('passwords do not match')
   }
}
</script>
@endsection