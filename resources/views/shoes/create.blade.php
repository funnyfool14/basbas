@extends('commons.layouts')
@section('content')
{!!Form::model($shoes,['route'=>'shoes.store','files'=>true])!!}
    <div class="form-group">
        {!!Form::label('brand','brand')!!}
        {!!Form::text('brand',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('model','model')!!}
        {!!Form::text('model',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('size','size')!!}
        {!!Form::text('size',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::file('shoes_pic')!!}
    </div>
{{--{!!Form::model($picture,['route'=>'pictures.store','files'=>true])!!}
    <div class="form-group">    
        {!!Form::text('size',null,['class'=>'form-control'])!!}
    </div>--}}
    {!!Form::submit('NEW SHOES !!',['class'=>'btn-block mt-4 btn-lg'])!!}
{!!Form::close()!!}
@endsection(‘content’)