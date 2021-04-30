<div class='row'>
    {{--対戦相手--}}
    <div class='col-sm-6'>
        @if(($introduction->accept_opponents)=='0')
            <button class='btn btn-outline-primary btn-block'>対戦相手を募集していません</button>
        @else
            <button class='btn btn-primary btn-block'>対戦相手募集中!!</button>
        @endif
    </div>
    {{--新メンバー--}}
    <div class='col-sm-6'>
        @if(($introduction->accept_members)=='0')
            <button class='btn btn-outline-primary btn-block'>新メンバーを募集していません</button>
        @else
            <button class='btn btn-primary btn-block'>新メンバー募集中</button>
        @endif
    </div>
</div>