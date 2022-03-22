<div id="room">    
    {!!$messages->links()!!}
    @foreach($messages as $message)
        @if($message->user_id==Auth::id())
            <div class="text-right">
                <h3 class="mr-5">{!!nl2br(e($message->message))!!}</h3>
                <h5>{{Auth::user()->firstName.' '.Auth::user()->lastName}}</h5>
            </div>
        @endif
        @if($message->user_id!=Auth::id())
            <div class="text-left">
                <h3 class="mb-5 ml-5">{{$message->message}}</h3>
                <h5>{{$message->user()->firstName.' '.$message->user()->lastName}}</h5>
            </div>
        @endif
    @endforeach
</div>