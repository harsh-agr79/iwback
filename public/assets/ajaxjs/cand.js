    $('#taedit').click(function(){
        $('#taeditico').toggle();
        $('#tasaveico').toggle();
       $('#titletxt').toggle();
       $('#titleinp').toggle();
       $('#abouttxt').toggle();
       $('#aboutinp').toggle();
    })
    $('#editskill').click(function(){
        $('#skilled').toggle();
        $('#skillsv').toggle();
        $('.skilltxt').toggle();
        $('.skillinp').toggle();
    })
    $('#editeducation').click(function(){
        $('#editedu').toggle();
        $('#saveedu').toggle();
        $('.edutxt').toggle();
        $('.eduinp').toggle();
    })
    
        function addeducation(){
            var sinp = $('#eduaddtab').clone()
            var sinp2 = sinp.css('display','block');
            sinp2.appendTo("#edu-list")
        }
        function tasubmit(){
            $('#taform').submit();
        }
        function skillsubmit(){
            $('#skillform').submit();
        }function edusubmit(){
            $('#eduform').submit();
        }
    $(document).ready(function(){
        fetchcand();
        function fetchcand(){
          $.ajax({
              type:"GET",
              url:"/candidateget",
              dataType:"json",
              success:function(response){
                  console.log(response.candidate.firstname)
                  $('#titletxt').html(response.candidate.title);
                  $('#titleval').val(response.candidate.title);
                  $('#abouttxt').text(response.candidate.about);
                  $('#aboutinp').val(response.candidate.about);
              }
          })
      }
      skillget()
      function skillget(){
                $.ajax({
              type:'get',
              url:'/findskill',
              success:function(response){

                // console.log(response)
                var custarray = response;
                var datacust = {};
                for(var i=0; i< custarray.length; i++){

                  datacust[custarray[i].skill] =null;
                }
                console.log(datacust)
                $('input.skls').autocomplete({
                  data: datacust,
                });
              }
            })
           }
           $('#askl').click(function(){
             var sinp = $('#addskilltab').clone()
                var sinp2 = sinp.removeClass('hide')
                sinp2.appendTo("#skills-list")
                skillget();
            })
        $('#taform').submit(function(e){
                 e.preventDefault();
                 let formData = new FormData($('#taform')[0]);
                 $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"/candidate/taedit",
                    data:formData,
                    contentType: false,
                    processData: false,
                    type:'POST',
                    success:function(response){
                        $('#taform')['0'].reset();
                        fetchcand();
                        M.toast({html: 'Title and About Updated!'})
                    }
                 })
            });
    })