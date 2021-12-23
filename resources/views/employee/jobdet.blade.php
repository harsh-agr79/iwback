@extends('employee/layoutcand')

@section('main')
@php
    $company = DB::table('companies')->where('id',$job[0]->cmpyid)->get();
@endphp
    <div class="self-contain">
        <div class="detpg">
          <div class="row detpgch">
              <div class="col s12 row valign-wrapper" style="margin-bottom:0">
                  <div class="col s10 m10">
                      <h4 class="title">{{$job[0]->title}}</h4>
                  </div>
                  <div class="col s2 m2">
                      <img class="cmpimg" src="{{asset('company/dp/'.$company[0]->cmpydp)}}" alt="">
                  </div>
              </div>
              <div class="col s12 row" style="margin-top: 0;margin-bottom: 0;">
                  <div class="col s12" style="margin-bottom: 0;">
                      <h6 class="companyname" style="font-weight: 600;"><a href="{{url('/candidate/company/'.$company[0]->username)}}" class="theme-text">{{$company[0]->cmpyname}}</a></h6>
                  </div>    
              </div>
              <div class="col s12" style="margin-top: 0px;">
                  <div class="center" style="margin-top: 0;">
                      <span class="text" class="center-align">{{$job[0]->orientation}}</span>
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
                      <span class="text2">{{$job[0]->duration}}</span></div>
                  <div class="col s3 center-align">
                    <span class="text"><i class="material-icons inline-icon theme-text">attach_money</i>Stipend</span>
                      <br>
                      <span class="text2">@if ($job[0]->stipend == 'on')
                        Work Based
                    @else
                    {{$job[0]->stipend}}</span>
                    @endif</span>
                  </div>
                  <div class="col s3 center-align">
                    <span class="text"><i class="material-icons inline-icon theme-text">access_time</i>Apply by</span>
                      <br>
                      <span class="text2">{{$job[0]->deadline}}</span>
                  </div>
              </div>
              <div class="col s12 row hide-on-large-only" style="margin-top: 15px;">
                <div class="col s6 left-align">
                   <span class="text2"><i class="material-icons inline-icon theme-text">play_circle_filled</i>Immidiately</span>
                </div>
                <div class="col s6 left-align"> 
                    <span class="text2"><i class="material-icons inline-icon theme-text">date_range</i>{{$job[0]->duration}}</span>
                  </div>
                <div class="col s6 left-align">
                  <span class="text2"><i class="material-icons inline-icon theme-text">attach_money</i>@if ($job[0]->stipend == 'on')
                    Work Based
                @else
                {{$job[0]->stipend}}</span>
                @endif
                </div>
                <div class="col s6 left-align">
                    <span class="text2"><i class="material-icons inline-icon theme-text">access_time</i>{{$job[0]->deadline}}</span>
                </div>
            </div>
              <div class="col s12 row" style="margin-top: 10px; margin-bottom: 0;">
                <div class="col s6 left-align">
                  <span class="jobtype">{{$job[0]->type}}</span>
                </div>
                <div class="col s6 right-align">
                  <a href=""><i class="material-icons right">share</i></a>
                  {{-- <a href=""><i class="material-icons right">turned_in_not</i></a> --}}
                </div>
              </div>
          </div>
          {{-- <div class="container"> --}}
              <hr>
          {{-- </div> --}}
          <div class="self-contain2">
              <div  class="left-align"><h4>About {{$company[0]->cmpyname}}</h4></div>
              <div  class="left-align"><a href="https://{{$company[0]->website}}" target="_blank" class="btn-flat blue-text">Website <i class="material-icons right">open_in_new</i></a></div>
              <div class="left-align">{{$company[0]->about}}</div>
          </div>
          <div class="activity">
              <h6 style="font-weight: 600;">Activity on Internwheel</h6>
              <div class="row">
                  <div class="col s12 m4"><span> <i class="material-icons left theme-text">today</i> Hiriring Since July 2021</span></div>
                  <div class="col s12 m4"><i class="material-icons left theme-text">work</i>{{$job->count()}} Opportunities posted</div>
                  <div class="col s12 m4"><i class="material-icons left theme-text">account_box</i>1 Candidate Hired</div>
              </div>
          </div>
          <div class="self-contain2" style="margin-top: 5vh;">
              <h5 style="font-weight: 600;" class="left-align">About The {{$job[0]->type}}</h5>
              <div>
<pre style="font-family: sans-serif; font-size: 15px;">{{$job[0]->aboutjob}}</pre>
              </div>
          </div>
          <div class="self-contain2" style="margin-top: 5vh;">
              <h5 class="left-align" style="font-weight: 600;">Skills Required</h5>
              <div class="row">
                  @php
                        $skill = explode('|',$job[0]->skills);
                        $perks = explode('|',$job[0]->perks);
                  @endphp
                  @foreach ($skill as $item)
                    @if($item == NULL)
                    @else
                        <div class="col center-align tags">{{$item}}</div>
                    @endif
                  @endforeach
              </div>
          </div>
          <div class="self-contain2" style="margin-top: 5vh;">
              <h5 style="font-weight: 600;" class="left-align">Who Can Apply</h5>
              <div>
<pre style="font-family: sans-serif; font-size: 15px;">{{$job[0]->jobrequirements}}</pre>
              </div>
          </div>
          <div class="self-contain2" style="margin-top: 5vh;">
              <h5 class="left-align" style="font-weight: 600;">Perks</h5>
              <div class="row">
                  @foreach ($perks as $item)
                    @if($item == NULL)
                    @else
                  <div class="col tags">{{$item}}</div>
                    @endif
                  @endforeach
              </div>
          </div>
          <div class="self-contain2" style="margin-top: 5vh;">
              <h5 class="left-align" style="font-weight: 600;">Number Of openings: {{$job[0]->openings}}</h5>
          </div>
          {{$dis=''}}
          @foreach ($applied as $item)
              @if ($item->candid == $user[0]->id)
                  <span class="hide">{{$dis = 'disabled'}}</span>
              @endif
          @endforeach

          @if ($dis == 'disabled')
          <div class="center" style="margin-top: 5vh;">
            <button class="btn-large waves-effect waves-light grey modal-trigger" onclick="M.toast({html: 'You already applied to this job'})" style="font-weight: 500; border-radius: 30px; font-size: 1.5rem;">Apply Now</button>
        </div>
      </div>
  </div>
          @else
          <div class="center" style="margin-top: 5vh;">
            <button class="btn-large waves-effect waves-light theme modal-trigger tooltipped" href="#apply-modal" style="font-weight: 500; border-radius: 30px; font-size: 1.5rem;">Apply Now</button>
        </div>
      </div>
  </div>

  <div id="apply-modal" class="modal">
      <div class="modal-content">
        <h4 class="center">
          Write a Proposal
        </h4>
        <form action="{{route('apply')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="candid" value="{{$user[0]->id}}">
          <input type="hidden" name="cmpyid" value="{{$company[0]->id}}">
          <input type="hidden" name="jobid" value="{{$job[0]->jobid}}">
            <textarea required name="proposal" id="proposal" maxlength="1500" style="height: 50px;" rows="30"></textarea>
            <span style="font-size: 10px; text-align:center;">tip: make sure your prorfile is updated before applying, Organization's will see your profile as resume while veiwing your application</span>
            <div class="center">
              <button class="btn waves-effect waves-light theme">Apply</button>
            </div>
        </form>
      </div>
          @endif
          
      </div>


@endsection