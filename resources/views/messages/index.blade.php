@extends('commons.layouts')
@section('content')
    @foreach($chats as $chat)
        @foreach($chat->chat_user() as $user)
            <div class="row mt-5">
                <div class="row col-sm-4">
                    <h2>{!!$user->firstName!!}</h2>
                    <h2 class="ml-2">{!!$user->lastName!!}</h2>
                </div>
                <h4 class="col-8">{{$chat->latest_message}}</h4>
            </div>
                <div class="mt-1 row">
                    <div class="col-3">
                        {!!link_to_route('users.show','check',[$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
                    </div>
                    <div class="offset-1 col-3">
                        {!!link_to_route('messages.show','message',['id'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!}
                    </div>
                    <p class="right">{{$chat->dates()}}</p>
                </div>
        @endforeach
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