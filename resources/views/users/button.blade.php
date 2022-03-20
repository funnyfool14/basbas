
<aside class="col-sm-4">                    
    @if($user!=Auth::user())
        {{--リクエストを送る--}}
        <div class="mt-2">
            {!!link_to_route('request.friend','request',['id'=>$user->id],['class'=>'btn btn-outline-success btn-block'])!!}
        </div>
        {{--メッセージ--}}
        <div class="mt-2">
            {!!link_to_route('messages.show','message',['id'=>$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
        </div>
        {{---フレンド一覧--}}
        <div class="mt-2">
            {!!link_to_route('friend.index','friends',['id'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!}
        </div>
    @endif
</aside>