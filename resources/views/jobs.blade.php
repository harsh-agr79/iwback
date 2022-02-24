@extends('layout')

@section('main')
  <div class="row">
    <div class="col s3 hide-on-med-and-down" id="filtersection" style="position: relative">
      <div id="sortsec" class="white z-depth-2" style="border-radius: 20px; height:65vh; overflow-y: scroll; overflow-x:hidden; width:23vw; margin-top:20px;">
        <form id="filterform" enctype="multipart/form-data" action="{{route('checkfilter')}}" method="POST">
          @csrf
          <div>
            <h6>Job Type</h6>
            
              <div class="left-align">
                <div>
                  <label>
                    <input type="checkbox" name="type[]" value="Internship" id="internship"/>
                    <span>Internship</span>
                  </label>
                </div>
                <div>
                  <label>
                    <input type="checkbox" name="type[]" value="Fresher" id="frjob"/>
                    <span>Freshers job</span>
                  </label>
                </div>
              </div>
          </div>
          <div>
                <h6>Sector</h6>
                <div class="left-align">
                  @foreach ($sector as $item)
                  <div>
                    <label>
                      <input type="checkbox" id="{{$item->id}}" name="sector[]" value="{{$item->sector}}" onchange="
                      if(document.getElementById('{{$item->id + 1000}}').checked){
                        document.getElementById('{{$item->id + 1000}}').checked = false;
                      }
                      else{
                        document.getElementById('{{$item->id + 1000}}').checked = true;
                      } 

                      ffsub();
                      "/>
                      <span>{{$item->sector}}</span>
                    </label>
                  </div>
                  @endforeach
                
                </div>
          </div>
          <div>
                <h6>Time Posted</h6>
                <div class="left-align">
                  <div>
                    <label>
                      <input type="checkbox" name="time[]" value="{{date('Y-m-d H:i:s', strtotime('-1 day', strtotime(now())))}}" id="24hr"/>
                      <span>Last 24 Hrs</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" name="time[]" value="{{date('Y-m-d H:i:s', strtotime('-7 day', strtotime(now())))}}" id="7d"/>
                      <span>Last 7 days</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" name="time[]" value="{{date('Y-m-d H:i:s', strtotime('-15 day', strtotime(now())))}}" id="15d"/>
                      <span>Last 15 days</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" name="time[]" value="{{date('Y-m-d H:i:s', strtotime('-30 day', strtotime(now())))}}" id="30d"/>
                      <span>Last 30 days</span>
                    </label>
                  </div>
                  <div class="switch" style="margin-top: 15px;">
                    <span style="color: black; font-weight: 600; font-size:15px;">Work From Home </span>
                    <label>
                      <input type="checkbox" name="ori[]" value="Work From Home" id="wfh">
                      <span class="lever"></span>
                    </label>
                  </div>
                  <div class="switch" style="margin-top: 15px;">
                    <span style="color: black; font-weight: 600; font-size:15px;">Work On Site</span>
                    <label>
                      <input type="checkbox" name="ori[]" value="Work On Site" id="wos">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
          </div>
          <div>
                <h6>Salary Range</h6>
                <p class="range-field">
                  <label>Min Salary</label>
                  <input type="range" id="test5" value="0" min="0" max="100000" />
                </p>
                <p class="range-field">
                  <label for="">Max Salary</label>
                  <input type="range" id="test5" min="0" value="100000" max="100000" />
                </p>
          </div>
        </form>  
      </div>
    </div>
    <div class="col s9" id="jobsection">
      <div id="main" style="min-height: 100vh; z-index:0;">
        <div class="row self-contain" id="jobscontainer">
              @foreach ($jobs as $item)
              @php
                $company = DB::table('companies')->where('id',$item->cmpyid)->first()   
              @endphp
          <div class="col s12 m6" id="{{$item->id}}" style="margin-top: 20px;">
              <div class="jobbox z-depth-1">
                  <div class="row">
                      <div class="col s12 row valign-wrapper" style="margin-bottom:0">
                          <div class="col s10 m10">
                              <h4 class="title">{{$item->title}}</h4>
                          </div>
                          <div class="col s2 m2">
                            @if ($company->cmpydp == NULL)
                              <img class="cmpimg" src="{{asset('assets/pngs/company.png')}}" alt="">
                            @else
                              <img class="cmpimg" src="{{asset('company/dp/'.$company->cmpydp)}}" alt="">
                            @endif
                          </div>
                      </div>
                      <div class="col s12 row" style="margin-top: 0;margin-bottom: 0;">
                          <div class="col s12" style="margin-bottom: 0;">
                              <h6 class="companyname" style="font-weight: 600;"><a href="{{url('/candidate/company/'.$company->username)}}" class="theme-text">{{$company->cmpyname}}</a></h6>
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
                              <a href="{{url('/login')}}">
                                  View Details 
                                  <i class="material-icons right">arrow_forward</i>
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>   
              @endforeach
        </div>
    </div>
    <style>
      .fixed-action-btn{
        bottom:55px;/*desired value*/
      }
    </style>
    <div class="fixed-action-btn hide-on-large-only">
      <a class="btn-floating btn-large theme modal-trigger" href="#modal4">
        <i class="large material-icons">filter_list</i>
      </a>
    </div>  
    </div>
  </div>
     


      <div id="modal4" class="modal">
        <div class="modal-content">
          <div class="center">
            <div id="sortsec">
              <div>
                <h6>Job Type</h6>
                <div class="left-align">
                  <div>
                    <label>
                      <input type="checkbox" id="internship2"/>
                      <span>Internship</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" id="frjob2"/>
                      <span>Freshers job</span>
                    </label>
                  </div>
                </div>
              </div>
              <div>
                <h6>Sector</h6>
                <div class="left-align">
                  @foreach ($sector as $item)
                    <div>
                      <label>
                        <input type="checkbox" id="{{$item->id + 1000}}" onchange="
                        if(document.getElementById('{{$item->id}}').checked){
                          document.getElementById('{{$item->id}}').checked = false;
                        }
                        else{
                          document.getElementById('{{$item->id}}').checked = true;
                        } 
                        ffsub()
                        "/>
                        <span>{{$item->sector}}</span>
                      </label>
                    </div>
                  @endforeach
                </div>
              </div>
              <div>
                <h6>Time Posted</h6>
                <div class="left-align">
                  <div>
                    <label>
                      <input type="checkbox" id="24hr2"/>
                      <span>Last 24 Hrs</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" id="7d2"/>
                      <span>Last 7 days</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" id="15d2"/>
                      <span>Last 15 days</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" id="30d2"/>
                      <span>Last 30 days</span>
                    </label>
                  </div>
                  <div class="center">
                    <div class="switch" style="margin-top: 15px;">
                      <span style="color: black; font-weight: 600; font-size:15px;">Work From Home </span>
                      <label>
                        <input type="checkbox" name="ori[]" value="Work From Home" id="wfh2">
                        <span class="lever"></span>
                      </label>
                    </div>
                    <div class="switch" style="margin-top: 15px;">
                      <span style="color: black; font-weight: 600; font-size:15px;">Work On Site</span>
                      <label>
                        <input type="checkbox" name="ori[]" value="Work On Site" id="wos2">
                        <span class="lever"></span>
                      </label>
                    </div>  
                  </div>
                  
                </div>
              </div>
              <div>
                <h6>Salary Range</h6>
                <p class="range-field">
                  <label>Min Salary</label>
                  <input type="range" id="test5" value="0" min="0" max="100000" />
                </p>
                <p class="range-field">
                  <label for="">Max Salary</label>
                  <input type="range" id="test5" min="0" value="100000" max="100000" />
                </p>
              </div>
            </div>
          </div>   
        </div>
      </div> 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script>
       
    $(window).resize(function(){
      var window_weight = $(window).width();
          if (window_weight < 980) {
            $('#jobsection').removeClass('s9');
          }
          else
          {
            $('#jobsection').addClass('s9');
          }
    })
    function ffsub(){
      $('#filterform').submit();
    }
   
   $("#internship").change(function() {
      $("#internship2").prop("checked", this.checked);
      ffsub();
   });
   $("#internship2").change(function() {
      $("#internship").prop("checked", this.checked);
      ffsub();
   });
   $("#frjob").change(function() {
      $("#frjob2").prop("checked", this.checked);
      ffsub();
   });
   $("#frjob2").change(function() {
      $("#frjob").prop("checked", this.checked);
      ffsub();
   });
   $("#24hr").change(function() {
      $("#24hr2").prop("checked", this.checked);
      ffsub();
   });
   $("#24hr2").change(function() {
      $("#24hr").prop("checked", this.checked);
      ffsub();
   });
   $("#7d").change(function() {
      $("#7d2").prop("checked", this.checked);
      ffsub();
   });
   $("#7d2").change(function() {
      $("#7d").prop("checked", this.checked);
      ffsub();
   });
   $("#15d").change(function() {
      $("#15d2").prop("checked", this.checked);
      ffsub();
   });
   $("#15d2").change(function() {
      $("#15d").prop("checked", this.checked);
      ffsub();
   });
   $("#30d").change(function() {
      $("#30d2").prop("checked", this.checked);
      ffsub();
   });
   $("#30d2").change(function() {
      $("#30d").prop("checked", this.checked);
      ffsub();
   });
   $("#wfh").change(function() {
      $("#wfh2").prop("checked", this.checked);
      ffsub();
   });
   $("#wfh2").change(function() {
      $("#wfh").prop("checked", this.checked);
      ffsub();
   });
   $("#wos").change(function() {
      $("#wos2").prop("checked", this.checked);
      ffsub();
   });
   $("#wos2").change(function() {
      $("#wos").prop("checked", this.checked);
      ffsub();
   });
   
   $(document).ready(function(){
          var window_weight = $(window).width();
          if (window_weight < 980) {
            $('#jobsection').removeClass('s9');
          }
          else
          {
            $('#jobsection').addClass('s9');
          }
          var jsh = $('#jobsection').outerHeight();
          // console.log(jsh)
          var fls = $('#filtersection')
          fls.css('height', jsh)
                  


        $('#filterform').submit(function(e){
            e.preventDefault();
            // console.log('form submitted')
            let formData = new FormData($('#filterform')[0]);
            // console.log(formData.values());
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"/filterjob",
                data: formData,
                contentType: false,
                processData: false,
                type:'POST',
                success:function(result){
                    // console.log(result.success);
                    console.log(result.query);
                    $('#jobscontainer').html('');
                    $.each(result.success, function(key, item){
                        const cmpy = item.cmpyid;
                        var tmp;
                        $.ajax({
                          async: false,
                          type:"GET",
                          url:"/cmpyget/"+cmpy,
                          dataType:"json",
                          success:function(response){
                            tmp = response;    
                            // console.log(tmp)                        
                          }
                        })
                        if(tmp.company.cmpydp == null){
                          var dp = '/assets/pngs/company.png'
                        }
                        else{
                          var dp = '/company/dp/'+ tmp.company.cmpydp
                        }
                        if(item.stipend == 'on'){
                          var stipend = 'Work Based'
                        }
                        else{
                          var stipend = item.stipend;
                        }
                        $('#jobscontainer').append('\
                            <div class="col s12 m6" id="{{$item->id}}" style="margin-top: 20px;">\
                              <div class="jobbox z-depth-1">\
                                  <div class="row">\
                                      <div class="col s12 row valign-wrapper" style="margin-bottom:0">\
                                          <div class="col s10 m10">\
                                              <h4 class="title"> '+ item.title + ' </h4>\
                                          </div>\
                                          <div class="col s2 m2">\
                                              <img class="cmpimg" src="'+ dp +'" alt="">\
                                          </div>\
                                      </div>\
                                      <div class="col s12 row" style="margin-top: 0;margin-bottom: 0;">\
                                          <div class="col s12" style="margin-bottom: 0;">\
                                              <h6 class="companyname" style="font-weight: 600;"><a href="/candidate/company/'+tmp.company.username+'" class="theme-text">'+tmp.company.cmpyname+'</a></h6>\
                                          </div>    \
                                      </div>\
                                      <div class="col s12" style="margin-top: 0px;">\
                                          <div class="center" style="margin-top: 0;">\
                                              <span class="text" class="center-align">'+item.orientation+'</span>\
                                          </div>\
                                      </div>\
                                      <div class="col s12 row hide-on-med-and-down" style="margin-top: 15px;">\
                                          <div class="col s3 center-align">\
                                              <span class="text"><i class="material-icons inline-icon theme-text">play_circle_filled</i>Start date</span>\
                                            <br>\
                                            <span class="text2">Immidiately</span>\
                                          </div>\
                                          <div class="col s3 center-align"> \
                                              <span class="text"><i class="material-icons inline-icon theme-text">date_range</i>Duration</span>\
                                              <br>\
                                              <span class="text2">'+item.duration+'</span></div>\
                                          <div class="col s3 center-align">\
                                              <span class="text"><i class="material-icons inline-icon theme-text">attach_money</i>Stipend</span>\
                                              <br>\
                                              <span class="text2">'+stipend+'</span>\
                                          </div>\
                                          <div class="col s3 center-align">\
                                              <span class="text"><i class="material-icons inline-icon theme-text">access_time</i>Apply by</span>\
                                              <br>\
                                              <span class="text2">'+item.deadline +'</span>\
                                          </div>\
                                      </div>\
                                      <div class="col s12 row hide-on-large-only" style="margin-top: 15px;">\
                                          <div class="col s6 left-align">\
                                              <span class="text2"><i class="material-icons inline-icon theme-text">play_circle_filled</i>Immidiately</span>\
                                          </div>\
                                          <div class="col s6 left-align"> \
                                              <span class="text2"><i class="material-icons inline-icon theme-text">date_range</i>'+ item.duration +'</span>\
                                              </div>\
                                          <div class="col s6 left-align">\
                                              <span class="text2"><i class="material-icons inline-icon theme-text">attach_money</i>+'+stipend+'+</span>\
                                          </div>\
                                          <div class="col s6 left-align">\
                                              <span class="text2"><i class="material-icons inline-icon theme-text">access_time</i>'+item.deadline+'</span>\
                                          </div>\
                                      </div>\
                                      <div class="col s12 row" style="margin-top: 10px; margin-bottom: 0;">\
                                          <div class="col s6 left-align">\
                                              <span class="jobtype">'+item.type+'</span>\
                                          </div>\
                                          <div class="col s6 right-align">\
                                              <a href="/login">\
                                                  View Details \
                                                  <i class="material-icons right">arrow_forward</i>\
                                              </a>\
                                          </div>\
                                      </div>\
                                  </div>\
                              </div>\
                          </div>  \
                        ');  
                    });

                }
            })
          })
        })
       

  
       
      </script>
@endsection