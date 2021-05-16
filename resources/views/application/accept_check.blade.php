@extends('commons.layouts')
@section('content')
<div class='centering'>
    <h3>{{$applicant->firstName.' '.$applicant->lastName}}のチームを承認しますか？</h3>
    <div class='row mt-5'>
        <div class='offset-sm-3 col-sm-3'>
            <form method='POST' action='{{route('application.accept',['id'=>$connect_id])}}' enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                <div class=''>
                    <button type="submit" class='btn btn-outline-primary btn-block btn-lg'>承認する</button>
                </div>
            </form>
        </div>
        <div class='col-sm-3'>
            <form method='POST' action='{{route('application.accept',['id'=>$connect_id])}}' enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                <div class=''>
                    <button type="submit" class='btn btn-outline-danger btn-block btn-lg'>まだ保留</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')