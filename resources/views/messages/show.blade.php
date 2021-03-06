@extends('commons.layouts')
@section('content')
    {{--メッセージ確認--}}
    <div class="row bg-info mb-5">
        <h4>{{$user->firstName.' '.$user->lastName}}</h4>
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
    @include('messages.room')
@endsection(‘content’)