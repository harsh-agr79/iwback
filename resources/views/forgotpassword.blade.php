@extends('layout')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main')
<div style="padding: 20px;margin-top: 10vh; border-radius:10px;" class="white container z-depth-1">
    <div class="center">
        <div style="width: 35vw;" class="container center">
            <img src="./assets/images/iwmain.png" height="90" class="responsive-img" alt="">
        </div>
    </div>
    <h4 class="center-align" style="margin-top: 4vh;">Forgot Password</h4>
    <div id="loadercont" class="center"></div>
    <div class="center" id="emailmsg"></div>
<form action="" id="forgotpassword" enctype="multipart/form-data" method="post" class="row container">
  @csrf
  <div class="center-align"><h5>Enter your email address</h5></div>
      <div class="input-field col s12">
        <input id="email" type="email" name="email" placeholder="Email" class="validate">
      </div>      
      <div class="col s12 center">
        <button class="modal-close waves-effect waves-green btn-large theme">Send Email</button>
      </div>
    {{-- <p class="center-align">We will send you a email please check your email for verification code</p> --}}
    </form>



    <form action="" style="display: none;" id="codeverification" enctype="multipart/form-data" method="post" class="row container">
      @csrf
      <div class="center-align"><h5>Enter The verification code</h5></div>
          <div class="input-field col s12">
            <input id="emailvc" type="hidden" name="email" class="validate">
            <input type="text" id="vfcode" name="vfcode" placeholder="Verification Code" class="validate">
          </div>      
          <div class="col s12 center">
            <button class="modal-close waves-effect waves-green btn-large theme">Verify</button>
          </div>
    </form>

   <form action="" style="display: none;" id="newpassword" enctype="multipart/form-data" method="post" class="row container">
     @csrf
     <div class="center-align"><h5>Enter New Password</h5></div>
         <div class="input-field col s12">
           <div class='input-field col s12'>
            <input id="emailnp" type="hidden" name="email" class="validate">
            <input id="vcnp" type="hidden" name="verifycode" class="validate">
             <input class='validate' type='password' name="password" required placeholder="Password" name='password' id='password' />
             <span toggle="#password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>
            </div>
       
           <div class='input-field col s12'>
             <input class='validate' onkeyup="passwordcheck()" type='password' required placeholder="Confirm Password" name='confirm-password' id='confirm-password' />
             <span toggle="#confirm-password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>
           </div>
       <div id="pwmsg">
       </div>
         </div>      
         <div class="col s12 center">
           <button class="modal-close waves-effect waves-green btn-large theme">Update password</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

              $(document).ready(function(){
                        $('#forgotpassword').submit(function(e){
                        var pwd = $('#email').val();
                        e.preventDefault();
                        $('#forgotpassword').toggle();
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
                    let formData = new FormData($('#forgotpassword')[0]);
                    $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"{{url('forgotpassword/mail')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    type:'POST',
                    success:function(result){
                        M.toast({html: result.pw})
                        if(result.pw === 'Check Your email for verification code'){
                            $('#loader').remove();
                            $('#codeverification').toggle();
                            $('#emailmsg').text('Please check Your email for the verification code, check the spam folder incase you do not find the mail')
                            $('#emailvc').val(pwd);
                        }
                        else if(result.pw === 'Invalid Email ID'){
                            $('#loader').remove();
                            $('#forgotpassword').toggle();
                            $('#emailmsg').text('The Email was invalid please try again')
                        }
                    }
                    })
                });
                $('#codeverification').submit(function(e){
                        e.preventDefault();
                        var evc = $('#emailvc').val();
                        var vfc = $('#vfcode').val();
                        let formData = new FormData($('#codeverification')[0]);
                        $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url:"{{url('forgotpassword/verifycode')}}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        type:'POST',
                        success:function(result){
                        M.toast({html: result.pw})
                        if(result.pw === 'The code has been verified'){
                            $('#codeverification').toggle();
                            $('#emailnp').val(evc);
                            $('#vcnp').val(vfc);
                            $('#newpassword').toggle();
                            $('#emailmsg').text('Enter Your New Password')
                        }
                        else if(result.pw === 'Invalid Code'){
                            $('#emailmsg').text('The code was invalid please try again')
                        }
                    }
                    })
                });
                $('#newpassword').submit(function(e){
                        e.preventDefault();
                        let formData = new FormData($('#newpassword')[0]);
                        $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url:"{{url('forgotpassword/newpassword')}}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        type:'POST',
                        success:function(result){
                        M.toast({html: result.pw})
                        if(result.pw === 'The password has been changed'){
                            $('#newpassword').toggle();
                            $('#emailmsg').text('Your password has been changed, You can login into your account with new password')
                        }
                        else if(result.pw === 'Invalid Password'){
                            $('#emailmsg').text('The password was not updated, please try again')
                        }
                    }
                    })
                });
              });
        </script>
        </div>
@endsection