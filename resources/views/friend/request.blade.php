@extends('commons.layouts')
@section('content')
@if(Auth::user()->friend_id==$user->id)
    <div class="text-center">
        <h4>friend申請しますか？</h4>
        <div class="row">
            <div class="col-3 offset-3 text-right">
                {!!link_to_route('request.store','Yes',['id'=>$user->id],['class'=>'btn btn-outline-success btn-block'])!!}
            </div>
            <div class="col-3 text-left">
                {!!link_to_route('users.show','No',['user'=>$user->id],['class'=>'btn btn-outline-danger btn-block'])!!}
            </div>
        </div>
    </div>
@else
    <div class="centering">
        <h3>承認待ち</h3>
    </div>
@endif
@endsection(‘content’)