@extends('commons.layouts')
@section('content')
<div class = "offset-sm-3 col-sm-6">
    <div class = "mt-4">
        <form method ="GET" action = "{{route('users.result')}}">
            <input class = "form-control" type ="text" name = "name">
            <button type="submit" class='btn btn-outline-primary btn-lg mt-3 offset-sm-2 col-sm-8'>ユーザを探す</button>
        </form>
    </div>
</div>
@endsection('content')