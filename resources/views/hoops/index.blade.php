@extends('commons.layouts')
@section('content')
    <div class="row">
        <div class="mt-4 col-8">
            @foreach($hoops as $hoop)
                <ul class="list-unstyled mt-4">
                    <li>
                        <h2>{{link_to_route(('hoops.show'),$hoop->name,[$hoop->id],[])}}</h2>
                        <h5 class ="ml-3">{!!'@ '.$hoop->adress!!}</h5>
                    </li>
                </ul>
            @endforeach
            {!!$hoops->links()!!}
        </div>
        <aside class="mt-4 col-4">
            {{--Hoop検索フォーム--}}
            <div>
                {!!Form::open(['method' => 'GET']) !!}
                {!!Form::label('s','adress search',['class'=>'text-secondary'])!!}
                {!!Form::text('s',null,['class'=>'form-control']) !!}
                {!!Form::submit('search',['class'=>'btn btn-outline-primary btn-block mt-2'])!!}
                {!!Form::close() !!}
            </div>
            {{--Hoop登録画面--}}
            {!!link_to_route('hoops.create','register',[],['class'=>'btn btn-outline-secondary btn-block mt-3'])!!}
        </aside>
    </div>
@endsection(‘content’)