@extends('commons.layouts')
@section('content')
@if(Auth::user()->sent_request($user->id))
    <div class="text-center">
        <h4>friend申請しますか？</h4>
        <div class="row">
            <div class="col-3 offset-3 text-right">
                {!!Form::open(['route'=>['request.send','id'=>$user->id],'method'=>'post'])!!}
                {!!Form::submit('Yes',['class'=>'btn btn-outline-success btn-block'])!!}
                {!!Form::close()!!}
            </div>
            <div class="col-3 text-left">
                {!!Form::open(['route'=>['users.show',$user->id]])!!}
                {!!Form::submit('No',['class'=>'btn btn-outline-danger btn-block'])!!}
                {!!Form::close()!!}
            </div>
        </div>
    </div>
@else
    <div class="centering">
        <h3>承認待ち</h3>
            {!!Form::open(['route'=>['request.cancel','id'=>$user->id],'method'=>'delete'])!!}
            {!!Form::submit('cancel',['class'=>'btn btn-outline-danger btn-block'])!!}
            {!!Form::close()!!}
    </div>
@endif
@endsection(‘content’)