@extends('commons.layouts')
@section('content')
@if(Auth::check())
    {{--ユーザのトップ画面--}}
    <div class="row">
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
            @include('card.shoes')
            <div class="row">
                <aside class="col-4">
                    {!!link_to_route('pictures.create','new pic',[],['class'=>'btn btn-outline-primary btn-block'])!!}
                    {!!link_to_route('users.index','message',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
                    {!!link_to_route('users.index','friends',[],['class'=>'btn btn-outline-primary btn-block'])!!}
                </aside>
                <div class="col-8">
                    @if(Auth::id()==$user->id)
                        <h1 class="mb-5 text-right">{!!link_to_route('users.edit','edit',['user'=>$user->id])!!} </h1>
                    @endif
                </div>
            </div>
        </aside>
        {{--ユーザ--}}
        <div class="col-6 ">
            <h3 class="text-right">{{ Auth::user()->name}}</h3>
            @include('card.user')
        </div>
        <div class="row mt-4">
            @foreach($pictures as $picture)
                <div class="col-4">
                    <img class="mt-1"src={!!$picture->pic!!} alt="" width=100%></li>
                </div>
            @endforeach
        </div>
    </div>
@else
    {{--ユーザ以外の表示画面--}}
        <div class="text-center">
            <h1>{!!link_to_route('login','log in',[],)!!}</h1>
            <p class="mt-4">or</p>
            <h1 class="mb-5">{!!link_to_route('signup.get','register',[],)!!} </h1>
        <h1 class="mt-5">Bas×Bas</h1>
    @include('commons.pictures')
@endif
@endsection('content')

