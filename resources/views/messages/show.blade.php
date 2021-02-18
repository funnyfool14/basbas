@extends('commons.layouts')
@section('content')
    {{--メッセージ確認--}}
    <div class="row bg-info mb-5">
        <h4>{{$reciever->firstName}}</h4>
        <h4 class="ml-2">{{$reciever->lastName}}</h4>
    </div>
    {!!Form::open(['route'=>['messages.store',$user_id],'method'=>'post'])!!}
    <div class="row mb-5">
        <div class="col-10">
            {!!Form::text('message',null,['class'=>'form-control'])!!}
        </div>    
        <div class="col-2">    
            {!!Form::submit('send',['class'=>'btn btn-outline-primary btn-block'])!!}
        </div>    
    </div>
    {!!Form::close()!!}
    <div id="room">    
        {!!$messages->links()!!}
        @foreach($messages as $message)
            @if($message->own_id==Auth::id())
                <div class="text-right">
                    <h3 class="mb-5 mr-5">{{$message->message}}</h3>
                </div>
            @endif
            @if($message->own_id==$user_id)
                <div class="text-left">
                    <h3 class="mb-5 ml-5">{{$message->message}}</h3>
                </div>
            @endif
        @endforeach
    </div>
@endsection(‘content’)