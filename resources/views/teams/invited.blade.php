@extends('commons.layouts')
@section('content')
    <div class="centering">
        @foreach($invitations as $invitation)
            <h3 class='mt-5 mb-3'>{{$invitation->name}}への参加リクエストが届いています</h3>
            <div class="row mt-2">
                <div class="offset-2 col-sm-4">
                    {!!link_to_route('teams.accept','join to the team',[$invitation->id],['class'=>'btn btn-outline-success btn-block'])!!}
                </div>
                <div class="col-sm-4">
                    {!!link_to_route('teams.accept','some other time',[$invitation->id],['class'=>'btn btn-outline-danger btn-block'])!!}
                </div>
            </div>    
        @endforeach    
    </div>
@endsection(‘content’)