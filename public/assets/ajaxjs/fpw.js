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
                    url:"/forgotpassword/mail",
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
                        url:"/forgotpassword/verifycode",
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
                        url:"/forgotpassword/newpassword",
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