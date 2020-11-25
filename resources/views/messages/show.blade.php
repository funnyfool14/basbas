@extends('commons.layouts')
@section('content')
    {{--  チャットルーム  --}}
    <div id="room">
        @foreach($messages as $chat)
            {{--   送信したメッセージ  --}}
            @if($chat->send == \Illuminate\Support\Facades\Auth::id())
                <div class="send" style="text-align: right">
                    <p>{{$message->message}}</p>
                </div>
            @endif    
            {{--   受信したメッセージ  --}}
            @if($chat->recieve == \Illuminate\Support\Facades\Auth::id())
                <div class="recieve" style="text-align: left">
                    <p>{{$chat->message}}</p>
                </div>
            @endif
        @endforeach
    </div>
    {!!Form::model($message,['route'=>'messages.store'])!!}
    {!!Form::text('name',null,['class'=>'form-control'])!!}
    {!!Form::submit('send',['class'=>'text text-primary'])!!}
    {!!Form::close()!!}
@endsection(‘content’)