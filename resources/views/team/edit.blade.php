@extends('commons.layouts')
@section('content')
    <form method="POST" action="{{route('team.update',['team'=>$team->id])}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="local">活動拠点</label>
            <input type="text" class="form-control" name="local" value="{{ old('local') }}">
        </div>
        <div class="form-group">
            <label for="deputy">副キャプテン</label>
            <input type="text" class="form-control" name="deputy" value="{{ old('deputy') }}">
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