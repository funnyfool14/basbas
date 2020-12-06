@extends('commons.layouts')
@section('content')
    <div class="row">
        {{--左側表示--}}
        {{--シューズ--}}
        <aside class="col-6">
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
                <aside class="col-4">
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
                </aside>
                <div class="col-8 text-right">
                    {{$profile->nickname}}
                </div>
            </div>
        </aside>
        {{--右側表示--}}
        <div class="col-sm-6">
            <div class="row">
                <h3 class="offset-6">{{$user->firstName}}</h3>
                <h3 class="ml-2">{{$user->lastName}}</h3>
            </div>
            @include('card.user')
        </div>
        <div class="row mt-4">
            @foreach($pictures as $picture)
                <div class="col-4">
                    <img class="mt-1"src={!!$picture->pic!!} alt="" width=100%></li>
                    <div class="row offset-6">
                        @include('commons.nice_button')
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection(‘content’)