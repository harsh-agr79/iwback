@extends('employee/layoutcand')

@section('main')
    <!-- <div id="sort" class="hide-on-med-and-down"> -->
      {{-- <div class="row white hide-on-med-and-down z-depth-1" style="width:100%; z-index: 2; position:fixed;">
        <div class="input-field col s2">
          <select multiple>
            <option value="" disabled selected class="white-text">Job Type</option>
            <option value="1">Internship</option>
            <option value="2">Freshers</option>
            <option value="3">Full Time</option>
          </select>
          <!-- <label>Materialize Multiple Select</label> -->
        </div>
        <div class="input-field col s2">
          <select multiple>
            <option value="" disabled selected class="white-text">Time Job Posted</option>
            <option value="1">Last 24 Hrs</option>
            <option value="2">Last 7 Days</option>
            <option value="3">Last 15 days</option>
            <option value="3">Last 30 days</option>
          </select>
          <!-- <label>Materialize Multiple Select</label> -->
        </div>
        <div class="input-field col s2">
          <select multiple>
            <option value="" disabled selected class="white-text">Sector</option>
            <option value="1">Sales</option>
            <option value="2">Marketing</option>
            <option value="3">Finance</option>
            <option value="3">Coding</option>
            <option value="3">Designing</option>
          </select>
          <!-- <label>Materialize Multiple Select</label> -->
        </div>
        <div class="input-field col s2">
          <span>min salary</span>
          <p class="range-field">
            <input type="range" id="test5" min="0" max="100" />
          </p>
        </div>
        <div class="input-field col s2">
          <span>max salary</span>
          <p class="range-field">
            <input type="range" id="test5" min="0" max="100" />
          </p>
        </div>
        
      </div>   --}}
    <!-- </div> -->
  {{-- <div class="hide-on-med-and-down" style="height: 13vh">

  </div> --}}

  <div class="row">
    <div class="col s3 hide-on-med-and-down" id="filtersection" style="position: relative">
      <div id="sortsec" class="white z-depth-2" style="border-radius: 20px; height:65vh; overflow-y: scroll; overflow-x:hidden; width:23vw; margin-top:20px;">
        <div>
          <h6>Job Type</h6>
          <div class="left-align">
            <div>
              <label>
                <input type="checkbox" />
                <span>Internship</span>
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" />
                <span>Freshers job</span>
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" />
                <span>Jobs</span>
              </label>
            </div>
          </div>
        </div>
        <div>
          <h6>Sector</h6>
          <div class="left-align">
            <div>
              <label>
                <input type="checkbox" />
                <span>Sales</span>
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" />
                <span>Marketing</span>
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" />
                <span>Coding</span>
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" />
                <span>Finance</span>
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" />
                <span>Designing</span>
              </label>
            </div>
          </div>
        </div>
        <div>
          <h6>Job Type</h6>
          <div class="left-align">
            <div>
              <label>
                <input type="checkbox" />
                <span>Time Posted</span>
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" />
                <span>Last 24 Hrs</span>
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" />
                <span>Last 7 days</span>
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" />
                <span>Last 15 days</span>
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" />
                <span>Last 30 days</span>
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
      </div>
    </div>
    <div class="col s9" id="jobsection">
      <div id="main" style="min-height: 100vh; z-index:0;">
        <div class="row self-contain">
              @foreach ($jobs as $item)
          <div class="col s12 m6" style="margin-top: 20px;">
              <div class="jobbox z-depth-1">
                  <div class="row">
                      <div class="col s12 row valign-wrapper" style="margin-bottom:0">
                          <div class="col s10 m10">
                              <h4 class="title">{{$item->title}}</h4>
                          </div>
                          <div class="col s2 m2">
                              {{-- <img class="cmpimg" src="{{asset('company/dp/'.$company[0]->cmpydp)}}" alt=""> --}}
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
                      <input type="checkbox" />
                      <span>Internship</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Freshers job</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Jobs</span>
                    </label>
                  </div>
                </div>
              </div>
              <div>
                <h6>Sector</h6>
                <div class="left-align">
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Sales</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Marketing</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Coding</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Finance</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Designing</span>
                    </label>
                  </div>
                </div>
              </div>
              <div>
                <h6>Job Type</h6>
                <div class="left-align">
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Time Posted</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Last 24 Hrs</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Last 7 days</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Last 15 days</span>
                    </label>
                  </div>
                  <div>
                    <label>
                      <input type="checkbox" />
                      <span>Last 30 days</span>
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
            </div>
          </div>   
        </div>
      </div> 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script>
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
          console.log(jsh)
          var fls = $('#filtersection')
          fls.css('height', jsh)
        })
       

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
  
       
      </script>
@endsection