@extends('admin/layoutadmin')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main')

    
    <div class="container">
        <div class="red-text center-align" style="font-size: 15px;" id="usernameerror"></div>
        <div class="red-text center-align" style="font-size: 15px;" id="emailerror"></div>
        <span class="center-align"><h4>Skills List</h4></span>
        <div class="center"><a href="#add" class="theme btn waves-effect modal-trigger">ADD <i class="material-icons right">add</i></a></div>
        <div id="add" class="modal">
            <div class="modal-content">
              <h4>Add a Skill</h4>
              <form id="addskillform" class="row">
                  @csrf
                  <div class="col s12">
                    <input type="text" name="skill" placeholder="Skill" required>
                  </div>
                  <div class="input-filed col s12">
                    <select name="type" required>
                        <option value="" disabled selected>Type of Skill</option>
                        <option value="interpersonal">Interpersonal</option>
                        <option value="technical">Technical</option>
                      </select>
                  </div>
                  <div class="center col s12" style="margin-top:5vh;">
                    <button class="btn theme waves-effect modal-close" id="addbtn" type="submit">Submit<i class="material-icons right">send</i></button>
                  </div>
              </form>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        <div style="overflow-x: scroll">
            <table>
                <thead>
                    <tr>
                        <td>S.N</td>
                        <td>Skill</td>
                        <td>Type</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        
    </div>

    <div class="editmodal">
        <div id="editskillmodal" class="modal">
            <div class="modal-content">
              <h4>Edit admin</h4>
              <form id="editskillform" method="POST" class="row">
                  @csrf
                  <input type="hidden" id="editid" name="id">
                  <div class="col s12">
                    <input type="text" id="editskill" name="skill" placeholder="Skill" required>
                  </div>
                  <div class="input-filed col s12">
                    <select id="edittype" name="type" required>
                        <option value="" disabled selected>Change only if you want to edit</option>
                        <option value="interpersonal">Interpersonal</option>
                        <option value="technical">Technical</option>
                      </select>
                  </div>
                  <div class="center col s12" style="margin-top:5vh;">
                    <button class="btn theme waves-effect modal-close" id="upbtn" type="submit">Update<i class="material-icons right">send</i></button>
                  </div>
              </form>
            </div>
            <div class="modal-footer">

            </div>
          </div>
    </div>
    <div class="deletemodal">
        <div id="deleteskillmodal" class="modal">
            <div class="modal-content">
              <h4>Are ypu sure you want to delete <span id="deleteskill"></span> from Skills?</h4>
              <form id="deleteform" class="row">
                  @csrf
                  <input type="hidden" id="deleteid" name="id">
                  <div class="center col s12" style="margin-top:5vh;">
                    <button class="btn red waves-effect modal-close" id="delbtn" type="submit">delete<i class="material-icons right">delete</i></button>
                  </div>
              </form>
            </div>
            <div class="modal-footer">

            </div>
          </div>
    </div>
    <script>
     
    $(document).ready(function(){

        fetchskill();
          function fetchskill(){
              $.ajax({
                  type:"GET",
                  url:"/skillget",
                  dataType:"json",
                  success:function(response){
                      $('tbody').html("");
                      $.each(response.skills, function(key, item){
                        $('tbody').append(
                            '<tr>\
                                <td>'+item.id+'</td>\
                                <td>'+item.skill+'</td>\
                                <td>'+item.type+'</td>\
                                <td><button value="'+item.id+'" class="btn-small waves-effect theme editbtn"  style="border-radius: 20px;"><i class="material-icons small">edit</i></button></td>\
                                <td><button value="'+item.id+'" class="btn-small deletebtn waves-effect red"  style="border-radius: 20px;"><i class="material-icons small">delete</i></button></td>\
                            </tr>'
                        );
                      });
                  }
              })
          }

          $(document).on('click', '.editbtn', function(e){
              e.preventDefault();
                var skill_id = $(this).val();
                $('#editskillmodal').modal('open');
                $.ajax({
                    type:"GET",
                    url:"/editskill/"+skill_id,
                    dataType:"json",
                    success:function(response){
                        console.log(response)
                        $('#editskill').val(response.skill.skill);
                        $('#edittype').val(response.skill.type);
                        $('#editid').val(response.skill.id);
                    }
                })
          })
          $(document).on('click', '.deletebtn', function(e){
              e.preventDefault();
                var skill_id = $(this).val();
                $('#deleteskillmodal').modal('open');
                $.ajax({
                    type:"GET",
                    url:"/editskill/"+skill_id,
                    dataType:"json",
                    success:function(response){
                        // console.log(response)
                        $('#deleteid').val(response.skill.id);
                        $('#deleteskill').html(response.skill.skill);
                    }
                })
          })


        $('#addskillform').submit(function(e){
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('skilladd')}}",
            data:$('#addskillform').serialize(),
            type:'post',
            success:function(response){
                $('#addskillform')['0'].reset();
                fetchskill();
                M.toast({html: 'Skill Added!'})
            },
            error:function (response) {
              if(response.responseJSON.errors.skill){
                var unerr = response.responseJSON.errors.skill;  
                M.toast({html: unerr})
              }
            }
        })
      });
      $('#editskillform').submit(function(e){
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('skillupdate')}}",
            data:$('#editskillform').serialize(),
            type:'post',
            success:function(result){
                fetchskill();
                M.toast({html: 'Skill Updated!'})
            }
        })
      });
      $('#deleteform').submit(function(e){
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('deleteskill')}}",
            data:$('#deleteform').serialize(),
            type:'post',
            success:function(result){
                fetchskill();
                M.toast({html: 'Skill Deleted!'})
            }
        })
      });
    })
    </script>
@endsection