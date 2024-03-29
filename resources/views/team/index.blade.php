@extends('commons.layouts')
@section('content')
<div class = "row">
    <div class = "col-sm-8">
        {{--所属チームがある--}}
        @if($teams->isNotEmpty())
            <h4 class="text-center">所属チーム情報</h4>
            @foreach($teams as $team)
                <div class="mt-5 text-center">
                    <h2>{!!link_to_route('team.show',$team->name,[$team->id],['class'=>'text text-outline-primary'])!!}</h2>
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