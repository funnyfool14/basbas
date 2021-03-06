@extends('commons.layouts')
@section('content')
<div class="centering">
    <h2 class="">{{$friend1->firstName.' '.$friend1->lastName}}と{{$friend2->firstName.' '.$friend2->lastName}}にリクエストを送信しました</h2>
    <h2 class="mt-3">承認されましたらチームが作成されます</h2>
    <div class="mt-5 offset-4 col-sm-4">
        {!!link_to_route('teams.index','チーム一覧に戻る',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
    </div>
    <div class="mt-4 offset-4 col-sm-4">
        {!!link_to_route('users.index','TOPに戻る',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
    </div>
</div>
@endsection('content')