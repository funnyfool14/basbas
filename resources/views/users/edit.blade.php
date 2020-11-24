@extends('commons.layouts')
@section('content')
@if(Auth::check())
    <div class="row">
        <aside class="col-6">
            <p class="mt-1">-shoes一覧-</p>
            {{--shose一覧を表示--}}
            @foreach($manyShoes as $shoes)
                    <h5 class="mt-1">{!!$shoes->brand!!}</h5>
                    <h5 class="ml-3">{!!$shoes->model!!}</h5>
                    <p class="mt-1 text-right col-5">{!!number_format($shoes->size, 1)!!}cm</p>
                <div class="row">
                    <div class="col-6">
                            {!!Form::model($shoes,['route'=>['shoes.edit',$shoes->id],'method'=>'get','class'=>'xxxx'])!!}
　                          {!!Form::submit('edit',['class'=>'btn btn-outline-secondary btn-sm btn-block'])!!}
                        　  {!!Form::close()!!}
                    </div>
                    <div class="col-6">
                            {!!Form::model($shoes,['route'=>['shoes.destroy',$shoes->id],'method'=>'delete','class'=>'xxxx'])!!}
　                          {!!Form::submit('delete',['class'=>'btn btn-outline-danger btn-sm btn-block'])!!}
                            {!!Form::close()!!}
                    </div>
                </div>
            @endforeach
            {{--shoes 新規作成--}}
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
        <div class="row mt-4">
            @foreach($pictures as $picture)
                <div class="col-4">
                    <img class="mt-1"src={!!$picture->pic!!} alt="" width=100%></li>
                    {{--link_to_routeだとgetメソッドにルートされる
                    {!!link_to_route('pictures.destroy','delete',[$picture->id],['class'=>'text-danger'])!!}--}}
                    <div class="mb-2">
                        {!!Form::model($picture,['route'=>['pictures.destroy',$picture->id],'method'=>'delete'])!!}
　                      {!!Form::submit('delete',['class'=>'btn btn-outline-danger btn-sm btn-block'])!!}
                        {!!Form::close()!!}
                    </div>
                </div>
            @endforeach
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