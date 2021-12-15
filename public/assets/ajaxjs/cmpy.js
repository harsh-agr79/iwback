function mainlocation(){
    $('#ml').toggle();
    $('#mlinp').toggle();
    $('#mledi').toggle();
    $('#mlsli').toggle();
    $('#abo').toggle();
    $('#aboinp').toggle(); 
    $('#ove').toggle();
    $('#oveinp').toggle();
    $('#web').toggle();
    $('#webinp').toggle();
    $('#siz').toggle();
    $('#sizinp').toggle();
    $('#est').toggle();
    $('#estinp').toggle();
}
function submit(){
    $('#profileform').submit();
}
$(document).ready(function(){
$('.tooltipped').tooltip();
fetchcmpy();
function fetchcmpy(){
      $.ajax({
          type:"GET",
          url:"/companyget",
          dataType:"json",
          success:function(response){
            // console.log(response)
            var a = response.company[0].cmpydp
            // console.log(a);
            var b = "dp/"
            var c = ""
            var d = b + a +c
            // console.log(d);
            $('#cppic').css('background-image', 'url("/company/cp/' + response.company[0].cmpycp + '")');
            $('#profilepic').attr('src', d)
            $('#oldimg').val(response.company[0].cmpycp)
            $('#olddp').val(response.company[0].cmpydp)
            $('#ml').text(response.company[0].mainlocation);
            $('#ml2').text(response.company[0].mainlocation);
            $('#mlinp').val(response.company[0].mainlocation);
            $('#abo').html(response.company[0].about);
            $('#aboinp').val(response.company[0].about);
            $('#ove').text(response.company[0].overview);
            $('#oveinp').val(response.company[0].overview);
            $('#web').text(response.company[0].website);
            $("#web").attr("href", "https://"+response.company[0].website)
            $('#webinp').val(response.company[0].website);
            $('#siz').text(response.company[0].cmpysize);
            $('#sizinp').val(response.company[0].cmpysize);
            $('#est').text(response.company[0].cmpyestd);
            $('#estinp').val(response.company[0].cmpyestd);

          }
      })
  }
$('.tooltipped').tooltip();

$('#profileform').submit(function(e){
e.preventDefault();
let formData = new FormData($('#profileform')[0]);
$.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url:"/company/update",
    data: formData,
    contentType: false,
    processData: false,
    type:'POST',
    success:function(result){
        fetchcmpy();
        M.toast({html: 'Profile Updated!'})
    }
})
});
$('#upcp').submit(function(e){
e.preventDefault();
let formData = new FormData($('#upcp')[0]);
$.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url:"/company/updatecp",
    data: formData,
    contentType: false,
    processData: false,
    type:'POST',
    success:function(result){
        fetchcmpy();
        $('#upcp')[0].reset();
        M.toast({html: 'Cover Pic Updated!'})
    }
})
});
$('#updp').submit(function(e){
e.preventDefault();
let formData = new FormData($('#updp')[0]);
$.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url:"/company/updatedp",
    data: formData,
    contentType: false,
    processData: false,
    type:'POST',
    success:function(result){
        fetchcmpy();
        $('#updp')[0].reset();
        M.toast({html: 'Profile Pic Updated!'})
    }
})
});




});