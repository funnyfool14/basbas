@extends('commons.layouts')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <h1 class='mt-5 mb-5'>{{$team->name}}</h1>
            @if(($introduction->logo_pic))
                <img class="logo_pic"src="{{asset('image/logo_pic.jpg')}}" alt="">
            @endif
        </div>    
        <div class="row">
            <h2>{{link_to_route('users.show',$captain->firstName.' '.$captain->lastName,[$captain->id],[])}}</h2>
            <h4 class='ml-4 mt-2'>☆キャプテン☆</h4>
        </div>  
        @if($introduction->deputy)
            <div class="row">
                <h2>{{link_to_route('users.show',$captain->firstName.' '.$captain->lastName,[$captain->id],[])}}</h2>
                <h4 class='ml-4 mt-2'>副キャプテン☆</h4>
            </div>
        @endif
        <div class="offset-sm-1">
        @foreach($members as $member)
                <h3 class='mt-3'>{{link_to_route('users.show',$member->firstName.' '.$member->lastName,[$member->id],[])}}</h3> 
        @endforeach
        </div>
    </div>    
    <div class="col-sm-6">
        {{--introduction入力済み--}}
        @if($introduction->isNotEmpty)
            {{--ログインユーザがキャプテンなら編集ボタンを表示--}}
            @if(($team->captain)==Auth::id())
                {{link_to_route('team.edit','edit',[$team->id],['class'=>'btn btn-outline-primary'])}}
            {{--副キャプテンがいてログインユーザが副キャプテンの時も編集ボタンを表示--}}
            @elseif(($introduction->deputy)->isNotEmpty())
                @if(($introduction->deputy)==Auth::id())
                    {{link_to_route('team.edit','edit',[$team->id],['class'=>'btn btn-outline-primary'])}}
                @endif
            @endif
            @if(($introduction->team_pic)->isEmpty())
                <img class="team_pic"src="{{asset('image/team_pic2.jpg')}}" alt="">
            @else
                <img class="team_pic"src="{{asset($introduction->team_pic)}}"alt="">
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
    </div>
</div>    
@endsection('content')