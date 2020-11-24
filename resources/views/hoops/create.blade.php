@extends('commons.layouts')
@section('content')
    <h3>hoopの登録</h3>
    {!!Form::model($hoop,['route'=>'hoops.store'])!!}
        <div class="form-group">
            {!!Form::label('name','施設名')!!}
            {!!Form::text('name',null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('adress','住所')!!}
            {!!Form::text('adress',null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('phone','電話番号')!!}
            {!!Form::text('phone',null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('detail1','その他施設詳細(コート数 利用料 屋内外etc)')!!}
            {!!Form::text('detail1',null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('detail2','その他施設詳細')!!}
            {!!Form::text('detail2',null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('detail3','その他施設詳細')!!}
            {!!Form::text('detaile3',null,['class'=>'form-control'])!!}
        </div>
    {!!Form::submit('施設追加',['class'=>'btn-block mt-4 btn-lg'])!!}
{!!Form::close()!!}
@endsection(‘content’)