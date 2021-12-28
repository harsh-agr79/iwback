<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <link rel="icon" href="{{asset('assets/images/icon.png')}}">
    <style>
        ::-webkit-scrollbar{
            display: none;
        }
        /* ::-webkit-scrollbar-thumb{
            width:2px;
            background-color: #0082cc;
        } */
        .chat-msg-section-mobile{
            height:calc(100%)!important;
        }
        .msg-send-form-mobile{
            position:fixed!important;
            background-color: white;
            bottom:0;
            left:0;
            padding:10px 0;
            width: 100vw!important;
        }
    </style>
</head>
<body style="background: white;">
    <div class="notification-drop">
        <div style="padding: 10px; font-weight: 600;">
            <span class="right btn-flat dropdown-trigger" data-target="dropdown1">
                <i class="material-icons">
                    more_vert
                </i>
            </span>
            <h6>Notifications</h6>
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
                @if ($cmpy->cmpydp == NULL)
                <img class="notif-img" src="{{asset('assets/pngs/company.png')}}">
                @else
                <img class="notif-img" src="{{asset('company/dp/'.$cmpy->cmpydp)}}">
                @endif
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
                    @if ($cmpy->cmpydp == NULL)
            <img class="notif-img" src="{{asset('assets/pngs/company.png')}}">
            @else
            <img class="notif-img" src="{{asset('company/dp/'.$cmpy->cmpydp)}}">
            @endif
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
    <div class="main-container" style="height: 100vh; overflow:hidden" >
       
        <div class="chat-msg-section" style="height: 95%;">
            <div class="msg-header">
                <i onclick="goBack()" class="material-icons left">arrow_back</i>
                <script>
                    function goBack() {
                      window.history.back();
                      
                    }
                  </script>
                <div class="msg-info">
                    @if ($cmpy2->cmpydp == NULL)
                    <img class="cd-dp" src="{{asset('assets/pngs/company.png')}}">
                    @else
                    <img class="cd-dp" src="{{asset('company/dp/'.$cmpy2->cmpydp)}}">
                    @endif
                    <h1 class="cd-name">{{$cmpy2->cmpyname}}</h1>
                </div>
                <i class="material-icons">info</i>
            </div>
            <div class="msg-send-section chat-msg-section-mobile">
                <div class="chat-content">
                    @foreach ($chats as $item)
                    @if ($item->sid == $user[0]->id)
                    <div class="sent_msg">
                        <p>{{$item->msg}}</p>
                    </div>
                    @else
                    <div class="received_msg">
                        <p>{{$item->msg}}</p>
                    </div>
                    @endif
                @endforeach
                </div>
                <div style="height: 60px;">

                </div>
            </div>
        <form id="chatform" style="width: 100%; margin:0; padding:0">
            <div class="msg-send-form msg-send-form-mobile">
                {{-- <i class="material-icons">
                    insert_photo
                </i> --}}
                <input type="text" placeholder="Aa" autocomplete="off" class="form-control browser-default msg-send-input"  style="margin-left:3vw;" id="chatInput" name="msg">
                <input type="hidden" name="sid" id="sid" value="{{$user[0]->id}}">
                <input type="hidden" name="sty" id="sty" value="cand">
                <input type="hidden" name="rid" id="rid" value="{{$cmpy2->id}}">
                <input type="hidden" name="rty" id="rty" value="cmpy">
                <input type="hidden" name="cid" id="cid" value="{{$cmpy2->id}}{{$user[0]->id}}">
                <i class="material-icons left" id="send">send</i>
            </div>
        </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.socket.io/4.4.0/socket.io.min.js" integrity="sha384-1fOn6VtTq3PWwfsOrk45LnYcGosJwzMHv+Xh/Jx5303FVOXzEnw0EpLv30mtjmlj" crossorigin="anonymous"></script>
    <script>
       
        $(function(){
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port);

            let chatInput = $('#chatInput');

            function sendmessage(e) {
                    e.preventDefault();
                    chatInput.focus();
                    var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
                                        msgSection.scrollTo(0, msgSection.scrollHeight)
                              let obj = '{"messages":[' +
                                      '{"sid":"'+$('#sid').val() +'","sty":"'+ $('#sty').val() +'","rid":"'+ $('#rid').val() +'","rty":"'+ $('#rty').val() +'","msg":"'+ $('#chatInput').val() +'" }' +
                                      ']}';
                              const message = JSON.parse(obj);
                              $.ajax({
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url:"/addchatcand",
                                    data:$('#chatform').serialize(),
                                    type:'post',
                                    success:function(response){
                                        socket.emit('sendChatToServer', message);
                                        chatInput.val('');
                                        return false;
                                        var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
                                        msgSection.scrollTo(0, msgSection.scrollHeight)
                                    }
                                  })
                                // });
            }
            chatInput.keypress(function(e) {
                if(e.which == 13 && !e.shiftKey){
                    sendmessage(e)
                }
            });

            $('#send').on('click', function(e) {
                sendmessage(e)
            })


            

            socket.on('sendChatToClient', (message) => {
                if($('#sid').val() == message.messages[0].sid && message.messages[0].sty == 'cand' && $('#rid').val() == message.messages[0].rid && message.messages[0].rty == 'cmpy'){
                    // console.log($('#sid').val())
                    $('.chat-content').append(`<div class="sent_msg"><p>${message.messages[0].msg}</p></div>`);
                    var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
                                        msgSection.scrollTo(0, msgSection.scrollHeight)
                }
                else if($('#rid').val() == message.messages[0].sid && message.messages[0].sty == 'cmpy' && $('#sid').val() == message.messages[0].rid && message.messages[0].rty == 'cand'){
                    // console.log($('#sid').val())
                    $('.chat-content').append(`<div class="received_msg"><p>${message.messages[0].msg}</p></div>`);
                    var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
                                        msgSection.scrollTo(0, msgSection.scrollHeight)
                }
            });
        })
    </script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="{{asset('assets/dashboard.js')}}"></script>
<script>
    var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
    msgSection.scrollTo(0, msgSection.scrollHeight)

    const notificationDrop = document.querySelector('.notification-drop')

    const notif = (e) => {
        notificationDrop.classList.toggle('show')

        if(!e.target.classList.contains('notification-drop')){
            notificationDrop.classList.remove('show')
        }
    }
</script>
</html>