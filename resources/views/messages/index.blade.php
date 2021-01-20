@extends('commons.layouts')
@section('content')
@foreach($chats as $chat)
    <div class="">
        {{$chat->sender->firstName}}
        <div class="col-3">
            {!!link_to_route('messages.show','message',['id'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!}
        </div>
        <div class="col-3">
            {!!link_to_route('users.show','check',[$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
        </div>
	</div>
@endforeach
@endsection(‘content’)