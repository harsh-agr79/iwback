@extends('company/layoutcmpy')


@section('main')
<style>
    ::-webkit-scrollbar{
        width:10px;
    }
    ::-webkit-scrollbar-thumb{
        width:2px;
        background-color: #0082cc;
    }
    .cd-list-mobile{
        height:calc(100vh - 230px)!important;
    }
</style>
<div class="chat-cd-list-mobile">
    <div class="chat-cd-search-section">
        <div class="chat-title-section">
            <h2>Messages</h2>
            <i class="material-icons">settings</i>
        </div>
        <div class="chat-search-bar">
            <input type="search" class="form-control search-cd-chat" placeholder="Search Candidates" name="search"id="search">
        </div>
        <div class="cd-list-section cd-list-mobile">
            @foreach ($chaters as $item)
                @php
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
                {{-- @if ($active == $item->rid)
                    <span class="hide">{{$act = 'active'}}</span>
                @else
                    <span class="hide">{{$act = ''}}</span>
                @endif --}}
                <a href="{{url('company/msgs/'.$chaterid)}}" class="black-text">
                <div class="cd-list-item">
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
</div>
<input type="hidden" id="sid" value="{{$user[0]->id}}">
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
                                        // var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
                                        // msgSection.scrollTo(0, msgSection.scrollHeight)
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
                    // var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
                    //                     msgSection.scrollTo(0, msgSection.scrollHeight)
                }
                else if($('#rid').val() == message.messages[0].sid && message.messages[0].sty == 'cand' && $('#sid').val() == message.messages[0].rid && message.messages[0].rty == 'cmpy'){
                    // console.log($('#sid').val())
                    $('.chat-content').append(`<div class="received_msg"><p>${message.messages[0].msg}</p></div>`);
                    $(`#${message.messages[0].rid}`).text(`${message.messages[0].msg}`)
                    $(`#${message.messages[0].sid}`).text(`${message.messages[0].msg}`)
                    // var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
                    //                     msgSection.scrollTo(0, msgSection.scrollHeight)
                }
                else if(message.messages[0].rid == $('#sid').val() && message.messages[0].sty == 'cand')
                {
                    // $(`#${message.messages[0].rid}`).text(`${message.messages[0].msg}`)
                    $(`#${message.messages[0].sid}`).text(`${message.messages[0].msg}`)
                }
            });
        })
    </script>
{{-- <script>
    var msgSection = document.querySelector('.chat-msg-section .msg-send-section')
    var srcTxt = document.querySelector('.chat-set-search-div')
    var srcInput = document.querySelector('#search-msgs')
    msgSection.scrollTo(0, msgSection.scrollHeight)

    srcTxt.addEventListener('click', () => {
        srcInput.classList.toggle('active')
    })
</script> --}}
@endsection