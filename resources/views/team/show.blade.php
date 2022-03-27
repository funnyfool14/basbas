@extends('commons.layouts')
@section('content')
<div class="row">
    {{--画面左側--}}
    <div class="col-sm-6">
        <div class="row mb-5">
            <h1 class='mt-5 mb-5'>{{$team->name}}</h1>
            @if($introduction)
                @if($introduction->logo_pic)
                    <img class="logo_pic"src="{{asset($introduction->logo_pic)}}"alt="">
                {{--@else    
                    <img class="logo_pic"src="{{asset('image/logo_pic.jpg')}}" alt="">--}}
                @endif
            @endif    
        </div>    
        <div class="row">
            <h2>{{link_to_route('users.show',$team->captain()->firstName.' '.$team->captain()->lastName,[$team->captain()->id],[])}}</h2>
            <h4 class='ml-4 mt-2'>☆キャプテン☆</h4>
        </div> 
        @if($introduction)
            @if($introduction->deputy)
                <div class="row mt-3 mb-3 ml-4">
                    <h2>{{link_to_route('users.show',$team->deputy()->firstName.' '.$team->deputy()->lastName,[$team->deputy()->id],[])}}</h2>
                    <h4 class='ml-4 mt-2'>☆副キャプテン☆</h4>
                </div>
            @endif
        @endif
        <div class="offset-sm-1 mt-1">
            @foreach($members as $member)
                <h3 class='mt-2'>{{link_to_route('users.show',$member->firstName.' '.$member->lastName,[$member->id],[])}}</h3> 
            @endforeach
        </div>
        <div class='mt-5'>
            {{--ログインユーザがチームメンバー--}}
            @if($team->is_member())
                <div class="mt-2 row">
                    {{--メッセージボードボタン--}}
                    <div class='col-sm-4'>
                        {!!link_to_route('team.chat','掲示板',[$team->id],['class'=>'btn btn-outline-primary btn-block'])!!}
                    </div>
                </div>
                <div class="mt-2 row">
                    {{--他チームとの連絡--}}
                    {{--<div class='col-sm-4'>
                        {!!link_to_route('team.show','他チーム交流',[$team->id],['class'=>'btn btn-outline-success btn-block'])!!}
                    </div>--}}
                </div>
                <div class="mt-2">
                    {{--入部申込確認--}}
                    @if($introduction)    
                        @if(($introduction->accept_members)==1)
                        <div class='row'>
                            <div class='col-sm-4'>
                                {!!link_to_route('application.index','入部問い合わせ',[$team->id],['class'=>'btn btn-outline-success btn-block'])!!}
                            </div>
                            @if(($team->application()->unchecked_messages_count())>=1)
                            <p class='btn btn-danger ml-1'>{{$team->application()->unchecked_messages_count()}}</p>
                            @endif
                        </div>
                        @endif
                    @endif
                </div>
            {{--ログインユーザがチームメンバーではない--}}    
            @else
                <div class="col-4">
                    <div class="mt-2">
                        {{--他チームとの連絡--}}
                        {{--{!!link_to_route('team.show','チーム交流',[$team->id],['class'=>'btn btn-outline-success btn-block'])!!}--}}
                    </div>
                </div>
                <div class="">
                    @if($introduction)    
                        @if(($introduction->accept_members)==1)    
                            {{--入部申込確認--}}
                            {{--問い合わせ済み--}}
                            @if($team->applicant())
                            {{--{!!link_to_route('application.show','問い合わせ',[$connect_id],['class'=>'btn btn-outline-success btn-block'])!!}--}}
                            {{--問い合わせしてない--}}
                            @else
                            {{--{!!link_to_route('team.conatct','問い合わせ',[$team->id],['class'=>'btn btn-outline-success btn-block'])!!}--}}
                            @endif
                        @endif
                    @endif
                </div>
            @endif
        </div>    
    </div>
    {{--画面右側--}}
    <div class="col-sm-6">
        <div class='mb-2'>
            {{--introduction入力済み--}}
            {{--acceptボタン--}} 
            @if($introduction){{--カルでは問題ないがデプロイでここの@ifが効いてない--}}
                <div class='accept_button'>
                    {{--キャプテン用--}}
                    @if(($team->captain())==Auth::user())
                        @include('team.show_button')
                    {{--副キャプテン用--}}    
                    @elseif(($team->deputy())==Auth::user())
                            @include('team.show_button')
                    @elseif($team->is_member())
                        @include('team.show_accept')
                    @else
                        <div class='row'>
                            <div class='col-sm-6 btn'>
                                @if(($introduction->accept_opponents)==1)
                                {{link_to_route('messages.show','対戦相手募集中',[$team->captain],['class'=>'btn btn-outline-warning btn-block'])}}
                                @endif
                            </div>
                            <div class='col-sm-6 btn'>
                                @if(($introduction->accept_members)==1)
                                    @if($team->applicant())
                                        {{link_to_route('application.show','新メンバー募集中',[$connect_id],['class'=>'btn btn-outline-primary btn-block'])}}
                                    @else
                                        {{link_to_route('application.apply','新メンバー募集中',[$team->id],['class'=>'btn btn-outline-primary btn-block'])}}
                                    @endif    
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                {{--チーム写真--}}
                @if($introduction->team_pic)
                    <img class="team_pic"src="{{asset($introduction->team_pic)}}"alt="">
                @else
                    <img class="team_pic"src="{{asset('image/team_pic2.jpg')}}" alt="">
                @endif
            {{--introduction未入力--}}
            @else
                @if(($team->captain)==Auth::id())
                    @include('team.show_accept')
                    {{--編集ボタン--}}
                    <div class="offset-sm-10 col-sm-2">
                        {{link_to_route('introduction.edit','編集',[$team->id],['class'=>'btn btn-outline-primary btn-block'])}}
                    </div> 
                @endif
                <img class="team_pic"src="{{asset('image/team_pic2.jpg')}}" alt="">
            @endif
        </div>    
        {{--チーム紹介--}}
        @if($introduction)
            @if($introduction->local)
                <div class='row mt-2'>
                    <h5 class='left'>活動拠点</h5>
                    <h3 class='right'>{{$introduction->local}}</h3>
                </div>
            @endif
            @if($introduction->coat)
                <div class='row mt-2'>
                    <h5 class='left'>練習場所</h5>
                    <h3 class='right'>{{$introduction->coat}}</h3>
                </div>
            @endif
            @if($introduction->gender)
                <div class='row mt-2'>
                    <h5 class='left'>チーム構成</h5>
                    <div class='row'>
                        <h3 class='right mr-3'>{{$introduction->gender}}</h3>
                        @if($introduction->generation)
                            <h3 class='right mr-3'>{{$introduction->generation}}</h3>
                        @endif
                    </div>
                </div>
            @endif
            @if($introduction->level)
                <div class='row mt-2'>
                    <h5 class='left'>チームレベル</h5>
                    <h3 class='right'>{{$introduction->level}}</h3>
                </div>
            @endif
            @if($introduction->coment)
                <div class='row mt-2'>
                    <h5 class='left'>チーム紹介</h5>
                    <h3 class='right'>{{$introduction->coment}}</h3>
                </div>    
            @endif
        @endif
    </div> 
@endsection('content')