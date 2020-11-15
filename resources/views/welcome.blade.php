@extends('commons.layouts')
@section('content')
@if(Auth::check())
    <div class="row">
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
            @if(Auth::id()==$user->id)
            <div class="text-right">
                <h1 class="mb-5">{!!link_to_route('users.edit','edit',['user'=>$user->id])!!} </h1>
            </div>
            @endif
        </aside>
        <div class="col-6 ">
            <h3 class="text-right">{{ Auth::user()->name}}</h3>
            @include('card.user')
        </div>
    </div>
    @else
        <div class="text-center">
            <h1>{!!link_to_route('login','log in',[],)!!}</h1>
            <p class="mt-4">or</p>
            <h1 class="mb-5">{!!link_to_route('signup.get','register',[],)!!} </h1>
            <h1 class="mt-5">Bas×Bas</h1>
        </div>
    @endif
@endsection('content')
