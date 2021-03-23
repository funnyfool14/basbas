{{--招待の返事前--}}
<div class="mb-4">
    <h2 class="mt-2">{{$invitation->name}}</h2>
    <div class="row offset-sm-1">
        @foreach($invitation->not_signed() as $user)
            <h3 class="mt-1 mr-3">{{$user->firstName.' '.$user->lastName}}</h3>
        @endforeach
        @if($invitation->not_signed()->isEmpty())
            <h3>あと１名</h3>
        @endif
        <h4 class="mt-1">の参加待ち</h4>
    </div> 
</div>