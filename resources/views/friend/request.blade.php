@extends('commons.layouts')
@section('content')
@if(Auth::user()->sent_request($user->id))
    <div class="centering">
        <h3>承認待ち</h3>
            {!!Form::open(['route'=>['request.cancel','id'=>$user->id],'method'=>'delete'])!!}
            {!!Form::submit('cancel',['class'=>'btn btn-outline-danger btn-block'])!!}
            {!!Form::close()!!}
    </div>
{{--@else
        <div class="text-center">
            <h4>friend申請しますか？</h4>
        </div>
        <div class="row">
            <div class="col-3 offset-3 text-right">
                {!!Form::open(['route'=>['request.send','id'=>$user->id],'method'=>'post'])!!}
                {!!Form::submit('Yes',['class'=>'btn btn-outline-success btn-block'])!!}
                {!!Form::close()!!}
            </div>
            <div class="col-3 text-left">
                {!!Form::open(['route'=>['users.show',$user->id],'method'=>'get'])!!}
                {!!Form::submit('No',['class'=>'btn btn-outline-danger btn-block'])!!}
                {!!Form::close()!!}
            </div>
            <div class="mt-4 offset-5 col-2">
                {!!link_to_route('users.show','戻る',[$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
            </div>
        </div>
@endif--}}
@else
        <div class="text-center mt-3 mb-3">
            <h4>friend申請しますか？</h4>
        </div>
        <div class="row mt-5">
            <div class="col-3 offset-3 text-right">
                {!!Form::open(['route'=>['request.send','id'=>$user->id],'method'=>'post'])!!}
                {!!Form::submit('Yes',['class'=>'btn btn-outline-success btn-block'])!!}
                {!!Form::close()!!}
            </div>
            <div class="col-3 text-left">
                {!!link_to_route('users.show','No',[$user->id],['class'=>'btn btn-outline-danger btn-block'])!!}
            </div>
        </div>
        <div class="mt-4 offset-5 col-2">
            {!!link_to_route('users.show','戻る',[$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
        </div>
@endif
@endsection(‘content’)