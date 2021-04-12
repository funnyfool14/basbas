@extends('commons.layouts')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <h1 class='mt-5 mb-5'>{{$team->name}}</h1>
            @if($introduction)
                @if($introduction->logo_pic)
                    <img class="logo_pic"src="{{asset('image/logo_pic.jpg')}}" alt="">
                @endif
            @endif    
        </div>    
        <div class="row">
            <h2>{{link_to_route('users.show',$team->captain()->firstName.' '.$team->captain()->lastName,[$team->captain()->id],[])}}</h2>
            <h4 class='ml-4 mt-2'>☆キャプテン☆</h4>
        </div> 
        @if($introduction)
            @if($introduction->deputy)
                <div class="row">
                    <h2>{{link_to_route('users.show',$team->deputy()->firstName.' '.$team->deputy()->lastName,[$team->deputy()->id],[])}}</h2>
                    <h4 class='ml-4 mt-2'>☆副キャプテン☆</h4>
                </div>
            @endif
        @endif
        <div class="offset-sm-1">
            @foreach($members as $member)
                <h3 class='mt-3'>{{link_to_route('users.show',$member->firstName.' '.$member->lastName,[$member->id],[])}}</h3> 
            @endforeach
        </div>
    </div>    
    <div class="col-sm-6">
        {{--introduction入力済み--}}
        @if($introduction)
            {{--ログインユーザがキャプテンなら編集ボタンを表示--}}
            @if(($team->captain)==Auth::id())
                <div class="offset-sm-6 col-sm-6">
                    {{link_to_route('team.edit','edit',[$team->id],['class'=>'btn btn-outline-primary btn-block'])}}
                </div>    
            {{--副キャプテンがいてログインユーザが副キャプテンの時も編集ボタンを表示--}}
            @elseif($introduction->deputy)
                @if(($introduction->deputy)==Auth::id())
                    <div class="offset-sm-6 col-sm-6">
                        {{link_to_route('team.edit','edit',[$team->id],['class'=>'btn btn-outline-primary btn-block'])}}
                    </div>    
                @endif
            @endif
            @if($introduction->team_pic)
                <img class="team_pic"src="{{asset($introduction->team_pic)}}"alt="">
            @else
                <img class="team_pic"src="{{asset('image/team_pic2.jpg')}}" alt="">
            @endif
        {{--introduction未入力--}}
        @else
            @if(($team->captain)==Auth::id())
                <div class="offset-sm-6 col-sm-6">
                    {{link_to_route('team.edit','edit',[$team->id],['class'=>'btn btn-outline-primary btn-block'])}}
                </div>
            @endif    
            <img class="team_pic"src="{{asset('image/team_pic2.jpg')}}" alt="">
        @endif
        {{--チーム紹介--}}
        @if($introduction)
            <div class='row'>
                <h5 class='right mr-1 mt-2'>活動拠点</h5>
                <h3 class='right'>{{$introduction->local}}</h3>
            </div>
        @endif    
    </div>
</div>    
@endsection('content')