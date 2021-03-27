@extends('commons.layouts')
@section('content')
    {{--所属チームがある--}}
    @if($teams->isNotEmpty())
        <h4 class="text-center">所属チーム情報</h4>
        @foreach($teams as $team)
            <div class="mt-2">
                <h2>{{$team->name}}</h2>
            </div>
        @endforeach
        {{--招待を受けているorしている--}}
        @if($invitations->isNotEmpty())
            @include('invitations.answer')
        @endif
        {{--一度断った未結成チーム--}}
        @if($rejections->isNotEmpty())
            @include('invitations.rejoin')
        @endif
    {{--所属チームがなく招待を受けてる--}}    
    @elseif($invitations->isNotEmpty())
        @include('invitations.answer')
        {{--一度断った招待--}}
        @if($rejections->isNotEmpty())
            @include('invitations.rejoin')
        @endif    
    {{--所属チームがなく招待を一度断った--}}
    @elseif($rejections->isNotEmpty())
        @include('invitations.rejoin')
    {{--所属も招待も受けてない--}}    
    @else
        <div class="centering">
            <h3>所属チームの情報がありません</h3>
        </div>
    @endif
    {{--断ってない招待が３つ以下--}}
    @if(count($invited)<=10)
        <div class="text-center">
            <div class="mt-5 offset-4 col-4">
                {!!link_to_route('invitations.create','create a team',[],['class'=>'btn btn-outline-success btn-block'])!!}
            </div>
        </div>
    @endif
        <div class="text-center mt-5">
            <div class="mt-5 offset-4 col-4">
                {!!link_to_route('users.index','チームを探す',[],['class'=>'btn btn-outline-primary btn-block'])!!}{{--仮ボタン--}}
            </div>
        </div>
@endsection(‘content’)