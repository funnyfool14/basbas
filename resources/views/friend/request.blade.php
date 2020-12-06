@extends('commons.layouts')
@section('content')
{{--承認済み--}}
@if(Auth::user()->is_friend($user->id))
    <div class="centering">
        <h3>friend 登録されたユーザです</h3>
    </div>
{{--@include('users.show')--}}
{{--リクエスト済み--}}
@elseif(Auth::user()->sent_request($user->id))
    <div class="centering">
        <h3>承認待ち</h3>
            <div class="mt-5 offset-4 col-4">
                {!!Form::open(['route'=>['request.cancel','id'=>$user->id],'method'=>'delete'])!!}
                {!!Form::submit('cancel',['class'=>'btn btn-outline-danger btn-block'])!!}
                {!!Form::close()!!}
            </div>
    </div>
{{--リクエストを受けている--}}
@elseif(Auth::user()->take_request($user->id))
    <div class="centering">
        <h3>friendリクエストを受けています</h3>
    </div>    
    <div class="row mt-5">
        <div class="row col-3 offset-1">
            <h3>{!!link_to_route('users.show',$user->firstName,[$user->id],['class'=>'text-dark'])!!}</h3>
            <h3 class="ml-2">{!!link_to_route('users.show',$user->lastName,[$user->id],['class'=>'text-dark'])!!}</h3>
        </div>
        <div class="col-2">
            {{--リクエスト承認--}}
            {!!link_to_route('accept.confirm','accept',[$user->id],['class'=>'btn btn-outline-success btn-block'])!!}
        </div>
        <div class="col-2">
            {{--リクエスト拒否--}}
            {!!link_to_route('reject.confirm','reject',[$user->id],['class'=>'btn btn-outline-danger btn-block'])!!}
     	    {{--{!!Form::open(['route'=>['request.reject','id'=>$user->id],'method'=>'delete'])!!}
            {!!Form::submit('reject',['class'=>'btn btn-outline-danger btn-block'])!!}
            {!!Form::close()!!}--}}
	    </div>
    	</div>
{{--リクエスト前--}}
@else
    <div class="text-center mt-3 mb-3">
        <h4>friend申請しますか？</h4>
    </div>
    <div class="row mt-5">
        <div class="col-3 offset-3 text-right">
            {{--指定ユーザにリクエストを送る--}}
            {!!Form::open(['route'=>['request.send','id'=>$user->id],'method'=>'post'])!!}
            {!!Form::submit('Yes',['class'=>'btn btn-outline-success btn-block'])!!}
            {!!Form::close()!!}
        </div>
            <div class="col-3 text-left">
            {!!link_to_route('users.show','No',[$user->id],['class'=>'btn btn-outline-danger btn-block'])!!}
            {{--メソッドを入力しなければPOSTがデフォルト
            {!!Form::open(['route'=>['users.show',$user->id],'method'=>'get'])!!}
            {!!Form::submit('No',['class'=>'btn btn-outline-danger btn-block'])!!}
            {!!Form::close()!!}--}}
        </div>
    </div>
    <div class="mt-4 offset-5 col-2">
        {!!link_to_route('users.show','戻る',[$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
    </div>
@endif
@endsection(‘content’)