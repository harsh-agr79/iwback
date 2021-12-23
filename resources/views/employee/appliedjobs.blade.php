@extends('employee/layoutcand')
@section('main')
<div class="main-content">
    <section class="left-section">
        <div class="posted-jobs">
            <h1>Jobs Applied</h1>
            <div class="posted-job-box">
                @foreach ($appliedjobs as $item)
                    @php
                        $job = DB::table('jobs')->where('jobid',$item->jobid)->first();   
                        $company = DB::table('companies')->where('id',$item->cmpyid)->first();   
                    @endphp
              <div class="jobbox z-depth-1">
                  <div class="row">
                      <div class="col s12 row valign-wrapper" style="margin-bottom:0">
                          <div class="col s10 m10">
                              <h4 class="title">{{$job->title}}</h4>
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
                              <span class="text" class="center-align">{{$job->orientation}}</span>
                          </div>
                      </div>
                      <div class="col s12 row" style="margin-top: 15px;">
                          <div class="col s12 center-align">
                             
                              @if($item->hired == 'on')
                                  Status: You have been hired
                                @elseif ($item->shortlist == 'on')
                                  Status: You have been shortlisted
                              @else
                                 Status: Proposal Sent
                              @endif
                          </div>
                      </div>
                      <div class="col s12 row" style="margin-top: 10px; margin-bottom: 0;">
                          <div class="col s6 left-align">
                              <span class="jobtype">{{$job->type}}</span>
                          </div>
                          <div class="col s6 right-align">
                              <a href="{{url('/candidate/job/'.$job->jobid)}}">
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
            <a href="{{url('candidate/findjobs')}}">
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
            <a class="tab-menu" href="{{url('candidate/appliedjobs')}}">
                <i class="material-icons">business_center</i>
                <p class="menu-text">Jobs Applied</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{url('/candidate/savedcompanies')}}">
                <i class="material-icons">groups</i>
                <p class="menu-text">Saved Companies</p>
            </a>
            <div class="divider"></div>
            <a class="tab-menu" href="{{'/candidate/settings'}}">
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
@endsection
