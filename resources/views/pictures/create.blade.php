@extends('commons.layouts')
@section('content')
    <div class="text-center">
        {!!Form::model($picture,['route'=>'pictures.store','files'=>true])!!}
        <div class="form-group">
            {!!Form::file('pic')!!}
        </div>
        <div class="form-group">
            {!!Form::label('content','コメント')!!}
            {!!Form::text('content',null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::submit('upload',['class'=>'col-8 mt-4 btn-lg '])!!}
        </div>
        {!!Form::close()!!}
    </div>
    {{--@if (session('s3url'))
        <h1>いまアップロードしたファイル</h1>
        <img src="{{ session('s3url') }}">
    @endif--}}
@endsection(‘content’)