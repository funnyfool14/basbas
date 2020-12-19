@extends('commons.layouts')
@section('content')

{!!Form::model($shoes,['route'=>['shoes.update',$shoes->id],'method'=>'put'])!!}
<h3 class="mt-4">{!!$brand!!}</h3>
{!!Form::label('brand','brand')!!}
{!!Form::text('brand',null,['class'=>'form-control'])!!}
<h2 class='mt-4'>{!!$model!!}</h2>
{!!Form::label('model','model')!!}
{!!Form::text('model',null,['class'=>'form-control'])!!}
<h4 class='mt-4'>{!!$size!!}</h4>
{!!Form::label('size','size')!!}
{!!Form::text('size',null,['class'=>'form-control'])!!}
{!!Form::submit('update',['class'=>'btn-block mt-4 btn-lg'])!!}
@endsection(‘content’)