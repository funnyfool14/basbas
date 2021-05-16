@extends('commons.layouts')
@section('content')
<div class="centering">
        <h4>{!!$invitation->name!!}への参加を断りますか？</h4>
    </div>
    <div class="row mt-5">
        <div class="col-3 offset-3">
            <form id="delete-form" action="{{ route('invitations.destroy',$invitation->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-block">断る</button>
            </form>
        </div>
        <div class="col-3">
            {{--チームの一覧画面へ--}}
            {!!link_to_route('team.index','もう少し考える',[],['class'=>'btn btn-outline-success btn-block'])!!}
        </div>
    </div>
@endsection('content')