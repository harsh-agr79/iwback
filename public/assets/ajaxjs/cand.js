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
    $('#editexperience').click(function(){
        $('#editexp').toggle();
        $('#saveexp').toggle();
        $('.exptxt').toggle();
        $('.expinp').toggle();
    })
    $('#editcontact').click(function(){
        $('#editcon').toggle();
        $('#savecon').toggle();
        $('#webtxt').toggle();
        $('#webinp').toggle();
        $('#adrstxt').toggle();
        $('#adrsinp').toggle();
    })
    
        function addeducation(){
            var sinp = $('#eduaddtab').clone()
            var sinp2 = sinp.css('display','block');
            sinp2.appendTo("#edu-list")
        }
        function addexp(){
            var sinp = $('#addexptab').clone()
            var sinp2 = sinp.css('display','block');
            sinp2.appendTo("#exp-list")
        }
        function tasubmit(){
            $('#taform').submit();
        }
        function skillsubmit(){
            $('#skillform').submit();
        }
        function edusubmit(){
            $('#eduform').submit();
        }
        function expsubmit(){
            $('#expform').submit();
        }function contsubmit(){
            $('#contform').submit();
        }
    $(document).ready(function(){
        $('.modal').modal();
        fetchcand();
        function fetchcand(){
          $.ajax({
              type:"GET",
              url:"/candidateget",
              dataType:"json",
              success:function(response){
                  console.log(response.candidate.firstname)
                  var a = response.candidate.canddp
                    // console.log(a);
                    var b = "dp/"
                    var c = ""
                    var d = b + a +c
                  $('#cppic').css('background-image', 'url("/candidate/cp/' + response.candidate.candcp + '")');
                  $('#oldimg').val(response.candidate.candcp);
                  $('#profilepic').attr('src', d);
                  $('#olddp').val(response.candidate.canddp);
                  $('#titletxt').html(response.candidate.title);
                  $('#titleval').val(response.candidate.title);
                  $('#abouttxt').text(response.candidate.about);
                  $('#aboutinp').val(response.candidate.about);
                  $('#webtxt').text(response.candidate.portfoliowebsite);
                  $("#webtxt").attr("href", "https://"+response.candidate.portfoliowebsite)
                  $('#webinp').val(response.candidate.portfoliowebsite);
                  $('#adrstxt').text(response.candidate.address);
                  $('#adrsinp').val(response.candidate.address);
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
            $('#contform').submit(function(e){
                e.preventDefault();
                let formData = new FormData($('#contform')[0]);
                $.ajax({
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   url:"/candidate/contedit",
                   data:formData,
                   contentType: false,
                   processData: false,
                   type:'POST',
                   success:function(response){
                       $('#contform')['0'].reset();
                       fetchcand();
                       M.toast({html: 'Contact Details Updated!'})
                   }
                })
           });
           $('#upcp').submit(function(e){
            e.preventDefault();
            let formData = new FormData($('#upcp')[0]);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"/candidate/updatecp",
                data: formData,
                contentType: false,
                processData: false,
                type:'POST',
                success:function(result){
                    fetchcand();
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
                    url:"/candidate/updatedp",
                    data: formData,
                    contentType: false,
                    processData: false,
                    type:'POST',
                    success:function(result){
                        fetchcand();
                        $('#updp')[0].reset();
                        M.toast({html: 'Profile Pic Updated!'})
                    }
                })
                });
    })