@extends('company/layoutcmpy')

@section('main')
<div class="main-chat-ui">
    <div class="chat-cd-search-section">
        <div class="chat-title-section">
            <h2>Messages</h2>
            <i class="material-icons">settings</i>
        </div>
        <div class="chat-search-bar">
            <input type="search" class="form-control search-cd-chat" placeholder="Search Candidates" name="search"id="search">
        </div>
        
        <div class="cd-list-section">
            
            @foreach ($chaters as $item)
                @php
                $chaterid ='';
                if ($item->rid == $user[0]->id) {
                    $chaterid = $item->sid;
                }
                else {
                    $chaterid = $item->rid;
                }
                    $cand = DB::table('employees')->where('id', $chaterid)->first();
                    $sid = $item->sid;
                    $rid = $item->rid;
                    $lastmsg = DB::table('chats')->where(['sid'=>$item->sid, 'rid'=>$item->rid])->orWhere(function($query) use ($sid, $rid){
                        $query->where(['rid'=>$sid, 'sid'=>$rid]);
                    })->orderBy('id', 'desc')->first();
                @endphp
                @if ($active == $chaterid)
                    <span class="hide">{{$act = 'active'}}</span>
                @else
                    <span class="hide">{{$act = ''}}</span>
                @endif
                <a href="{{url('company/messages/'.$chaterid)}}" class="black-text">
                <div class="cd-list-item {{$act}}">
                    @if ($cand->canddp == NULL)
                    <img src="{{asset('assets/pngs/candidate.png')}}" class="cd-dp">
                    @else
                    <img src="{{asset('candidate/dp/'.$cand->canddp)}}" class="cd-dp">
                    @endif
                    <div class="cd-info">
                        <h1 class="cd-name">{{$cand->firstname}} {{$cand->lastname}}</h1>
                        <span class="recent-msg" id="{{$item->rid}}">{{$lastmsg->msg}}</span>
                    </div>
                </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="chat-msg-section">
        @if ($active == '0')
            No Messages
        @else
        @php
        $cand2 = DB::table('employees')->where('id',$active)->first();   
       @endphp
       <div class="msg-header">
           <div class="msg-info">
               @if ($cand2->canddp == NULL)
                   <img src="{{asset('assets/pngs/candidate.png')}}" class="cd-dp">
                   @else
                   <img src="{{asset('candidate/dp/'.$cand2->canddp)}}" class="cd-dp">
                   @endif
               <h1 class="cd-name">{{$cand2->firstname}} {{$cand2->lastname}}</h1>
           </div>
           <i class="material-icons">info</i>
       </div>
       <div class="chat-content msg-send-section">
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
       <form id="chatform" style="width: 100%; margin:0; padding:0">
           <div class="msg-send-form">
               {{-- <i class="material-icons">
                   insert_photo
               </i> --}}
               <input type="text" autocomplete="off" placeholder="Aa" class="form-control browser-default msg-send-input"  style="margin-left:3vw;" id="chatInput" name="msg">
               <input type="hidden" name="sid" id="sid" value="{{$user[0]->id}}">
               <input type="hidden" name="sty" id="sty" value="cmpy">
               <input type="hidden" name="rid" id="rid" value="{{$cand2->id}}">
               <input type="hidden" name="rty" id="rty" value="cand">
               <input type="hidden" name="cid" id="cid" value="{{$user[0]->id}}{{$cand2->id}}">
               <i class="material-icons left" id="send">send</i>
           </div>
       </form>
        @endif
        
    </div>
    <div class="chat-settings-section">
        @if ($active == '0')
            No Messages
        @else
        @if ($cand2->canddp == NULL)
        <img src="{{asset('assets/pngs/candidate.png')}}" class="cd-dp-set">
        @else
        <img src="{{asset('candidate/dp/'.$cand2->canddp)}}" class="cd-dp-set">
        @endif
        <div class="chat-set-search-div">
            {{-- <i class="material-icons">search</i> --}}
            <a href="{{url('company/candidate/'.$cand2->username)}}">{{$cand2->firstname}} {{$cand2->lastname}}</a>
        </div>
        {{-- <div class="chat-set-searchBox">
            <input type="search" name="chat-search" placeholder="Search" class="browser-default" id="search-msgs">
        </div> --}}
        {{-- <div class="report-btn">
            <i class="material-icons">report_problem</i>
            <p>Report Candidate</p>
        </div> --}}
        @endif
        
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
                              let obj = '{"messages":[' +
                                      '{"sid":"'+$('#sid').val() +'","sty":"'+ $('#sty').val() +'","rid":"'+ $('#rid').val() +'","rty":"'+ $('#rty').val() +'","msg":"'+ $('#chatInput').val() +'" }' +
                                      ']}';
                              const message = JSON.parse(obj);
                              $.ajax({
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url:"/addchatcmpy",
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
                if($('#sid').val() == message.messages[0].sid && message.messages[0].sty == 'cmpy' && $('#rid').val() == message.messages[0].rid && message.messages[0].rty == 'cand'){
                    // console.log($('#sid').val())
                    $('.chat-content').append(`<div class="sent_msg"><p>${message.messages[0].msg}</p></div>`);
                    $(`#${message.messages[0].rid}`).text(`${message.messages[0].msg}`)
                    $(`#${message.messages[0].sid}`).text(`${message.messages[0].msg}`)
                    var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
                                        msgSection.scrollTo(0, msgSection.scrollHeight)
                }
                else if($('#rid').val() == message.messages[0].sid && message.messages[0].sty == 'cand' && $('#sid').val() == message.messages[0].rid && message.messages[0].rty == 'cmpy'){
                    // console.log($('#sid').val())
                    $('.chat-content').append(`<div class="received_msg"><p>${message.messages[0].msg}</p></div>`);
                    $(`#${message.messages[0].rid}`).text(`${message.messages[0].msg}`)
                    $(`#${message.messages[0].sid}`).text(`${message.messages[0].msg}`)
                    var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
                                        msgSection.scrollTo(0, msgSection.scrollHeight)
                }
                else if(message.messages[0].rid == $('#sid').val() && message.messages[0].sty == 'cand')
                {
                    // $(`#${message.messages[0].rid}`).text(`${message.messages[0].msg}`)
                    $(`#${message.messages[0].sid}`).text(`${message.messages[0].msg}`)
                }
            });
        })
    </script>
<script>
    var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
    var srcTxt = document.querySelector('.chat-set-search-div')
    var srcInput = document.querySelector('#search-msgs')
    msgSection.scrollTo(0, msgSection.scrollHeight)

    srcTxt.addEventListener('click', () => {
        srcInput.classList.toggle('active')
    })
</script>
@endsection