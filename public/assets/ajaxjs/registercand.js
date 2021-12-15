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

$('#regemployee').submit(function(e){
    e.preventDefault();
    $('#regemployee').toggle();
    $('#emailmsg').text('Please Wait!')
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
    let formData = new FormData($('#regemployee')[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:"/addemployee",
        data:formData,
        contentType: false,
        processData: false,
        type:'POST',
        success:function(response){
            $('#loader').remove();
            $('#emailmsg').text('Please check Your email for verification, check the spam folder incase you do not find the mail')
            M.toast({html: 'You have been Registered!'})
        },
        error:function (response) {
              $('#loader').remove();
              $('#regemployee').toggle();
              $('#emailmsg').text('Register as employee')
              if(response.responseJSON.errors.username){
                var unerr = response.responseJSON.errors.username;  
                M.toast({html: unerr})
              }
              if(response.responseJSON.errors.email){
                var emerr = response.responseJSON.errors.email;  
                M.toast({html: emerr})
              }
              if(response.responseJSON.errors.phonenumber){
                var emerr = response.responseJSON.errors.phonenumber;  
                M.toast({html: emerr})
              }
            }
    })
})