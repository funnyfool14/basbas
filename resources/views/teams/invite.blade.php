@extends('commons.layouts')
@section('content')
{{$member1と$member2にリクエストを送信しました}}
{{承認されましたらチームが作成されます}}
{!!link_to_route('users.index','TOPに戻る',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
@endsection('content')