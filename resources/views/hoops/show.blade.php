@extends('commons.layouts')
@section('content')
<div class = "text-center">
    <h2 class ="mt-5">{{$hoop->name}}</h2>
    <h4 class ="mt-5">{{'@'.$hoop->adress}}</h4>
    <h4 class ="mt-5">{{$hoop->detail}}</h4>

</div>
@endsection('content')