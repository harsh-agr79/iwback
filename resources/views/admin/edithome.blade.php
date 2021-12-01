@extends('admin/layoutadmin')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main')
    
    
<div class="container">
    <div class="red-text center-align" style="font-size: 15px;" id="usernameerror"></div>
    <div class="red-text center-align" style="font-size: 15px;" id="emailerror"></div>
    <span class="center-align"><h4>Sliders List</h4></span>
    <div class="center"><a href="#addslider" class="theme btn waves-effect modal-trigger">ADD <i class="material-icons right">add</i></a></div>
    <div id="addslider" class="modal">
        <div class="modal-content">
          <h4>Add Slider</h4>
          <form id="addsliderform" enctype="multipart/form-data" class="row">
              @csrf
              <div class="col s12">
                <input type="text" name="text1" placeholder="Title">
              </div>
              <div class="col s12">
                <input type="text" name="text2" placeholder="Sub-title">
              </div>
              <div class="file-field col s12 input-field">
                <div class="btn theme">
                  <span>File</span>
                  <input name="sliderimage" type="file" multiple>
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
                    <td>S.N</td>
                    <td>image</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody id="slidertable">
                
            </tbody>
        </table>
    </div>
    
</div>

<div class="slidermodal">
    <div id="editslidermodal" class="modal">
        <div class="modal-content">
          <h4>Edit Slider</h4>
          <form id="editsliderform" enctype="multipart/form-data" class="row">
              @csrf
              <input type="hidden" id="editid" name="id">
              <div class="col s12">
                <input type="text" name="contorder" id="editsliderorder" placeholder="slider order">
              </div>
              <div class="col s12">
                <input type="text" name="text1" id="editslidertext1" placeholder="Title">
              </div>
              <div class="col s12">
                <input type="text" name="text2" id="editslidertext2" placeholder="Sub-title">
              </div>
              <div class="file-field col s12 input-field">
                <div class="btn theme">
                  <span>File</span>
                  <input name="sliderimage" type="file" multiple>
                </div>
                <div class="file-path-wrapper">
                  <input class="" id="editsliderimage" name="oldimg" type="text" placeholder="Upload one or more files">
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
    <div id="deleteslidermodal" class="modal">
        <div class="modal-content">
          <h4>Are ypu sure you want to delete this slider?</h4>
          <form id="deletesliderform" class="row">
              @csrf
              <input type="hidden" id="deletesliderid" name="id">
              <input type="hidden" id="deletesliderimage" name="image">
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

        fetchslider();
      function fetchslider(){
          $.ajax({
              type:"GET",
              url:"/sliderget",
              dataType:"json",
              success:function(response){
                $('#slidertable').html("");
                      $.each(response.sliders, function(key, item){
                        $('#slidertable').append(
                            '<tr>\
                                <td>'+item.contorder+'</td>\
                                <td><img src="/assets/slider/'+item.image+'" height="50" ></td>\
                                <td><button value="'+item.id+'" class="btn-small waves-effect theme editsliderbtn"  style="border-radius: 20px;"><i class="material-icons small">edit</i></button></td>\
                                <td><button value="'+item.id+'" class="btn-small deletesliderbtn waves-effect red"  style="border-radius: 20px;"><i class="material-icons small">delete</i></button></td>\
                            </tr>'
                        );
                      });
              }
          })
      }

      $(document).on('click', '.editsliderbtn', function(e){
          e.preventDefault();
            var sli_id = $(this).val();
            $('#currentimg').html("")
            $('#editslidermodal').modal('open');
            $.ajax({
                type:"GET",
                url:"/editslider/"+sli_id,
                dataType:"json",
                success:function(response){
                    // console.log(response)
                    $('#editslidertext1').val(response.slider.text1)
                    $('#editslidertext2').val(response.slider.text2)
                    $('#editsliderorder').val(response.slider.contorder)
                    $('#editid').val(response.slider.id)
                    $('#editsliderimage').val(response.slider.image)
                    $('#currentimg').append('<img src="/assets/slider/'+response.slider.image+'" height="80">')
                }
            })
      })
      $(document).on('click', '.deletesliderbtn', function(e){
          e.preventDefault();
            var sli_id = $(this).val();
            $('#deleteslidermodal').modal('open');
            $.ajax({
                type:"GET",
                url:"/editslider/"+sli_id,
                dataType:"json",
                success:function(response){
                    // console.log(response)
                    $('#deletesliderid').val(response.slider.id);
                    $('#deletesliderimage').val(response.slider.image);
                }
            })
      })


      $('#addsliderform').submit(function(e){
         e.preventDefault();
         let formData = new FormData($('#addsliderform')[0]);
         $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:"{{url('slideradd')}}",
        data:formData,
        contentType: false,
        processData: false,
        type:'POST',
        success:function(response){
            $('#addsliderform')['0'].reset();
            fetchslider();
            M.toast({html: 'Slider Added!'})
        },
    })
  });
  $('#editsliderform').submit(function(e){
    e.preventDefault();
    let formData = new FormData($('#editsliderform')[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:"{{url('sliderupdate')}}",
        data: formData,
        contentType: false,
        processData: false,
        type:'POST',
        success:function(result){
            fetchslider();
            $('#editsliderform')['0'].reset();
            M.toast({html: 'slider Updated!'})
        }
    })
  });
  $('#deletesliderform').submit(function(e){
    e.preventDefault();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url:"{{url('deleteslider')}}",
        data:$('#deletesliderform').serialize(),
        type:'post',
        success:function(result){
            fetchslider();
            M.toast({html: 'slider Deleted!'})
        }
    })
  });
  })
</script>
@endsection