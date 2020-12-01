@extends('commons.layouts')
@section('content')
    <h3 class="mt-5 mb-5">friend申請一覧</h3>
    @foreach($users as $user)
        <div class="row mt-4">
            <div class="row col-3 offset-1">
                <h3>{!!link_to_route('users.show',$user->firstName,[$user->id],['class'=>'text-dark'])!!}</h3>
                <h3 class="ml-2">{!!link_to_route('users.show',$user->lastName,[$user->id],['class'=>'text-dark'])!!}</h3>
    	    </div>
    	    <div class="col-2">
                {!!link_to_route('request.accept','承認',[$user->id],['class'=>'btn btn-outline-success btn-block'])!!}
    	    </div>
     	    <div class="col-2">
                {!!link_to_route('request.accept','拒否',[$user->id],['class'=>'btn btn-outline-danger btn-block'])!!}
    	    </div>
    	</div>
    @endforeach
@endsection(‘content’)