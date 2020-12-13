<div class="row">
    <div class="row col-4 offset-1">
        <h4 class="">
            {!!$picture->take_nice_count!!}
        </h4>
        <p class="ml-2 mt-2">nice!</p>
    </div>
    @if(Auth::id()!=$picture->user_id)
        <h5 class="col-5 mt-2">
            {!!link_to_route('users.show',$picture->user->firstName,['user'=>$picture->user_id])!!}
            {!!link_to_route('users.show',$picture->user->lastName,['user'=>$picture->user_id])!!}                     
        </h5>
    @endif
    <div class="col-2">
    @if(Auth::check()){{--自分以外のユーザのみniceが付けれる--}}
        @if(Auth::id()!=$picture->user_id)
            <div class="mt-1">
                @if(Auth::user()->is_nice($picture->id)){{--nice済み--}}
                    {!!Form::open(['route'=>['not.picture',$picture->id],'method'=>'delete'])!!}
                    {!!Form::submit('not',['class'=>'btn btn-outline-danger btn-sm'])!!}
                    {!!Form::close()!!}
                @else{{--niceしてない--}}
                    {!!Form::open(['route'=>['like.picture',$picture->id]])!!}
                    {!!Form::submit('nice',['class'=>'btn btn-outline-success btn-sm'])!!}
                    {!!Form::close()!!}
                @endif
            </div>
        @endif
    @endif
    </div>
</div>