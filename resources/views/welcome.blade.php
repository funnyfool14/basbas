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
                        <div class="mt-2">
                            {{--各ユーザの最新のメッセージ確認--}}
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
                                <h4 class="text-right ml-2">{!!link_to_route('users.show','詳細',['user'=>$user->id],)!!} </h4>
                                <h4 class="mb-5 text-right ml-2">{!!link_to_route('users.edit','編集',['user'=>$user->id])!!} </h4>
                            </div>
                        @endif
                    </div>
                </div>
            </aside>
            <div class="col-sm-6">
            {{--ユーザ名--}}
                <div class="row">
                    <h3 class="offset-6">{{Auth::user()->firstName.' '.Auth::user()->lastName}}</h3>
                    <div class="ml-2">
                        {{--リクエスト数のカウント--}}
                        @if($user->requested_count)
                            {!!link_to_route('request.asked',$user->requested_count,[$user->id],['class'=>'btn btn-danger w-5'])!!}
                        @endif
                        @if($user->invited_count)
                            {!!link_to_route('invitations.index',$user->invited_count,[],['class'=>'btn btn-success w-5'])!!}
                        @endif
                        @if(($reinvite_count)>0)
                            {!!link_to_route('invitations.reinvite',$reinvite_count,[$user->id],['class'=>'btn btn-secondary w-5'])!!}
                        @endif
                    </div>
                </div>
                {{--ユーザ写真--}}
                @include('users.picture')
            </div>
            <div class="row mt-4">
                @foreach($pictures as $picture)
                    <div class="col-sm-4">
                        <img class="mt-1"src="{{asset('storage/'.$picture->pic)}}" alt="" width=100%></li>
                        @include('commons.nice_button')
                    </div>
                @endforeach
            </div>
        </div>
    @else{{--ユーザ以外の表示画面--}}
        <div class="centering">
            <h2>{!!link_to_route('login','ログイン',[],)!!}</h2>
            <p class="mt-4">or</p>
            <h2 class="mb-5">{!!link_to_route('signup.get','ユーザ登録',[],)!!} </h2>
            <h1 class="mt-5">Bas×Bas</h1>
        </div>
        @include('commons.pictures')
    @endif
@endsection('content')

