@extends('commons.layouts')
@section('content')
    {{--メッセージ確認--}}
    <div class="bg-warning mb-5">
        <h4>{{link_to_route('users.show','　'.$user->firstName.' '.$user->lastName,[$user->id],[])}}</h4>
    </div>
    {!!Form::open(['route'=>['messages.store',$user_id],'method'=>'post'])!!}
    <div class="row mb-5">
        <div class="col-10">
            {!!Form::textarea('message',null,['class'=>'form-control' ,'rows'=>'1'])!!}
        </div>    
        <div class="col-2">    
            {!!Form::submit('send',['class'=>'btn btn-outline-primary btn-block'])!!}
        </div>    
    </div>
    {!!Form::close()!!}
    @include('messages.room')
@endsection(‘content’)