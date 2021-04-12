@extends('commons.layouts')
@section('content')
    <form method="POST" action="{{route('team.update',['team'=>$team->id])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="local">活動拠点</label>
            <input type="text" class="form-control" name="local" value="{{old('local',$introduction->local)}}">
        </div>
        <div class="form-group">
            <label for="coat">練習場所</label>
            <input type="text" class="form-control" name="coat" value="{{old('coat',$introduction->coat)}}">
        </div>
        <div class="form-group">
            <label for="gender">男 女</label>
            <input type="text" class="form-control" name="gender" value="{{old('gender',$introduction->gender)}}">
        </div>
        <div class="form-group">
            <label for="genatation">年齢層</label>
            <input type="text" class="form-control" name="genatation" value="{{old('genatation',$introduction->genatation)}}">
        </div>
        <div class="form-group">
            <label for="level">チームレベル</label>
            <select class='form-control'name='level' value=''selected>
                <option value=''disabled selected style='display:none;'>{{$introduction->level}}</option>
                <option value='waiwai'>waiwai</option>
                <option value='eieie'>eieie</option>
                <option value='sisis'>sisisi</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deputy">副キャプテン</label>
            <select class='form-control'name='deputy' value=''selected>
                <option value=''disabled selected style='display:none;'>{{$introduction->deputy_user()->firstName.' '.$introduction->deputy_user()->lastName}}</option>
                <option value=''>副キャプテンを選ばない</option>
                @foreach($team->appointment() as $member)
                    <option value='{{$member->id}}'@if(old('deputy')==$member->id) selected @endif>{{$member->firstName.' '.$member->lastName}}</option>
                @endforeach
            </select> 
        </div>
        <div class="form-group">
            <label for="coment">チーム紹介</label>
            <input type="text" class="form-control" name="coment" value="{{ old('coment') }}">
        </div>
        <div class='row'>
            <div class="form-group mt-3">
                <label for="logo_pic" class='col-sm-6'>ロゴ</label>
                <input type="file" name="logo_pic">
            </div>
            <div class="col-sm-6">
                @if($introduction->logo_pic)
                    <img class="logo_pic_small"src="{{asset($introduction->logo_pic)}}" alt="">
                @else
                    <img class="logo_pic_small"src="{{asset('image/logo_pic.jpg')}}" alt="">
                @endif
            </div>
        </div>    
        <div class="row">
            <div class="form-group mt-3">
                <label for="team_pic" class='col-sm-6'>チーム写真</label>
                <input type="file" name="team_pic">
            </div>
            <div class="col-sm-6">
                @if($introduction->team_pic)
                    <img class="team_pic_small"src="{{asset($introduction->team_pic)}}" alt="">
                @else
                    <img class="team_pic_small"src="{{asset('image/team_pic2.jpg')}}" alt="">
                @endif
            </div>
        </div>
        <div class="text-center mt-5">
            <button type="submit" class='btn btn-outline-primary btn-lg mt-5 col-sm-8'>introduce</button>
        </div>    
    </form>
@endsection('content')