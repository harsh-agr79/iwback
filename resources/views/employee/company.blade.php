@extends('employee/layoutcand')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main')
<div class="main-content">
    <section class="profile-dashboard">
        <div class="profile-info section-card">
            <div class="img-container">
                <div class="cover-pic" style="background-image: url('/company/cp/{{$company->cmpycp}}') ">
                </div>
                <div class="avatar">
                    <div class="avatar-pic">
                        <img class="avatar-img" src="{{asset('company/dp/'.$company->cmpydp)}}">
                        <div class="avatar-title">
                           
                            <h4>{{$company->cmpyname}}</h4>
                            <p class="location">{{$company->mainlocation}}</p>
                            <div></div>
                            <a class="contact-toggle modal-trigger" href="#modal1" data-target="modal1">Contact Info</a>
                        </div>
                    </div>
                    <span class="avatar-edit-btn hide-on-large-only">                    
                        <i class="material-icons theme-text">turned_in_not</i>                            
                    </span>
                </div>
                @if ($company->about == NULL)
                    
                @else
                <div class="about-user">
                    <h4>About Us</h4>
<pre>{{$company->about}}</pre>
                </div>
                @endif
                
            </div>
        </div>

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>Internwheel</h4>
                <div class="divider"></div>
                <div class="contact-edit">
                    <h6>Contact Info</h6>
                    <i class="material-icons">edit</i>
                </div>
                <ul class="contact-list">
                    <li>
                        <i class="material-icons">email</i>
                        <span class="contact-detail">
                            <h5>Email</h5>
                            <p>{{$company->email}}</p>
                        </span>
                    </li>
                    {{-- <li>
                        <i class="material-icons">phone</i>
                        <span class="contact-detail">
                            <h5>Phone</h5>
                            <p>(+977) 980-XXX-XXXX</p>
                        </span>
                    </li> --}}
                </ul>
            </div>
        </div>

     

        <div class="overview-section section-card">
            @if ($company->overview == NULL)
                
            @else
            <h3>Overview</h3>
            <pre>{{$company->overview}}</pre>
            @endif
            @if ($company->website == NULL)
                
            @else
            <div class="extra-overview">
                <h6>Website</h6>
                <a href="https://{{$company->website}}">https://{{$company->website}}</a>
            </div>
            @endif
            @if ($company->mainlocation == NULL)
                
            @else
            <div class="extra-overview">
                <h6>Location</h6>
                <p>{{$company->mainlocation}}</p>
            </div>
            @endif
            @if ($company->cmpysize == NULL)
                
            @else
            <div class="extra-overview">
                <h6>Company Size</h6>
                <p>{{$company->cmpysize}}</p>
            </div>
            @endif
            @if ($company->cmpyestd == NULL)
                
            @else
            <div class="extra-overview">
                <h6>Estd.</h6>
                <p>{{$company->cmpyestd}}</p>
            </div>
            @endif
        </div>
        @php
            $jobs = DB::table('jobs')->where('cmpyid',$company->id)->get();
        @endphp
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
                                <img class="cmpimg" src="{{asset('company/dp/'.$company->cmpydp)}}" alt="">
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
            <form id="saveform">
                <input type="hidden" name="candid" value="{{$user[0]->id}}">
                <input type="hidden" name="cmpyid" value="{{$company->id}}">
            </form>
           
            <span  onclick="saveformsub()">
                <h5>Save Company</h5>
                @if (count($saved)>0)
                    <i class="material-icons" id="iconsave">turned_in</i>
                @else
                    <i class="material-icons" id="iconsave">turned_in_not</i>
                @endif
            </span>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function saveformsub(){
        $('#saveform').submit();
    }
    $(document).ready(function(){
        $('#saveform').submit(function(e){
            e.preventDefault();
            let formData = new FormData($('#saveform')[0]);
            $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:'/candidate/savecmpy',
            data: formData,
            contentType: false,
            processData: false,
            type:'POST',
            success:function(result){
                // M.toast({html: result.pw})
                if (result.pw == 'Company Saved!') {
                    $('#iconsave').html('turned_in')
                } else {
                    $('#iconsave').html('turned_in_not')
                }
                }
            })
        })
    })
    
</script>
@endsection