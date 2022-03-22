@extends('commons.layouts')
@section('content')
<div class='centering'>
    <h3>{{$applicant->firstName.' '.$applicant->lastName}}の {{$team->name}} 入部を承認しますか？</h3>
    <div class='row mt-5'>
        <div class='offset-sm-3 col-sm-3'>
            {!!link_to_route('application.accept','承認',[$connect_id],['class'=>'btn btn-outline-primary btn-block'])!!}
        </div>
        <div class='col-sm-3'>
            {!!link_to_route('application.index','保留',[$team->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
        </div>
    </div>
</div>
@endsection('content')