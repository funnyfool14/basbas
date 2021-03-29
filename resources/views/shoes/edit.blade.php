@extends('commons.layouts')
@section('content')
    {!!Form::model($shoes,['route'=>['shoes.update',$shoes->id],'files'=>true,'method'=>'put','enctype'=>"multipart/form-data",])!!}
    @csrf
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
        {!!Form::submit('update',['class'=>'btn-block mt-4 btn-lg'])!!}
    {!!Form::close()!!}    
@endsection(‘content’)