<div>
    <h5 class='mt-5 text-center'>一度断ったチーム</h5>
    @foreach($rejections as $rejection)
        <div class="mb-4">
            <h2 class="mt-2">{{$rejection->name}}</h2>
            <div class="offset-4 col-4">
                {!!link_to_route('invitations.edit','やっぱり参加する',[$rejection->id],['class'=>'btn btn-outline-success btn-block'])!!}
            </div>    
        </div>
    @endforeach
</div>