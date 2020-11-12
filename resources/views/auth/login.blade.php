@extends('commons.layouts')
@section('content')
<div class="text-center">
    <h1 class="mb-4">Bas×Bas</h1>
</div>
<div class="row">
    <div class="col-sm-6 offset-sm-3">
        {!!Form::open(['route'=>'login.post'])!!}
            <div class="form-groupe mt-4">
                {!!Form::label('email','E-mail')!!}
                {!!Form::email('email',old('email'),['class'=>"form-control"])!!}
            </div>
            <div class="form-groupe mt-4">
                {!!Form::label('password','Password')!!}
                {!!Form::password('password',['class'=>"form-control"])!!}
            </div>
            <div class="mt-5">
            {!!Form::submit('Enjoy',['class'=>'btn btn-primary btn-block'])!!}
            </div>
        {!!Form::close()!!}
        <h4 class="mt-5 text-center">New User?! {!!link_to_route('signup.get','Register Now!')!!}</h4>
    </div>
</div>
@endsection(‘content’) 