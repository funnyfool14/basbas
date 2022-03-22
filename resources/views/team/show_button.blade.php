<div class='row'>
    {{--対戦相手--}}
    @if($introduction)
        <div class='col-sm-5'>
            @if(($introduction->accept_opponents)=='0')
                <form method="POST" action="{{route('team.accept_opponents',[$team->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <button type="submit" class='btn btn-outline-primary btn-block'>対戦相手を募集する</button>
                </form>
            @else
                <form method="POST" action="{{route('team.reject_opponents',[$team->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <button type="submit" class='btn btn-primary btn-block'>対戦相手募集中</button>
                </form>
            @endif
        </div>
        {{--新メンバー--}}
        <div class='col-sm-5'>
            @if(($introduction->accept_members)=='0')
                <form method="POST" action="{{route('team.accept_members',[$team->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <button type="submit" class='btn btn-outline-primary btn-block'>新メンバーを募集する</button>
                </form>
            @else
                <form method="POST" action="{{route('team.reject_members',[$team->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <button type="submit" class='btn btn-primary btn-block'>新メンバー募集中</button>
                </form>
            @endif
        </div>
    @else
        <div class='offset-sm-10'>{{' '}}</div>
    @endif
    {{--編集ボタン--}}
    <div class="col-sm-2">
        {{link_to_route('introduction.edit','編集',[$team->id],['class'=>'btn btn-outline-primary btn-block'])}}
    </div> 
</div> 