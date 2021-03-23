@extends('commons.layouts')
@section('content')
@if(isset($friend2))
<div class="centering">
    <h2 class="">{{$friend1->firstName.' '.$friend1->lastName}}と{{$friend2->firstName.' '.$friend2->lastName}}にリクエストを送信しました</h2>
    <h2 class="mt-3">２人が参加したらチームが作成されます</h2>
    <div class="mt-5 offset-4 col-sm-4">
        {!!link_to_route('teams.index','チーム一覧に戻る',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
    </div>
    <div class="mt-4 offset-4 col-sm-4">
        {!!link_to_route('users.index','TOPに戻る',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
    </div>
</div>
@else
    <div class="centering">
        <h2 class="">{{$friend1->firstName.' '.$friend1->lastName}}にリクエストを送信しました</h2>
        <h2 class="mt-3">{{$friend1->firstName.' '.$friend1->lastName}}が参加したらチームが作成されます</h2>
        <div class="mt-5 offset-4 col-sm-4">
            {!!link_to_route('teams.index','チーム一覧に戻る',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
        </div>
        <div class="mt-4 offset-4 col-sm-4">
            {!!link_to_route('users.index','TOPに戻る',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
        </div>
    </div>
@endif
@endsection('content')