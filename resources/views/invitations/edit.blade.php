{{--ログインユーザaccept 0--}}
<div class="row mt-3">
    <div class="col-3 offset-3">
        {!!link_to_route('invitations.edit','参加する',[$invitation->id],['class'=>'btn btn-outline-success btn-block'])!!}
    </div>    
    <div class="col-3">    
        {!!link_to_route('invitations.destroy','断る',[$invitation->id],['class'=>'btn btn-outline-danger btn-block'])!!}
    </div>    
</div>