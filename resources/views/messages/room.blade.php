<div id="room">    
    {!!$messages->links()!!}
    @foreach($messages as $message)
        @if($message->user_id==$own_id)
            <div class="text-right">
                <h3 class="mb-5 mr-5">{{$message->message}}</h3>
                </div>
        @endif
        @if($message->user_id==$user_id)
            <div class="text-left">
                <h3 class="mb-5 ml-5">{{$message->message}}</h3>
            </div>
        @endif
    @endforeach
</div>