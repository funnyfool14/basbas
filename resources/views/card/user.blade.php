<div class="card">
    {{--<div class="card-header">--}}
    <div class="card-body">
        <img class="rounded img-fluid" src="{{Gravatar::get(Auth::user()->email,['size'=>500])}}"alt="">
    </div>
{{--</div>--}}