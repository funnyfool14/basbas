@extends('commons.layouts')
@section('content')
    <h4>問い合わせ一覧</h4>
    <div class='ml-5 mt-5'>
        @foreach($applicants as $applicant)
           <div class='row mt-5'> 
         	    <div class="col-sm-4">
     	            <h2>{{link_to_route(('users.show'),$applicant->firstName.' '.$applicant->lastName,[$applicant->id],[])}}</h2>
	            </div>
	            <div class='col-sm-8'>
	                <h2>{{$applicant->apply_message($team->id)}}</h2>
	            </div>
	       </div>
           <div class='row'> 
         	    <div class="col-sm-3">
     	            {{link_to_route(('application.show'),'メッセージ',[$applicant->application_connect($team->id)->id],['class'=>'btn btn-block btn-outline-success'])}}
	            </div>
	            @if(($team->captain())==Auth::user())
	         	    @include('application.accept_button')
	    		@else($team->introduction())
	    			@if(($team->deputy())==Auth::user())
	         	    	@include('application.accept_button')
	    			@endif
	    		@endif
	    	</div>   
        @endforeach
    </div>    
@endsection('content')