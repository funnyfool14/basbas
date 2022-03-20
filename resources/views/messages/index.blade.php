@extends('commons.layouts')
@section('content')
    @foreach($chats as $chat)
        @foreach($chat->chat_user() as $user)
        <div class="row mt-5">
            <div class="col-sm-4">
                <h2>{{link_to_route('users.show',$user->firstName.' '.$user->lastName,[$user->id],[])}}</h2>
            </div>
            <h4 class="col-8">{{link_to_route('messages.show',$chat->latest_message,[$chat->id],[])}}</h4>
                @if(isset($chat->latest_message))
                    <p class="right">{{$chat->dates()}}</p>
                @endif
            </div>
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