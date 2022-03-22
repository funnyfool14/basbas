@extends('commons.layouts')
@section('content')
<div class = "row">
    <div class = "col-sm-8">
        <h4 class="text-center">検索結果</h4>
        @if($teams->isNotEmpty())
            @foreach($teams as $team)
                @if($team->not_member(\Auth::id()))
                <div class="mt-5 text-center">
                    <h2>{!!link_to_route('team.show',$team->name,[$team->id],['class'=>'text text-outline-primary'])!!}</h2>
                </div>
                @else
                <div class="centering">
                    <h3>該当チームがありません</h3>
                </div>
                @endif
            @endforeach
        @else
            <div class="centering">
                <h3>該当チームがありません</h3>
            </div>
        @endif
    </div>
    <div class = "col-sm-4">
        @if(count($invited)<=3)
        <div class="">
            {!!link_to_route('invitations.create','チームを作る',[],['class'=>'btn btn-outline-success btn-block'])!!}
        </div>
        @endif
        <div class="text-center mt-3">
            <div class = "mt-4">
                <form method ="GET" action = "{{route('team.result')}}">
                    <input class = "form-control" type ="text" name = "word">
                    <button type="submit" class='btn btn-outline-primary mt-3'>チームを探す</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection('content')