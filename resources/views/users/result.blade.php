@extends('commons.layouts')
@section('content')
<div class = "offset-sm-3 col-sm-6">
    <div class = "mt-4">
        <form method ="GET" action = "{{route('users.result')}}">
            <input class = "form-control" type ="text" name = "name">
            <button type="submit" class='btn btn-outline-primary btn-lg mt-3 offset-sm-2 col-sm-8'>ユーザを探す</button>
        </form>
    </div>
    <div class = "">
        @foreach ($users as $user)
            @if(Auth::user()!=$user)
            <div class = "mt-3 ml-4">
                <h4>{{link_to_route('users.show',$user->firstName.' '.$user->lastName,[$user->id],[])}}</h4>
            </div>
            @endif
        @endforeach
    </div>
</div>
@endsection('content')