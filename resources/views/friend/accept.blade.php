@extends('commons.layouts')
@section('content')
        <div class="text-center">
        <h4>friend承認しますか？</h4>
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
@endsection(‘content’)