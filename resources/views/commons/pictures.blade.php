<div class="row mt-5">
    @foreach($allPictures as $picture)
        <div class="col-4">
            <img class=""src={!!$picture->pic!!} alt="" width=100%></li>
           {{--ログインしているユーザ--}}
            @if(Auth::check())
                {{--pictureがユーザの投稿したものではないとき時--}}
                @if(Auth::user()!=$picture->user)
                    <div class="row">
                        <h4 class="col-6 text-center mt-1">
                            {!!link_to_route('users.show',$picture->user->name,['user'=>$picture->user->id])!!}
                        </h4>
                        {{--nice/notボタン--}}
                            <p class="mt-2">nice?</p>
                            <div class="ml-1">
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
                        <div class="ml-3 mt-2 row">
                            {!!$picture->take_nice_count!!}
                            <p class="ml-1">nice!</p>
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