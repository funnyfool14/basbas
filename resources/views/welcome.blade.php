@extends('commons.layouts')
@section('content')
@if(Auth::check())
    <div class="row">
        <aside class="col-6">
            <h4 class="mt-1">basket shoes</h4>
            {{--@include('users.card')--}}
        </aside>
        <div class="col-6 ">
            <h3 class="offset-6">{{ Auth::user()->name}}</h3>
            @include('card.user')
            {{--@include('tsubuyakis.tsubuyakis')--}}
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
