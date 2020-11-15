@extends('commons.layouts')
@section('content')

{!!Form::model($shoes,['route'=>['shoes.update',$shoes->id],'method'=>'put'])!!}
<h4 class="mt-4">{!!$brand!!}</h4>
{!!Form::label('brand','brand')!!}
{!!Form::text('brand',null,['class'=>'form-control'])!!}
<h2>{!!$model!!}</h2>
{!!Form::label('model','model')!!}
{!!Form::text('model',null,['class'=>'form-control'])!!}
<p>{!!$size!!}</p>
{!!Form::label('size','size')!!}
{!!Form::text('size',null,['class'=>'form-control'])!!}
{!!Form::submit('update',['class'=>'btn-block mt-4 btn-lg'])!!}
@endsection(‘content’)