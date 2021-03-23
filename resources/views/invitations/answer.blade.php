{{--結成前--}}
<div>
<h4 class='mt-5 text-center'>未結成チーム</h4>
@foreach($invitations as $invitation)
    @include('invitations.invitation')
    {{--ログインユーザがチーム創設--}}
    @if(($invitation->captain)==Auth::id())
        @include('invitations.quit')
    {{--ログインユーザがチームに参加--}}    
    @elseif((Auth::user())->signed($invitation->id))
        @include('invitations.destroy')
    {{--ログインユーザがチームに参加してない--}}
    @else((Auth::user())->not_signed($invitation->id))
        @include('invitations.edit')
    @endif
@endforeach
</div>