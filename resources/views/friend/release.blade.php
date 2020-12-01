@extends('commons.layouts')
@section('content')
        <div class="text-center">
        <h4>申請を断りますか？</h4>
        <div class="row">
            <div class="col-3 offset-3 text-right">
                {!!Form::open(['route'=>['user.show','id'=>$user->id],'method'=>'post'])!!}
                {!!Form::submit('断る',['class'=>'btn btn-outline-danger btn-block'])!!}
                {!!Form::close()!!}
            </div>
            <div class="col-3 text-left">
                {!!Form::open(['route'=>['users.show',$user->id]])!!}
                {!!Form::submit('戻る',['class'=>'btn btn-outline-success btn-block'])!!}
                {!!Form::close()!!}
            </div>
        </div>
    </div>
@endsection(‘content’)