@extends('commons.layouts')
@section('content')
    <div class="centering">
        <h4>friend承認しますか？</h4>
    </div>
    <div class="row mt-5">
        <div class="col-3 offset-3 text-right">
            {{--リクエストを承認--}}
            {!!Form::open(['route'=>['request.accept',$user->id]])!!}
            {!!Form::submit('Yes',['class'=>'btn btn-outline-success btn-block'])!!}
            {!!Form::close()!!}
            {{--{!!link_to_route('request.accept','Yes',[$user->id],['class'=>'btn btn-outline-success btn-block'])!!}--}}
        </div>
            <div class="col-3 text-left">
            {{--ユーザの詳細画面へ--}}
            {!!link_to_route('users.show','No',[$user->id],['class'=>'btn btn-outline-danger btn-block'])!!}
        </div>
    </div>
@endsection(‘content’)