<div class="row mt-5">
    @foreach($allPictures as $picture)
        <div class="col-4">
            <img class="mt-1"src={!!$picture->pic!!} alt="" width=100%></li>
           {{--ログインしているユーザ--}}
            @if(Auth::check())
                {{--pictureがユーザの投稿したものではないとき時--}}
                @if(Auth::user()!=$picture->user)
                    <div class="row">
                        <div class="">
                            {!!link_to_route('users.show',$picture->user->name,['user'=>$picture->user->id])!!}
                        </div>
                        {{--nice/notボタン--}}
                        <div class="ml-3">
                            @if(Auth::user()->is_nice($picture->id))
                                {!!Form::open(['route'=>['not.picture',$picture->id],'method'=>'delete'])!!}
                                {!!Form::submit('not',['class'=>'btn btn-outline-danger btn-sm'])!!}
                                {!!Form::close()!!}
                            @else
                                {!!Form::open(['route'=>['like.picture',$picture->id]])!!}
                                {!!Form::submit('nice',['class'=>'btn btn-outline-success btn-sm'])!!}
                                {!!Form::close()!!}
                            @endif
                        </div>
                    </div>
                @endif
            {{--ログイン指定ないユーザ--}}
            @else
                <div class="">
                    {!!link_to_route('users.show',$picture->user->name,['user'=>$picture->user->id])!!}
                </div>
            @endif
        </div>
    @endforeach