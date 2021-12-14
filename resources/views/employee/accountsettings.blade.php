@extends('employee/layoutcand')

@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="main-content">
    <section class="left-section">
        <div class="settings-section section-card">
            <h1>Account Settings</h1>
            <div class="divider"></div>
            <div class="settings-items">
                @if ($cand->google_id == NULL)
                <div class="settings-item">
                    <h3 class="item-title">Full Name</h3>
                    <i class="material-icons modal-trigger" href="#editname">edit</i>
                    <span class="current-data" id="name"></span>
                    <div id="editname" class="modal">
                        <div class="modal-content">
                            <h5 class="center-align">Edit Your Name</h5>
                            <form action="" id="editnameform" method="POST">
                                <div class="row">
                                    <div class="col s12">
                                        <input type="password" id="enpw" name="password" placeholder="Enter Your Password to Confirm" required>
                                    </div>
                                    <div class="col s12">
                                        <input type="hidden" name="id" value="{{$cand->id}}">
                                        <input type="text" id="fn" name="firstname" placeholder="First Name" required>
                                    </div>
                                    <div class="col s12">
                                        <input type="text" id="ln" name="lastname" placeholder="Last Name" required>
                                    </div>
                                    <div class="center col s12">
                                        <button class="theme btn waves-effect" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Username</h3>
                    <i class="material-icons modal-trigger" href="#editusername">edit</i>
                    <span class="current-data" id="username"></span>
                    <div id="editusername" class="modal">
                        <div class="modal-content">
                            <h5 class="center-align">Edit Your Username</h5>
                            <form action="" method="POST" id="editunform" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col s12">
                                        <input type="password" name="password" placeholder="Enter Your Password to Confirm" required>
                                    </div>
                                    <div class="col s12">
                                        <input type="hidden" name="id" value="{{$cand->id}}">
                                        <input type="text" id="un" name="username" placeholder="Change Username" required>
                                    </div>
                                    <div class="center col s12">
                                        <button class="theme btn waves-effect" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Email</h3>
                    <i class="material-icons modal-trigger" href="#editemail">edit</i>
                    <span class="current-data">{{$cand->email}}</span>
                    <div id="editemail" class="modal">
                        <div class="modal-content">
                            <h5 class="center-align">Edit Your Email</h5>
                            <form action="{{route('candupemail')}}" id="editemailform" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col s12">
                                        <input type="password" name="password" placeholder="Enter Your Password to Confirm" required>
                                    </div>
                                    <div class="col s12">
                                        <input type="hidden" name="id" value="{{$cand->id}}">
                                        <input type="text" name="email" placeholder="Email" value="{{$cand->email}}" required>
                                    </div>
                                    <div class="center col s12">
                                        <button class="theme btn waves-effect" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Password</h3>
                    <i class="material-icons modal-trigger" href="#editpw">edit</i>
                    <span class="current-data">**********</span>
                    <div id="editpw" class="modal">
                        <div class="modal-content">
                            <h5 class="center-align">Change Your Password</h5>
                            <form action="" id="editpwform" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col s12">
                                        <input type="hidden" name="id" value="{{$cand->id}}">
                                        <input type="password" name="password" placeholder="Enter Your Password to Confirm" required>
                                    </div>
                                    <div class="col s12">
                                        <input type="password" name="newpassword" placeholder="Password" required>
                                    </div>
                                    <div class="col s12">
                                        <input type="password" name="newpassword2" placeholder="Confirm-Password" required>
                                    </div>
                                    <div class="center col s12">
                                        <button class="theme btn waves-effect" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Contact No.</h3>
                    <i class="material-icons modal-trigger" href="#editpn">edit</i>
                    <span class="current-data">98********</span>
                    <div id="editpn" class="modal">
                        <div class="modal-content">
                            <h5 class="center-align">Edit Your Phone Number</h5>
                            <form action="" method="POST" enctype="multipart/form-data" id="editpnform">
                                <div class="row">
                                    <div class="col s12">
                                        <input type="password" name="password" placeholder="Enter Your Password to Confirm" required>
                                    </div>
                                    <div class="col s12">
                                        <input type="hidden" name="id" value="{{$cand->id}}">
                                        <input type="text" name="phonenumber" placeholder="New Phone Number" id="pn" value="{{$cand->phonenumber}}" required>
                                    </div>
                                    <div class="center col s12">
                                        <button class="theme btn waves-effect" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Deactivate Account</h3>
                    <i class="material-icons btn red white-text modal-trigger" href="#deactivate">warning</i>
                    <div id="deactivate" class="modal">
                        <div class="modal-content">
                            <div id="loadercont" class="center">

                            </div>
                            <div id="emailmsg"></div>
                            <form action="" method="POST" enctype="multipart/form-data" id="deactivateacc">
                                @csrf
                                <div class="row">
                                    <div class="col s12">
                                        <h3>Are you sure you want to deactivate your account?</h3>
                                        <h6>You can recover your account until after 30 days of deactivation after that your account along with all your details will be permanently deleted.</h6>
                                    </div>
                                    <input type="hidden" name="id" value="{{$cand->id}}">
                                    <input type="password" name="password" required placeholder="Enter your password to confirm">
                                    <div class="col s12">
                                        <h5>Specify the reason:</h5>
                                        <div class="input-field col s12">
                                            <textarea id="textarea2" name="reason" required class="materialize-textarea"></textarea>
                                            <label for="textarea2">Reason</label>
                                          </div>
                                    </div>
                                    <div class="col s6 right-align"><span class="modal-close btn waves-effect theme">Cancel</span></div>
                                    <div class="col s6"><button class="btn waves-effect red">Continue To Deactivate</button></div>
                                </div>
                            </form>
                        </div>
                      </div>
                </div>
                @else
                <div class="settings-item">
                    <h3 class="item-title">Full Name</h3>
                    <i class="material-icons modal-trigger" href="#editname">edit</i>
                    <span class="current-data" id="name"></span>
                    <div id="editname" class="modal">
                        <div class="modal-content">
                            <h5 class="center-align">Edit Your Name</h5>
                            <form action="" id="editnameform" method="POST">
                                <div class="row">
                                    {{-- <div class="col s12">
                                        <input type="password" name="password" placeholder="Enter Your Password to Confirm" required>
                                    </div> --}}
                                    <input type="hidden" name="gid" value="{{$cand->google_id}}">
                                    <div class="col s12">
                                        <input type="hidden" name="id" value="{{$cand->id}}">
                                        <input type="text" id="fn" name="firstname" placeholder="First Name" required>
                                    </div>
                                    <div class="col s12">
                                        <input type="text" id="ln" name="lastname" placeholder="Last Name" required>
                                    </div>
                                    <div class="center col s12">
                                        <button class="theme btn waves-effect" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                </div>
                <div class="settings-item">
                    <h3 class="item-title">Deactivate Account</h3>
                    <i class="material-icons btn red white-text modal-trigger" href="#deactivate">warning</i>
                    <div id="deactivate" class="modal">
                        <div class="modal-content">
                            <div id="loadercont" class="center">

                            </div>
                            <div id="emailmsg"></div>
                            <form action="" method="POST" enctype="multipart/form-data" id="deactivateacc">
                                @csrf
                                <div class="row">
                                    <div class="col s12">
                                        <h3>Are you sure you want to deactivate your account?</h3>
                                        <h6>You can recover your account until after 30 days of deactivation after that your account along with all your details will be permanently deleted.</h6>
                                    </div>
                                    <input type="hidden" name="id" value="{{$cand->id}}">
                                    <input type="password" name="password" required placeholder="Enter your password to confirm">
                                    <div class="col s12">
                                        <h5>Specify the reason:</h5>
                                        <div class="input-field col s12">
                                            <textarea id="textarea2" name="reason" required class="materialize-textarea"></textarea>
                                            <label for="textarea2">Reason</label>
                                          </div>
                                    </div>
                                    <div class="col s6 right-align"><span class="modal-close btn waves-effect theme">Cancel</span></div>
                                    <div class="col s6"><button class="btn waves-effect red">Continue To Deactivate</button></div>
                                </div>
                            </form>
                        </div>
                      </div>
                </div>
                @endif
                
            </div>
        </div>
    </section>
    <section class="profile-sidebar">
        <div class="job-poster section-card">
            <a href="../../jobs.html">
                <h5>Look For Jobs</h5>
                <i class="material-icons">business_center</i>
            </a>
        </div>
        <div class="dashboard-tabs section-card">
            <a class="tab-menu" href="{{url('/candidate/profile')}}">
                <i class="material-icons">account_circle</i>
                <p class="menu-text">Account Profile</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="applied_jobs.html">
                <i class="material-icons">business_center</i>
                <p class="menu-text">Jobs Applied</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="saved_companies.html">
                <i class="material-icons">groups</i>
                <p class="menu-text">Saved Companies</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="../account-settings.html">
                <i class="material-icons">settings</i>
                <p class="menu-text">Account Settings</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{'/candidate/logout'}}">
                <i class="material-icons">logout</i>
                <p class="menu-text">Log Out</p>
            </a>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
    fetchcand();
    function fetchcand(){
          $.ajax({
              type:"GET",
              url:"/candidateget",
              dataType:"json",
              success:function(response){
                  console.log(response.candidate.firstname)
                $('#name').text(response.candidate.firstname+' '+response.candidate.lastname);
                $('#fn').val(response.candidate.firstname);
                $('#ln').val(response.candidate.lastname);
                $('#username').text(response.candidate.username);
                $('#un').val(response.candidate.username);
                $('#pn').val(response.candidate.phonenumber);
              }
          })
      }
        $('#editnameform').submit(function(e){
            e.preventDefault();
            let formData = new FormData($('#editnameform')[0]);
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('candidate/updatename')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                console.log(result.pw);
                M.toast({html: result.pw})
                if(result.pw === 'Name Has Been Changed'){
                    $('#editnameform')['0'].reset();
                    fetchcand();
                    $('#editname').modal('close');
                }
            }
            })
        });
        $('#editunform').submit(function(e){
            e.preventDefault();
            let formData = new FormData($('#editunform')[0]);
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('candidate/updateun')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                M.toast({html: result.pw})
                if(result.pw === 'Username Has Been Changed'){
                    $('#editunform')['0'].reset();
                    fetchcand();
                    $('#editusername').modal('close');
                }
            },
            error:function (result) {
              if(result.responseJSON.errors.username){
                var unerr = result.responseJSON.errors.username;  
                M.toast({html: unerr})
              }
            }
            })
        });
   
        $('#editpwform').submit(function(e){
            e.preventDefault();
            let formData = new FormData($('#editpwform')[0]);
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('candidate/updatepw')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                M.toast({html: result.pw})
                if(result.pw === 'Password Has Been Changed'){
                    fetchcand();
                    $('#editpw').modal('close');
                    $('#editpwform')[0].reset();
                }
            }
            })
        });
        $('#editpnform').submit(function(e){
            e.preventDefault();
            let formData = new FormData($('#editpnform')[0]);
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('candidate/updatepn')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                M.toast({html: result.pw})
                if(result.pw === 'Phone number Has Been Changed'){
                    fetchcand();
                    $('#editpn').modal('close');
                    $('#editpnform')[0].reset();
                }
            },
            error:function (result) {
              if(result.responseJSON.errors.phonenumber){
                var unerr = result.responseJSON.errors.phonenumber;  
                M.toast({html: unerr})
              }
            }
            })
        });
        $('#deactivateacc').submit(function(e){
            e.preventDefault();
            $('#deactivateacc').toggle();
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
            let formData = new FormData($('#deactivateacc')[0]);
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('candidate/deactivate')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                M.toast({html: result.pw})
                if(result.pw === 'Check Your email to deactivate your account'){
                    $('#loader').remove();
                    $('#emailmsg').text('Please check Your email to deactivate your account, check the spam folder incase you do not find the mail')
                    fetchcand();
                    $('#deactivateacc')[0].reset();
                }
            }
            })
        });
    })
</script>
@endsection