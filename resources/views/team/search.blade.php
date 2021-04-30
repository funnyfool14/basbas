@extends('commons.layouts')
@section('content')
    @foreach($teams as $team)
     	<div class="">
     	    <h2>{!!link_to_route('team.show',$team->name,[$team->id],['class'=>'text text-outline-primary'])!!}</h2>
	    </div>
    @endforeach    
@endsection('content')