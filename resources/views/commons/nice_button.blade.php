<p class="mt-2">nice?</p>
<div class="ml-1 mt-1">
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