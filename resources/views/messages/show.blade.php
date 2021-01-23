@extends('commons.layouts')
@section('content')
    {{--メッセージ確認--}}
    <div id="room">
        <div class="row bg-info mb-5">
            <h4>{{$reciever->firstName}}</h4>
            <h4 class="ml-2">{{$reciever->lastName}}</h4>
        </div>            
        @foreach($messages as $message)
            @if($message->user_id==Auth::id())
                <div class="text-right">
                    <h3 class="mb-5 mr-5">{{$message->message}}</h3>
                </div>
            @endif
            @if($message->user_id==Auth::id())
                <div class="text-left">
                    <h3 class="mb-5 ml-5">{{$message->message}}</h3>
                </div>
            @endif
        @endforeach
    </div>
    {{--メッセージ送信--}}
    {!!Form::open(['route'=>['messages.store',$reciever->id],'method'=>'post'])!!}
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