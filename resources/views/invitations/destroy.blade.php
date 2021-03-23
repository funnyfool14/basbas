{{--ログインユーザがaccept 1の時--}}
<div class="text-center mt-3">
    <div class="offset-4 col-4">
        <form action="{{route('invitations.destroy',$invitation->id)}}"method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-block">参加をやめる</button>
        </form>
    </div>
</div>