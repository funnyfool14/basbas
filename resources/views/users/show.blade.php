@extends('commons.layouts')
@section('content')
    <div class="row">
        {{--左側表示--}}
        {{--シューズ--}}
        <aside class="col-sm-6">
            @include('shoes.show')
            <div class="row">
                <aside class="col-sm-4">
                    @if($user!=Auth::user())
                        {{--リクエストを送る--}}
                        <div class="mt-2">
                            {!!link_to_route('request.friend','request',['id'=>$user->id],['class'=>'btn btn-outline-success btn-block'])!!}
                        </div>
                        {{--メッセージ--}}
                        <div class="mt-2">
                            {!!link_to_route('messages.show','message',['id'=>$user->id],['class'=>'btn btn-outline-secondary btn-block'])!!}
                        </div>
                        {{---フレンド一覧--}}
                        <div class="mt-2">
                            {!!link_to_route('friend.index','friends',['id'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!}
                        </div>
                    @endif
                </aside>
                <div class="offset-sm-1 col-sm-7">
                    @if(isset($profile))
                        @if(!is_null($profile->nickname))
                            <div class="row">
                                <p>nickname</p>
                                <h4 class="right">{{$profile->nickname}}</h4>
                            </div>
                        @endif
                        @if(!is_null($profile->gender))
                            <div class="row">
                               <p>sex</p>
                                <h4 class="right">{{$profile->gender}}</h4>
                            </div>
                        @endif
                        @if(!is_null($profile->birthplace))
                            <div class="row">
                                <p>birthplace</p>
                                <h4 class="right">{{$profile->birthplace}}</h4>
                            </div>
                        @endif
                        @if(!is_null($profile->local))
                            <div class="row">
                                <p>local</p>
                                <h4 class="right">{{$profile->local}}</h4>
                            </div>
                        @endif
                        @if(!is_null($profile->position))
                            <div class="row">
                                <p>position</p>
                                <h4 class="right">{{$profile->position}}</h4>
                            </div>
                        @endif
                        @if(!is_null($profile->favorite_player))
                            <div class="row">
                                <p>favorite player</p>
                                <h4 class="right">{{$profile->favorite_player}}</h4>
                            </div>
                        @endif
                    @else
                        <h3 class="mt-4">show your profiles!!</h3>
                    @endif
                </div>
            </div>
        </aside>
        {{--右側表示--}}
        <div class="col-sm-6">
            <div class="row">
                <h3 class="offset-6">{{$user->firstName}}</h3>
                <h3 class="ml-2">{{$user->lastName}}</h3>
            </div>
                {{--ユーザ写真--}}
                @include('users.picture')
                @if(!is_null($profile->coment))
                    <div class="mt-2">
                        <h5 class="text-right">{{$profile->coment}}</h5>
                    </div>
                @endif
            {{--topに戻る--}}
            <div class="text-right mt-4">
                <h3>{!!link_to_route('users.index','back to top',[])!!}</h3>
            </div>
        </div>
        <div class="row">
            @foreach($pictures as $picture)
                <div class="col-sm-4 mt-4">
                    <img class=""src={!!$picture->pic!!} alt="" width=100%></li>
                    @include('commons.nice_button')
                </div>
            @endforeach
        </div>
    </div>
@endsection(‘content’)