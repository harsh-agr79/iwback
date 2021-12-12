@extends('company/layoutcmpy')
@section('main')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<div id="editcover" class="modal">
    <div class="modal-content">
        <form id="upcp" name="coverpic" method="POST" enctype="multipart/form-data">
            <div class="file-field input-field">
              <div class="btn">
                <span>Select Cover Pic</span>
                <input type="hidden" name="id" value="{{$company['0']->id}}">
                <input name="coverpic" type="file">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
                <input type="hidden" id="oldimg" value="{{$company['0']->cmpycp}}" name="oldimg">
              </div>
            </div>
                <div class="center">
                    <button class="modal-close theme btn waves-effect" onclick="M.toast({html: 'Please wait!'})" type="submit">Update</button>
                </div>
          </form>
    </div>
    <div class="modal-footer">
    </div>
  </div>
</div>
<div id="dp" class="modal bottom-sheet">
    <div class="modal-content">
      
            {{-- <div style="font-size: 20px; padding:10px; width:100%; margin-top:10px;" class="z-depth-1 modal-trigger" href="#viewdp"><a href="" class="black-text">View Profile image</a></div> --}}
            <div style="font-size: 20px; padding:10px; width:100%; margin-top:10px;" class="z-depth-1 modal-trigger" href="#editdp"><a href="" class="black-text">Update Profile image</a></div>
    </div>
    {{-- <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
    </div> --}}
  </div>
  <div id="editdp" class="modal">
    <div class="modal-content">
        <form id="updp" method="POST" enctype="multipart/form-data">
            <div class="file-field input-field">
              <div class="btn">
                <span>Select Profile Pic</span>
                <input type="hidden" name="id" value="{{$company['0']->id}}">
                <input name="dp" type="file">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
                <input type="hidden" id="olddp" value="{{$company['0']->cmpydp}}" name="olddp">
              </div>
            </div>
                <div class="center">
                    <button class="modal-close theme btn waves-effect" onclick="M.toast({html: 'Please wait!'})" type="submit">Update</button>
                </div>
          </form>
    </div>
    <div class="modal-footer">
    </div>
  </div>
</div>
<div id="viewdp" class="modal">
    <div class="modal-content">
        <div class="center">
            <img src="{{asset('assets/images/icon.png')}}"  style="height: 60vh;" class="responsive-img" alt="">
        </div>
    </div>
    <div class="modal-footer">
    </div>
  </div>
</div>
<form action="" id="profileform" method="POST">
    <input type="hidden" name="id", value="{{$company['0']->id}}">
<div class="main-content">
    <section class="profile-dashboard">
        <div class="profile-info section-card">
            <div class="img-container">
                <div class="cover-pic" id="cppic" style="background: url({{asset('company/cp/'.$company['0']->cmpycp)}}) center / cover no-repeat ">
                    <span class="cover-edit-btn modal-trigger" href="#editcover">
                        <i class="material-icons">mode_edit</i>
                    </span>
                </div>
                <div class="avatar">
                    <div class="avatar-pic">
                        @if ($company['0']->cmpydp == null)
                        <img class="avatar-img modal-trigger" href="#dp" src="{{asset('assets/images/icon.png')}}">   
                        @else
                        <img class="avatar-img modal-trigger" href="#dp" id="profilepic"  src="{{asset('assets/images/icon.png')}}">
                        @endif
                       
                        <div class="avatar-title">
                            <h4>{{$company['0']->cmpyname}}</h4>
                            <p class="location" id="ml"></p>
                            <input id="mlinp" type="text" class="browser-default" placeholder="Main Branch Location" style="display:none; padding: 10px; border-radius:10px;" name="mainlocation" required>
                            <div></div>
                            <a class="contact-toggle modal-trigger" href="#modal1" data-target="modal1">Contact Info</a>
                        </div>
                    </div>
                    <span class="avatar-edit-btn" onclick="mainlocation()">
                        <i class="material-icons tooltipped" id="mledi"  data-position="bottom" data-tooltip="Edit Profile Details">mode_edit</i>                            
                        <i class="material-icons" id="mlsli" style="display: none;" onclick="submit()">save</i>                            
                    </span>
                </div>
                <div class="about-user">
                    <h4>About Us</h4>
<pre id="abo"></pre>
                    <textarea id="aboinp" name="about" style="display: none;" class="materialize-textarea browser-default" placeholder="Give a short description about your company"></textarea>
                </div>
            </div>
        </div>

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4></h4>
                <div class="divider"></div>
                <div class="contact-edit">
                    <h6>Contact Info</h6>
                </div>
                <ul class="contact-list">
                    <li>
                        <i class="material-icons">email</i>
                        <span class="contact-detail">
                            <h5>Email</h5>
                            <p>{{$company['0']->email}}</p>
                        </span>
                    </li>
                    {{-- <li>
                        <i class="material-icons">phone</i>
                        <span class="contact-detail">
                            <h5>Phone</h5>
                            <p>(+977) {{$company['0']->phonenumber}}</p>
                        </span>
                    </li> --}}
                </ul>
            </div>
        </div>

        <div class="user-dashboard-section section-card">
            <div class="article-count section-card">
                <div class="article-col col-1">
                    <span>8</span>
                    <a href="#jobs-posted">Jobs Posted</a>
                </div>
                <div class="article-col col-2">
                    <span>12</span>
                    <a href="#hired-info">Applicants Hired</a>
                </div>
                <div class="article-col col-3">
                    <span>2</span>
                    <a href="#active-jobs">Active Vacancies</a>
                </div>
            </div>
        </div>

        <div class="overview-section section-card">
            <h3>Overview</h3>
<pre id="ove"></pre>
<textarea id="oveinp" style="display: none;" name="overview" class="materialize-textarea browser-default" placeholder="Give a short description about your company"></textarea>
            <div class="extra-overview">
                <h6>Website</h6>
                <a href="" id="web" target="_blank"></a>
                <input type="url" name="website" id="webinp" placeholder="Company Website" class="browser-default" value="{{$company['0']->website}}" style="padding:10px; border-radius:10px; display:none;">
            </div>
            <div class="extra-overview">
                <h6>Location</h6>
                <p id="ml2"></p>
            </div>
            <div class="extra-overview">
                <h6>Company Size</h6>
                <p id="siz"></p>
                <input type="text" name="cmpysize" placeholder="Company Size" id="sizinp" class="browser-default" value="" style="padding:10px; border-radius:10px; display:none;">
            </div>
            <div class="extra-overview" style="margin-bottom: 10px;">
                <h6>Estd.</h6>
                <div id="est"></div>
                <input type="number" min="1900" max="2025" step="1" value="" name="cmpyestd" placeholder="Company Established Year" id="estinp" class="browser-default" value="" style="padding:10px; border-radius:10px; display:none;">
            </div>
        </div>
</form>
        <div class="recent-jobs section-card">
            <h1>Recent Job Openings</h1>
            <div class="recent-job-box">
                @foreach ($jobs as $item)
                <div class="jobbox z-depth-1">
                    <div class="row">
                        <div class="col s12 row valign-wrapper" style="margin-bottom:0">
                            <div class="col s10 m10">
                                <h4 class="title">{{$item->title}}</h4>
                            </div>
                            <div class="col s2 m2">
                                <img class="cmpimg" src="{{asset('company/dp/'.$company[0]->cmpydp)}}" alt="">
                            </div>
                        </div>
                        <div class="col s12 row" style="margin-top: 0;margin-bottom: 0;">
                            <div class="col s12" style="margin-bottom: 0;">
                                <h6 class="companyname" style="font-weight: 600;">{{$item->cmpyname}}</h6>
                            </div>    
                        </div>
                        <div class="col s12" style="margin-top: 0px;">
                            <div class="center" style="margin-top: 0;">
                                <span class="text" class="center-align">{{$item->orientation}}</span>
                            </div>
                        </div>
                        <div class="col s12 row hide-on-med-and-down" style="margin-top: 15px;">
                            <div class="col s3 center-align">
                                <span class="text"><i class="material-icons inline-icon theme-text">play_circle_filled</i>Start date</span>
                               <br>
                               <span class="text2">Immidiately</span>
                            </div>
                            <div class="col s3 center-align"> 
                                <span class="text"><i class="material-icons inline-icon theme-text">date_range</i>Duration</span>
                                <br>
                                <span class="text2">{{$item->duration}}</span></div>
                            <div class="col s3 center-align">
                                <span class="text"><i class="material-icons inline-icon theme-text">attach_money</i>Stipend</span>
                                <br>
                                <span class="text2">@if ($item->stipend == 'on')
                                    Work Based
                                @else
                                {{$item->stipend}}
                                @endif</span>
                            </div>
                            <div class="col s3 center-align">
                                <span class="text"><i class="material-icons inline-icon theme-text">access_time</i>Apply by</span>
                                <br>
                                <span class="text2">{{$item->deadline}}</span>
                            </div>
                        </div>
                        <div class="col s12 row hide-on-large-only" style="margin-top: 15px;">
                            <div class="col s6 left-align">
                                <span class="text2"><i class="material-icons inline-icon theme-text">play_circle_filled</i>Immidiately</span>
                            </div>
                            <div class="col s6 left-align"> 
                                <span class="text2"><i class="material-icons inline-icon theme-text">date_range</i>{{$item->duration}}</span>
                                </div>
                            <div class="col s6 left-align">
                                <span class="text2"><i class="material-icons inline-icon theme-text">attach_money</i>@if ($item->stipend == 'on')
                                    Work Based
                                @else
                                {{$item->stipend}}</span>
                                @endif
                            </div>
                            <div class="col s6 left-align">
                                <span class="text2"><i class="material-icons inline-icon theme-text">access_time</i>{{$item->deadline}}</span>
                            </div>
                        </div>
                        <div class="col s12 row" style="margin-top: 10px; margin-bottom: 0;">
                            <div class="col s6 left-align">
                                <span class="jobtype">{{$item->type}}</span>
                            </div>
                            <div class="col s6 right-align">
                                <a href="{{url('job/'.$item->jobid)}}">
                                    View Details 
                                    <i class="material-icons right">arrow_forward</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="profile-sidebar">
        <div class="job-poster section-card">
            @if($company[0]->adminverification === 'verified')
            <a href="{{url('company/postajob')}}">
                <h5>Post a job</h5>
                <i class="material-icons">add_circle</i>
            </a>
            @else
            <a href="{{url('company/postajob')}}" class="tooltipped" data-position="bottom" data-tooltip="You cannot post a job yet">
                <h5 class="grey-text">Post a job</h5>
                <i class="material-icons grey-text">add_circle</i>
            </a>
            @endif
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
<span class="hide" id="dpname"></span>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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
        url:"{{url('company/update')}}",
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
        url:"{{url('company/updatecp')}}",
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
        url:"{{url('company/updatedp')}}",
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
</script>
@endsection