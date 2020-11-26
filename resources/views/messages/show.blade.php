@extends('commons.layouts')
@section('content')
    {{--メッセージ確認--}}
    <div id="room">
        @foreach($messages as $message)
            @if($message->send==Auth::id())
                <div class="send" style="text-align: right">
                    <p>{{$message->message}}</p>
                </div>
            @endif
            @if($message->recieve==Auth::id())
                <div class="recieve" style="text-align: left">
                    <p>{{$message->message}}</p>
                </div>
            @endif
        @endforeach
    </div>
    {{--メッセージ送信--}}
    {!!Form::open(['route'=>['messages.store',$reciever_id],'method'=>'post'])!!}
    <div class="row">
        <div class="col-10">
            {!!Form::text('message',null,['class'=>'form-control'])!!}
        </div>    
        <div class="col-2">    
            {!!Form::submit('send',['class'=>'btn btn-outline-primary btn-block'])!!}
        <div>    
    </div>
    {!!Form::close()!!}
@endsection(‘content’)