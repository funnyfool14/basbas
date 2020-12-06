@extends('commons.layouts')
@section('content')
@if(count($users)>0)
    <h3 class="mt-5 mb-5">friend一覧</h3>
    {{--指定ユーザのfriend_idに自分のidが入ってるfriend一覧--}}
    @foreach($users as $user)
        <div class="row mt-4">
            <div class="row col-3">
                <h2 class="">{{$user->firstName}}</h2>
                <h2 class="ml-3">{{$user->lastName}}</h2>
            </div>
	        <div class="col-2">
	            {{--friend詳細画面--}}
                {!!link_to_route('users.show','check',['user'=>$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
            </div>
            <div class="col-2">
                {{--ユーザとのメッセージ画面--}}
                {!!link_to_route('messages.show','message',['id'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!} 
               {{-- <a href="/messages/{{$user->id}}"><button type="button" class="btn btn-outline-primary btn-block">Message</button></a>--}}
            </div>
	        <div class="col-2">
	            {{--friendをやめる--}}
                {!!Form::open(['route'=>['friend.release','id'=>$user->id],'method'=>'delete'])!!}
                {!!Form::submit('release',['class'=>'btn btn-outline-danger btn-block'])!!}
                {!!Form::close()!!}
                {{--{!!link_to_route('friend.release','release',['id'=>$user->id],['class'=>'btn btn-outline-danger btn-block'])!!}--}}
            </div>
        </div>
    @endforeach
@else
    <div class="centering">
        <h3>まだfriendはいません</h3>
            {{--戻るボタン--}}
            <div class="mt-5 offset-4 col-4">
                {!!link_to_route('users.index','戻る',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
            </div>
    </div>
@endif    
@endsection(‘content’)