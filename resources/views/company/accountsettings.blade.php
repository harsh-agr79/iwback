@extends('company/layoutcmpy')

@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="main-content">
    <section class="left-section">
        <div class="settings-section section-card">
            <h1>Account Settings</h1>
            <div class="divider"></div>
            <div class="settings-items">
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
                                        <input type="password" name="password" placeholder="Enter Your Password to Confirm" required>
                                    </div>
                                    <div class="col s12">
                                        <input type="hidden" name="id" value="{{$company['0']->id}}">
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
                                        <input type="hidden" name="id" value="{{$company['0']->id}}">
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
                    <h3 class="item-title">Company Name</h3>
                    <i class="material-icons modal-trigger" href="#editcmpyname">edit</i>
                    <span class="current-data" id="cmpyname"></span>
                    <div id="editcmpyname" class="modal">
                        <div class="modal-content">
                            <h5 class="center-align">Edit Your Company Name</h5>
                            <form action="" id="editcnform" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col s12">
                                        <input type="password" name="password" placeholder="Enter Your Password to Confirm" required>
                                    </div>
                                    <div class="col s12">
                                        <input type="hidden" name="id" value="{{$company['0']->id}}">
                                        <input type="text" id="cn" name="cmpyname" placeholder="Company Name" required>
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
                    <span class="current-data">{{$company['0']->email}}</span>
                    <div id="editemail" class="modal">
                        <div class="modal-content">
                            <h5 class="center-align">Edit Your Email</h5>
                            <form action="{{route('upemail')}}" id="editemailform" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col s12">
                                        <input type="password" name="password" placeholder="Enter Your Password to Confirm" required>
                                    </div>
                                    <div class="col s12">
                                        <input type="hidden" name="id" value="{{$company['0']->id}}">
                                        <input type="text" name="email" placeholder="Email" value="{{$company['0']->email}}" required>
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
                                        <input type="hidden" name="id" value="{{$company['0']->id}}">
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
                                        <input type="hidden" name="id" value="{{$company['0']->id}}">
                                        <input type="text" name="phonenumber" placeholder="New Phone Number" id="pn" value="{{$company['0']->phonenumber}}" required>
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
                                    <input type="hidden" name="id" value="{{$company['0']->id}}">
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
            </div>
        </div>
    </section>
    <section class="profile-sidebar">
        <div class="job-poster section-card">
            <a href="{{url('company/postajob')}}">
                <h5>Post a job</h5>
                <i class="material-icons">add_circle</i>
            </a>
        </div>
        <div class="dashboard-tabs section-card">
            <a class="tab-menu" href="{{url('company/profile')}}">
                <i class="material-icons">account_circle</i>
                <p class="menu-text">Company Profile</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{url('company/jobsmanager')}}">
                <i class="material-icons">business_center</i>
                <p class="menu-text">Jobs Posted</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="saved-candidates.html">
                <i class="material-icons">groups</i>
                <p class="menu-text">Saved Candidates</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{url('company/settings')}}">
                <i class="material-icons">settings</i>
                <p class="menu-text">Account Settings</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{url('company/logout')}}">
                <i class="material-icons">logout</i>
                <p class="menu-text">Log Out</p>
            </a>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
    fetchcmpy();
    function fetchcmpy(){
          $.ajax({
              type:"GET",
              url:"/companyget",
              dataType:"json",
              success:function(response){
                  console.log(response)
                $('#name').text(response.company[0].firstname+' '+response.company[0].lastname);
                $('#fn').val(response.company[0].firstname);
                $('#ln').val(response.company[0].lastname);
                $('#cmpyname').text(response.company[0].cmpyname);
                $('#cn').val(response.company[0].cmpyname);
                $('#username').text(response.company[0].username);
                $('#un').val(response.company[0].username);
                $('#pn').val(response.company[0].phonenumber);
              }
          })
      }
        $('#editnameform').submit(function(e){
            e.preventDefault();
            let formData = new FormData($('#editnameform')[0]);
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('company/updatename')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                // $('#editnameform')['0'].reset();
                console.log(result.pw);
                M.toast({html: result.pw})
                if(result.pw === 'Name Has Been Changed'){
                    fetchcmpy();
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
            url:"{{url('company/updateun')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                M.toast({html: result.pw})
                if(result.pw === 'Username Has Been Changed'){
                    fetchcmpy();
                    $('#editusername').modal('close');
                }
            }
            })
        });
        $('#editcnform').submit(function(e){
            e.preventDefault();
            let formData = new FormData($('#editcnform')[0]);
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('company/updatecn')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                M.toast({html: result.pw})
                if(result.pw === 'Company name Has Been Changed'){
                    fetchcmpy();
                    $('#editcmpyname').modal('close');
                }
            }
            })
        });
        $('#editpwform').submit(function(e){
            e.preventDefault();
            let formData = new FormData($('#editpwform')[0]);
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:"{{url('company/updatepw')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                M.toast({html: result.pw})
                if(result.pw === 'Password Has Been Changed'){
                    fetchcmpy();
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
            url:"{{url('company/updatepn')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                M.toast({html: result.pw})
                if(result.pw === 'Phone number Has Been Changed'){
                    fetchcmpy();
                    $('#editpn').modal('close');
                    $('#editpnform')[0].reset();
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
            url:"{{url('company/deactivate')}}",
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                M.toast({html: result.pw})
                if(result.pw === 'Check Your email to deactivate your account'){
                    $('#loader').remove();
                    $('#emailmsg').text('Please check Your email to deactivate your account, check the spam folder incase you do not find the mail')
                    fetchcmpy();
                    $('#deactivateacc')[0].reset();
                }
            }
            })
        });
    })
</script>
@endsection