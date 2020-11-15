@extends('commons.layouts')
@section('content')
@if(Auth::check())
    <div class="row">
        <aside class="col-6">
            <p class="mt-1">-shoes一覧-</p>
            @foreach($manyShoes as $shoes)
                <div class="row mb-3">
                    <h5>{{$shoes->brand}}</h5>
                    <h4 class="ml-2">{!!$shoes->model!!}</h4>
                    <p class="ml-2">{!!number_format($shoes->size, 1)!!}cm</p>
                </div>
                <div class="row">
                    <div class="col-3">
                        {!!link_to_route('shoes.edit','edit',['shoe'=>$shoes->id],['class'=>'btn btn-outline-secondary btn-sm btn-block'])!!}
                    </div>
                    <div class="col-3">
                        {!!Form::model($shoes,['route'=>['shoes.destroy',$shoes->id],'method'=>'delete'])!!}
　                      {!!Form::submit('delete',['class'=>'btn btn-outline-danger btn-sm btn-block'])!!}
                        {!!Form::close()!!}
                    </div>
                </div>
            @endforeach
            <div class="mt-4">
                {!!link_to_route('shoes.create','get new shose!',[],['class'=>'btn btn-outline-primary btn-block'])!!}
            </div>
            @include('card.shoes')
        </aside>
        <div class="col-6 ">
            <h3 class="text-right">{{ Auth::user()->name}}</h3>
            <div class="text-right">
                {!!Form::model($user,['route'=>['users.update',$user->id],'method'=>'put'])!!}
                {!!Form::label('name','rename')!!}
                {!!Form::text('name',null,['class'=>'form-controll'])!!}
                {!!Form::submit('update',[])!!}
                {!!Form::close()!!}
            </div>
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