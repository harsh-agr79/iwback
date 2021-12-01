@extends('admin/layoutadmin')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main')
    
    
<div class="container">
    <div class="red-text center-align" style="font-size: 15px;" id="usernameerror"></div>
    <div class="red-text center-align" style="font-size: 15px;" id="emailerror"></div>
    <span class="center-align"><h4>Sectors List</h4></span>
    <div class="center"><a href="#add" class="theme btn waves-effect modal-trigger">ADD <i class="material-icons right">add</i></a></div>
    <div id="add" class="modal">
        <div class="modal-content">
          <h4>Add Sector</h4>
          <form id="addsecform" enctype="multipart/form-data" class="row">
              @csrf
              <div class="col s12">
                <input type="text" name="sector" placeholder="Sector Name" required>
              </div>
              <div class="file-field col s12 input-field">
                <div class="btn theme">
                  <span>File</span>
                  <input name="image" type="file" multiple>
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload one or more files">
                </div>
              </div>
              <div class="center col s12" style="margin-top:5vh;">
                <button class="btn theme waves-effect modal-close" id="addsecbtn" type="submit">Submit<i class="material-icons right">send</i></button>
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
                    <td>image</td>
                    <td>Show On Home Page</td>
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
    <div id="editsecmodal" class="modal">
        <div class="modal-content">
          <h4>Edit Sector</h4>
          <form id="editsecform" enctype="multipart/form-data" class="row">
              @csrf
              <input type="hidden" id="editid" name="id">
              <div class="col s12">
                <input type="text" name="sector" id="editsector" placeholder="Sector Name" required>
              </div>
              <div class="col s12">
                <label>
                    <input type="checkbox" id="sonh" name="sectorshow"/>
                    <span>Show On Home</span>
                  </label>
            </div>
              <div class="file-field col s12 input-field">
                <div class="btn theme">
                  <span>File</span>
                  <input name="image" id="secimg" type="file">
                </div>
                
                <div class="file-path-wrapper">
                  <input class="" id="editimage" name="oldimg" type="text" placeholder="Upload one or more files">
                </div>
              </div>
              <div id="currentimg" class="center">

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
          <h4>Are ypu sure you want to delete <span id="adminname"></span> from sectors?</h4>
          <form id="deleteform" class="row">
              @csrf
              <input type="hidden" id="deleteid" name="id">
              <input type="hidden" id="deleteimage" name="image">
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

    fetchsector();
      function fetchsector(){
          $.ajax({
              type:"GET",
              url:"/sectorget",
              dataType:"json",
              success:function(response){
                $('tbody').html("");
                      $.each(response.sectors, function(key, item){
                        $('tbody').append(
                            '<tr>\
                                <td>'+item.sector+'</td>\
                                <td><img src="/sector/'+item.sectorimage+'" height="50" ></td>\
                                <td>'+item.sectorshow+'</td>\
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
            var sec_id = $(this).val();
            $('#currentimg').html("")
            $('#editsecmodal').modal('open');
            $.ajax({
                type:"GET",
                url:"/editsector/"+sec_id,
                dataType:"json",
                success:function(response){
                    // console.log(response)
                    $('#editsector').val(response.sector.sector)
                    $('#editid').val(response.sector.id)
                    $('#editimage').val(response.sector.sectorimage)
                    if(response.sector.sectorshow == 'on'){
                        $('#sonh').prop("checked",true)
                    }
                    $('#currentimg').append('<img src="/sector/'+response.sector.sectorimage+'" height="80">')
                }
            })
      })
      $(document).on('click', '.deletebtn', function(e){
          e.preventDefault();
            var sec_id = $(this).val();
            $('#deleteadminmodal').modal('open');
            $.ajax({
                type:"GET",
                url:"/editsector/"+sec_id,
                dataType:"json",
                success:function(response){
                    // console.log(response)
                    $('#deleteid').val(response.sector.id);
                    $('#deleteimage').val(response.sector.sectorimage);
                    $('#adminname').html(response.sector.sector);
                }
            })
      })


      $('#addsecform').submit(function(e){
         e.preventDefault();
         let formData = new FormData($('#addsecform')[0]);
         $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:"{{url('sectoradd')}}",
        data:formData,
        contentType: false,
        processData: false,
        type:'POST',
        success:function(response){
            $('#addsecform')['0'].reset();
            fetchsector();
            M.toast({html: 'sector Added!'})
        },
        error:function (response) {
              if(response.responseJSON.errors.sector){
                var unerr = response.responseJSON.errors.sector;  
                M.toast({html: unerr})
              }
              if(response.responseJSON.errors.image){
                var emerr = response.responseJSON.errors.image;  
                M.toast({html: emerr})
              }
            }
    })
  });
  $('#editsecform').submit(function(e){
    e.preventDefault();
    let formData = new FormData($('#editsecform')[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:"{{url('sectorupdate')}}",
        data: formData,
        contentType: false,
        processData: false,
        type:'POST',
        success:function(result){
            fetchsector();
            $('#editsecform')['0'].reset();
            M.toast({html: 'sector Updated!'})
        }
    })
  });
  $('#deleteform').submit(function(e){
    e.preventDefault();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:"{{url('deletesector')}}",
        data:$('#deleteform').serialize(),
        type:'post',
        success:function(result){
            fetchsector();
            M.toast({html: 'sector Deleted!'})
        }
    })
  });
  })
</script>
@endsection