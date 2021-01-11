@extends('commons.layouts')
@section('content')
    @if(Auth::check()){{--ユーザのトップ画面--}}
        <div class="row">
            {{--シューズ--}}
            <aside class="col-sm-6">
                @include('shoes.show')
                <div class="row">
                    <aside class="col-4">
                        <div class="mt-2">
                            {{--画像投稿ボタン--}}
                            {!!link_to_route('pictures.create','new pic',[],['class'=>'btn btn-outline-success btn-block'])!!}
                        </div>
                            {{--各ユーザの最新のメッセージ確認--}}
                            <div class="mt-2">
                                {!!link_to_route('messages.index','message',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
                            </div>
                        <div class="mt-2">
                            {{--friend一覧へ--}}
                            {!!link_to_route('friend.index','friends',['id'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!}
                        </div>
                    </aside>
                    <div class="col-8">
                        @if(Auth::id()==$user->id){{--ユーザ情報編集画面ボタン--}}
                            <div class="edit">
                                <h2 class="text-right ml-2">{!!link_to_route('users.show','detail',['user'=>$user->id],)!!} </h2>
                                <h2 class="mb-5 text-right ml-2">{!!link_to_route('users.edit','edit',['user'=>$user->id])!!} </h2>
                            </div>
                        @endif
                    </div>
                </div>
            </aside>
            <div class="col-sm-6">
            {{--ユーザ名--}}
                <div class="row">
                    <h3 class="offset-6">{{ Auth::user()->firstName}}</h3>
                    <h3 class="ml-2">{{ Auth::user()->lastName}}</h3>
                    <div class="ml-2">
                        {{--リクエスト数のカウント--}}
                        {!!link_to_route('request.asked',$user->requested_count,[$user->id],['class'=>'btn btn-danger w-5'])!!}
                    </div>
                </div>
                {{--ユーザ写真--}}
                @include('users.picture')
            </div>
            <div class="row mt-4">
                @foreach($pictures as $picture)
                    <div class="col-sm-4">
                        <img class="mt-1"src={!!$picture->pic!!} alt="" width=100%></li>
                        @include('commons.nice_button')
                    </div>
                @endforeach
            </div>
        </div>
    @else{{--ユーザ以外の表示画面--}}
        <div class="text-center">
            <h1>{!!link_to_route('login','log in',[],)!!}</h1>
            <p class="mt-4">or</p>
            <h1 class="mb-5">{!!link_to_route('signup.get','register',[],)!!} </h1>
            <h1 class="mt-5">Bas×Bas</h1>
        </div>
        @include('commons.pictures')
    @endif
@endsection('content')

