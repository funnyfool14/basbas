@extends('commons.layouts')
@section('content')
    @if(count($teams)>0)
        @foreach($teams as $team)
            <div class="">
                <h2>{{$team->name}}</h2>
            </div>
        @endforeach
        @if(count($invitations)>0)
            @foreach($invitations as $invitation)
                <h2>{{$invitation->name}}</h2>
                {{--<h2>{{$invitation->unsigned}}の承認待ち</h2>--}}
            @endforeach
        @endif
    @else
        <div class="centering">
            <h3>所属チームの情報がありません</h3>
            <div class="mt-5 offset-4 col-4">
                {!!link_to_route('users.index','find a team',[],['class'=>'btn btn-outline-success btn-block'])!!}{{--仮ボタン--}}
            </div>
            <div class="mt-5 offset-4 col-4">
                {!!link_to_route('teams.create','create a team',[],['class'=>'btn btn-outline-primary btn-block'])!!}
            </div>
        </div>
    @endif
@endsection(‘content’)