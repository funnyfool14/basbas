@extends('commons.layouts')
@section('content')
    <div class="row">
        {{--左側表示--}}
        {{--シューズ--}}
        <aside class="col-sm-6">
            <h5 class="mt-1">-basket shoes-</h5>
            @foreach($manyShoes as $shoes)
                <h4 class="mt-4">{!!$shoes->brand!!}</h4>
                <div class="row">
                    <h2>{!!$shoes->model!!}</h2>
                    <h5 class="mt-2 ml-3">{!!number_format($shoes->size, 1)!!}cm</h5>
                </div>
            @endforeach
            {!!$manyShoes->links()!!}
            {{--シューズ写真--}}
            @include('card.shoes')
            <div class="row">
                <aside class="col-sm-4">
                    @if($user!=Auth::user())
                    <div class="mt-2">
                        {!!link_to_route('request.friend','request',['id'=>$user->id],['class'=>'btn btn-outline-success btn-block'])!!}
                    </div>
                    {{--各ユーザの最新のメッセージ確認--}}
                    {{--<div class="mt-2">
                        {!!link_to_route('messages.show','message',['id'=>$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
                    </div>--}}
                    <div class="mt-2">
                        {!!link_to_route('friend.index','friends',['id'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!}
                    </div>
                    @endif
                </aside>
                <div class="offset-sm-1 col-sm-7">
                    {{--@if(is_null($profile->nickname))
                    @else--}}
                    <div class="row">
                        <p>nickname</p>
                        <h4 class="right">{{$profile->nickname}}</h4>
                    </div>
                    {{--@endif--}}
                    {{--@if(is_null($profile->gender))
                    @else
                    <div class="row">
                        <p>sex</p>
                        <h4 class="right">{{$profile->gender}}</h4>
                    </div>
                    @endif
                    @if(is_null($profile->birthplace))
                    @else
                    <div class="row">
                        <p>birthplace</p>
                        <h4 class="right">{{$profile->birthplace}}</h4>
                    </div>
                    @endif
                    @if(is_null($profile->local))
                    @else
                    <div class="row">
                        <p>local</p>
                        <h4 class="right">{{$profile->local}}</h4>
                    </div>
                    @endif
                    @if(is_null($profile->position))
                    @else
                    <div class="row">
                        <p>position</p>
                        <h4 class="right">{{$profile->position}}</h4>
                    </div>
                    @endif
                    @if(is_null($profile->favorite_player))
                    @else
                    <div class="row">
                        <p>favorite player</p>
                        <h4 class="right">{{$profile->favorite_player}}</h4>
                    </div>
                    @endif
                    @if(is_null($profile->coment))
                    @else
                    <div class="row">
                        <p>coment</p>
                        <h5 class="right">{{$profile->coment}}</h5>
                    </div>
                    @endif
                </div> 何のdiv?--}}
            </div>
        </aside>
        {{--右側表示--}}
        <div class="col-sm-6">
            <div class="row">
                <h3 class="offset-6">{{$user->firstName}}</h3>
                <h3 class="ml-2">{{$user->lastName}}</h3>
            </div>
            @include('card.user')
            {{--topに戻る--}}
            <div class="text-right">
                <h3>{!!link_to_route('users.index','back',[])!!}</h3>
            </div>
        </div>
        <div class="row">
            @foreach($pictures as $picture)
                <div class="col-sm-4 mt-4">
                    <img class=""src={!!$picture->pic!!} alt="" width=100%></li>
                    @include('commons.nice_button')
                </div>
            @endforeach
        </div>
    </div>
@endsection(‘content’)