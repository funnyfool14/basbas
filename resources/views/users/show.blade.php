@extends('commons.layouts')
@section('content')
    {{--ユーザの詳細--}}
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
            {!!$manyShoes->links()!!}
            @include('card.shoes')
            <div class="row">
                <aside class="col-4">
                    {{--{!!link_to_route('pictures.create','new pic',[],['class'=>'btn btn-outline-primary btn-block'])!!}--}}
                    {!!link_to_route('users.show','message',['user'=>$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
                    {!!link_to_route('users.show','friends',['user'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!}
                </aside>
                <div class="col-8">
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
@endsection(‘content’)