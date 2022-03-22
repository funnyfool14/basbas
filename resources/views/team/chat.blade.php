@extends('commons.layouts')
@section('content')
    {{--メッセージ確認--}}
    <div class="bg-warning mb-5">
        <h4>{{link_to_route('team.show','　'.$team->name.' の掲示板',[$team->id],[])}}</h4>
    </div>
    @if($team->is_member(Auth::id()))
    {!!Form::open(['route'=>['team.message',$team->id],'method'=>'post'])!!}
    <div class="row mb-5">
        <div class="col-10">
            {!!Form::textarea('message',null,['class'=>'form-control' ,'rows'=>'1'])!!}
        </div>    
        <div class="col-2">    
            {!!Form::submit('send',['class'=>'btn btn-outline-primary btn-block'])!!}
        </div>    
    </div>
    {!!Form::close()!!}
    @endif
    @include('messages.room')
@endsection(‘content’)