@extends('employee/layoutcand')

@section('main')
<div class="notification-section section-card" style="min-height: 80vh;">
    <div style="padding: 10px; font-weight: 600;">
        <span class="right btn-flat dropdown-trigger" data-target="dropdown1">
            <i class="material-icons">
                more_vert
            </i>
        </span>
        <h4>Notifications</h4>
        <ul id='dropdown1' class='dropdown-content'>
            <li><a href="{{url('candidate/notifmar')}}" class="black-text"><i class="material-icons theme-text">visibility</i>Mark All as Read</a></li>
            <li><a href="{{url('candidate/notifdel')}}" class="black-text"><i class="material-icons red-text">delete</i>Clear Notifications</a></li>
          </ul>
    </div>
    <div class="notification-inner">
        @foreach ($user[0]->unReadNotifications as $notification)
        @php
            $cmpy = DB::table('companies')->where('id', $notification->data['cmpy'])->first();   
            $job = DB::table('jobs')->where('jobid', $notification->data['job'])->first();
        @endphp
        <a href="{{url('/candidate/notification/'.$notification->id.'/'.$notification->data['job'])}}">
        <div class="notification-item unread">
            <img class="notif-img" src="{{asset('company/dp/'.$cmpy->cmpydp)}}">
            <span class="notif-detail">
                <h2>{{$cmpy->cmpyname}}</h2>
                <p>{{$notification->data['msg']}} <span style="font-weight: 600;">{{$job->title}}</span></p>
                <p style="font-size: 10px; margin-top:2px;"><span class="hide">{{$start = $notification->created_at}}</span>
                    {{date('Y-m-d H:i',strtotime('+5 hour +45 minutes',strtotime($start)));}}</p>
            </span>
        </div>
        </a>
        @endforeach
        @foreach ($user[0]->ReadNotifications as $notification)
        @php
            $cmpy = DB::table('companies')->where('id', $notification->data['cmpy'])->first();   
            $job = DB::table('jobs')->where('jobid', $notification->data['job'])->first();   
        @endphp
        <a href="{{url('/candidate/job/'.$notification->data['job'])}}" class="black-text">
            <div class="notification-item">
                <img class="notif-img" src="{{asset('company/dp/'.$cmpy->cmpydp)}}">
                <span class="notif-detail">
                    <h2>{{$cmpy->cmpyname}}</h2>
                    <p>{{$notification->data['msg']}} <span style="font-weight: 600;">{{$job->title}}</span></p>
                    <p style="font-size: 10px; margin-top:2px;"><span class="hide">{{$start = $notification->created_at}}</span>
                        {{date('Y-m-d H:i',strtotime('+5 hour +45 minutes',strtotime($start)));}}</p>
                </span>
            </div>
        </a>
        @endforeach

    </div>
</div>
@endsection