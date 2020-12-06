@extends('commons.layouts')
@section('content')
    <div class="centering">
        <h4>friend申請を断りますか？</h4>
    </div>
    <div class="row mt-5">
        <div class="col-3 offset-3 text-right">
            {{--リクエストを断る--}}
            {!!Form::open(['route'=>['request.reject','id'=>$user->id],'method'=>'delete'])!!}
            {!!Form::submit('Yes',['class'=>'btn btn-outline-danger btn-block'])!!}
            {!!Form::close()!!}
        </div>
            <div class="col-3 text-left">
            {{--ユーザの詳細画面へ--}}
            {!!link_to_route('users.show','No',[$user->id],['class'=>'btn btn-outline-success btn-block'])!!}
        </div>
    </div>
    {{--戻るボタン--}}
    {{--<div class="mt-4 offset-5 col-2">
        {!!link_to_route('users.show','戻る',[$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
    </div>--}}
@endsection(‘content’)