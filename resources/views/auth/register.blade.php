@extends('commons.layouts')
@section('content')

<div class="text-center">
    <h1 class="mb-4">Bas×Bas</h1>
</div>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            {!!Form::open(['route'=>'signup.post'])!!}
                <div class="form-group">
                    {!!Form::label('name','Name')!!}
                    {!!Form::text('name',old('name'),['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('email','E-mail')!!}
                    {!!Form::email('email',old('email'),['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('password','Password')!!}
                    {!!Form::password('password',['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('password','Confirmation')!!}
                    {!!Form::password('password_confirmation',['class'=>'form-control'])!!}
                </div>
                {!!Form::submit('Enjoy',['class'=>'btn btn-primary btn-block'])!!}
            {!!Form::close()!!}
        </div>
    </div>
@endsection(‘content’)