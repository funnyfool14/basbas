@extends('commons.layouts')
@section('content')
    @foreach($chats as $chat)
        {{$chat->user_id}}
       {{-- @foreach($user->chats as $chat )
        @foreach($chat->latestMessage as $message)
        <div class="row mt-4">
            <div class="row col-3">
                <h2>{!!$user->firstName!!}</h2>
                <h2 class="ml-2">{!!$user->lastName!!}</h2>
            </div>
            <div class="col-9">
                <h2 class="">{{$message->message}}</h2>                
            </div>
        </div>
        @endforeach
        @endforeach--}}
    @endforeach
    {{--<div class="">
        {{$chat->sender->firstName}}
        <div class="col-3">
            {!!link_to_route('messages.show','message',['id'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!}
        </div>
        <div class="col-3">
            {!!link_to_route('users.show','check',[$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
        </div>
	</div>--}}
@endsection(‘content’)