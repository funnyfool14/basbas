@extends('commons.layouts')
@section('content')
@foreach($messages as $message)
    <div class="">
        {{$message->id}}
        {{$message->message}}
	</div>
@endforeach
{{--@foreach($users as $user)
    <div class="row mt-4">
        <div class="row col-4">
            <h3 class="">
                {{$user->firstName}}
            </h3>
            <h3 class="ml-2">
                {{$user->lastName}}                           
            </h3>
        </div>
        <div class="col-3">
            {!!link_to_route('messages.show','message',['id'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!}
        </div>
        <div class="col-3">
            {!!link_to_route('users.show','check',[$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
        </div>
	</div>
@endforeach--}}
@endsection(‘content’)