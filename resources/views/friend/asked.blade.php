@extends('commons.layouts')
@section('content')
@if(count($users)>0)
    <h3 class="mt-5 mb-5">friend申請一覧</h3>
    @foreach($users as $user)
        <div class="row mt-4">
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
    	    </div>
    	</div>
    @endforeach
@else
    <div class="centering">
        <h3>未承認のリクエストはありません</h3>
            {{--戻るボタン--}}
            <div class="mt-5 offset-4 col-4">
                {!!link_to_route('users.index','戻る',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
            </div>
    </div>
@endif      
@endsection(‘content’)