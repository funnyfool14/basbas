@extends('commons.layouts')
@section('content')
    @foreach($users as $user)
        <div class="row mt-5">
            <h4 class="col-3">{!!$user->name!!}</h4>
	            <div class="col-2">
                    {!!link_to_route('users.show','check',['user'=>$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
                </div>
                <div class="col-2">
                    {!!link_to_route('messages.show','message',['id'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!} 
               {{-- <a href="/messages/{{$user->id}}"><button type="button" class="btn btn-outline-primary btn-block">Message</button></a>--}}
                </div>
        </div>
    @endforeach
@endsection(‘content’)