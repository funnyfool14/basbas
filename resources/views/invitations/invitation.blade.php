{{--招待の返事前--}}
<div class="mb-4">
    <h2 class="mt-2">{{$invitation->name}}</h2>
    <div class="row offset-sm-1">
        {{--acceptが0のユーザがいる時そのユーザ名を表示--}}
        @if($invitation->not_signed()->isNotEmpty())
            @foreach($invitation->not_signed() as $user)
                <h3 class="mt-1 mr-3">{{$user->firstName.' '.$user->lastName}}</h3>
            @endforeach
            {{--acceptが0のユーザが1名の時--}}
            @if(count($invitation->waiting())==2)
                <h3 class='mr-2'>と</h3>
                <h3 class='mr-2'>{!!link_to_route('invitations.reinvite','あと１名',[Auth::id()],)!!}</h3>
            @endif
        {{--acceptが0のユーザがいない時--}}
        @else($invitation->not_signed()->isEmpty())
            {{--ログインユーザがcaptain--}}
            @if($invitation->captain==Auth::id())
                {{--誰も招待に参加してない--}}
                @if(count($invitation->accept())==1)
                    <h3 class='mr-2'>{!!link_to_route('invitations.reinvite','あと２名',[Auth::id()],)!!}</h3>
                {{--1人招待に参加してる--}}    
                @else(count($invitation->accept())==2)
                    <h3 class='mr-2'>{!!link_to_route('invitations.reinvite','あと１名',[Auth::id()],)!!}</h3>    
                @endif
            {{--ログインユーザがcaptainではない--}}    
            @else
                {{--誰も招待に参加してない--}}
                @if(count($invitation->waiting())==1)
                    <h3>あと2名</h3>
                {{--1人招待に参加してる--}}  
                @else(count($invitation->waiting())==2)
                    <h3>あと１名</h3>    
                @endif
            @endif
        @endif
        <h4 class="mt-1">の参加待ち</h4>
    </div> 
</div>