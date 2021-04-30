@extends('commons.layouts')
@section('content')
    <h4>問い合わせ一覧</h4>
    <div class='ml-5 mt-5'>
        @foreach($applicants as $applicant)
         	<div class="mt-4">
     	        <h2>{{link_to_route(('application.join'),$applicant->firstName.' '.$applicant->lastName,[$application->team_id],[])}}</h2>
	        </div>
        @endforeach
    </div>    
@endsection('content')