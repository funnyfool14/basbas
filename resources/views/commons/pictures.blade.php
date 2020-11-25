<div class="row">
    @foreach($allPictures as $picture)
        <div class="col-4 mt-4">
            <img class=""src={!!$picture->pic!!} alt="" width=100%></li>
           {{--ログインしているユーザ--}}
            @if(Auth::check())
                {{--pictureがユーザの投稿したものではないとき時--}}
                @if(Auth::user()!=$picture->user)
                    <div class="row">
                        <h5 class="col-5 text-center mt-1">
                            {!!link_to_route('users.show',$picture->user->name,['user'=>$picture->user->id])!!}
                        </h5>
                        @include('commons.nice_button')
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