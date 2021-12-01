@extends('admin/layoutadmin')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main')

    
    <div class="container">
        <div class="red-text center-align" style="font-size: 15px;" id="usernameerror"></div>
        <div class="red-text center-align" style="font-size: 15px;" id="emailerror"></div>
        <span class="center-align"><h4>Admins List</h4></span>
        <div class="center"><a href="#add" class="theme btn waves-effect modal-trigger">ADD <i class="material-icons right">add</i></a></div>
        <div id="add" class="modal">
            <div class="modal-content">
              <h4>Add a admin</h4>
              <form id="addform" class="row">
                  @csrf
                  <div class="col s12 m6">
                    <input type="text" name="name" placeholder="Name" required>
                  </div>
                  <div class="col s12 m6">
                    <input type="text" name="username" placeholder="username" required>
                  </div>
                  <div class="col s12 m6">
                    <input type="text" name="email" placeholder="email" required>
                  </div>
                  <div class="input-filed col s12 m6">
                    <select name="role" required>
                        <option value="" disabled selected>Role</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                      </select>
                  </div>
                  <div class="col s12 m6">
                    <input type="password" name="password" placeholder="Password" required>
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
                        <td>Name</td>
                        <td>Email</td>
                        <td>User name</td>
                        <td>Role</td>
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
        <div id="editadminmodal" class="modal">
            <div class="modal-content">
              <h4>Edit admin</h4>
              <form id="editform" class="row">
                  @csrf
                  <input type="hidden" id="editid" name="id">
                  <div class="col s12 m6">
                    <input type="text" name="name" id="editname" placeholder="Name" required>
                  </div>
                  <div class="col s12 m6">
                    <input type="text" name="username" id="editusername" placeholder="username" required>
                  </div>
                  <div class="col s12 m6">
                    <input type="text" name="email" id="editemail" placeholder="email" required>
                  </div>
                  <div class="input-filed col s12 m6">
                    <select name="role" class="browser-default" id="editrole" required>
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                      </select>
                  </div>
                  <div class="col s12 m6">
                    <input type="password" id="editpw" name="password" placeholder="Password" required>
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
        <div id="deleteadminmodal" class="modal">
            <div class="modal-content">
              <h4>Are ypu sure you want to delete <span id="adminname"></span> from admins?</h4>
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

        fetchadmin();
          function fetchadmin(){
              $.ajax({
                  type:"GET",
                  url:"/adminget",
                  dataType:"json",
                  success:function(response){
                      $('tbody').html("");
                      $.each(response.admins, function(key, item){
                        $('tbody').append(
                            '<tr>\
                                <td>'+item.name+'</td>\
                                <td>'+item.email+'</td>\
                                <td>'+item.username+'</td>\
                                <td>'+item.role+'</td>\
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
                var admin_id = $(this).val();
                $('#editadminmodal').modal('open');
                $.ajax({
                    type:"GET",
                    url:"/editadmin/"+admin_id,
                    dataType:"json",
                    success:function(response){
                        // console.log(response)
                        $('#editname').val(response.admin.name);
                        $('#editusername').val(response.admin.username);
                        $('#editemail').val(response.admin.email);
                        $('#editrole').val(response.admin.role);
                        $('#editpw').val(response.admin.password);
                        $('#editid').val(response.admin.id);
                    }
                })
          })
          $(document).on('click', '.deletebtn', function(e){
              e.preventDefault();
                var admin_id = $(this).val();
                $('#deleteadminmodal').modal('open');
                $.ajax({
                    type:"GET",
                    url:"/editadmin/"+admin_id,
                    dataType:"json",
                    success:function(response){
                        // console.log(response)
                        $('#deleteid').val(response.admin.id);
                        $('#adminname').html(response.admin.name);
                    }
                })
          })


          $('#addform').submit(function(e){
        e.preventDefault();
        $('#usernameerror').text('')
                $('#emailerror').text('')
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('adminadd')}}",
            data:$('#addform').serialize(),
            type:'post',
            success:function(response){
                $('#addform')['0'].reset();
                fetchadmin();
                M.toast({html: 'Admin Added!'})
            },
            error:function (response) {
              if(response.responseJSON.errors.username){
                var unerr = response.responseJSON.errors.username;  
                M.toast({html: unerr})
              }
              if(response.responseJSON.errors.email){
                var emerr = response.responseJSON.errors.email;  
                M.toast({html: emerr})
              }
            }
        })
      });
      $('#editform').submit(function(e){
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('adminupdate')}}",
            data:$('#editform').serialize(),
            type:'post',
            success:function(result){
                fetchadmin();
                M.toast({html: 'Admin Updated!'})
            }
        })
      });
      $('#deleteform').submit(function(e){
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('deleteadmin')}}",
            data:$('#deleteform').serialize(),
            type:'post',
            success:function(result){
                fetchadmin();
                M.toast({html: 'Admin Deleted!'})
            }
        })
      });
      })
    </script>
@endsection