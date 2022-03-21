@extends('commons.layouts')
@section('content')
    <form method="POST" action="{{route('introduction.update',['introduction'=>$team->id])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class='row'>
        <div class='col-sm-6'>    
            <div class='logo'>
                <div class='row'>
                    <div class="form-group mt-3">
                        <label for="logo_pic" class='col-sm-6'>ロゴ</label>
                        <input type="file" name="logo_pic" value="{{ old('¥logo_pic') }}">
                    </div>
                    <div class="">
                        @if($introduction->logo_pic)
                            <img class="logo_pic_small"src="{{asset($introduction->logo_pic)}}" alt="">
                        @else
                            <img class="logo_pic"src="{{asset('image/logo_pic.jpg')}}" alt="">
                        @endif
                    </div>
                </div>    
            </div>
            <div class='introduction'>
                <div class="form-group">
                    <label for="local">活動拠点</label>
                    <input type="text" class="form-control" name="local" value="{{old('local',$introduction->local)}}">
                </div>
                <div class="form-group">
                    <label for="coat">練習場所</label>
                <input type="text" class="form-control" name="coat" value="{{old('coat',$introduction->coat)}}">
                </div>
                <div class="form-group">
                    <label for="gender">男女構成</label>
                    <select class='form-control'name='gender' value=''selected>
                        <option value='{{$introduction->gender}}'style='display:none;'>{{$introduction->gender}}</option>
                        <option value='{{old('gender')}}'@if(old('gender')) selected @endif>{{old('gender')}}</option>
                        <option value='男性メイン'>男性メイン</option>
                        <option value='女性メイン'>女性メイン</option>
                        <option value='男女混合チーム'>男女混合チーム</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="generation">年齢層</label>
                    <select class='form-control'name='generation' value=''selected>
                        <option value='{{$introduction->generation}}'style='display:none;'>{{$introduction->generation}}</option>
                        <option value='{{old('generation')}}'@if(old('generation')) selected @endif>{{old('generation')}}</option>
                        <option value='20代以下'>20代以下</option>
                        <option value='30代以下'>30代以下</option>
                        <option value='20〜30代'>20〜30代</option>
                        <option value='30〜40代'>30〜40代</option>
                        <option value='30代以上'>30代以上</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="level">チームレベル</label>
                    <select class='form-control'name='level' value=''selected>
                        <option value='{{$introduction->level}}'style='display:none;'>{{$introduction->level}}</option>
                        <option value='{{old('level')}}'@if(old('level')) selected @endif>{{old('level')}}</option>
                        <option value='わいわい楽しく'>わいわい楽しく</option>
                        <option value='上手くなりたい'>上手くなりたい</option>
                        <option value='ガチで勝ちに行く'>ガチで勝ちに行く</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="deputy">副キャプテン</label>
                    <select class='form-control'name='deputy' value=''selected>
                        @if($introduction->deputy)
                            <option value='{{$introduction->deputy}}'style='display:none;'>{{$introduction->deputy_user()->firstName.' '.$introduction->deputy_user()->lastName}}</option>
                        @else
                            <option value=''style='display:none;'>副キャプテンを選ばない</option>
                        @endif
                        <option value=''>副キャプテンを選ばない</option>
                        @foreach($team->appointment() as $member)
                            <option value='{{$member->id}}'@if(old('deputy')==$member->id) selected @endif>{{$member->firstName.' '.$member->lastName}}</option>
                        @endforeach
                    </select> 
                </div>
                <div class="form-group">
                    <label for="coment">チーム紹介</label>
                    <textarea type="text" class="form-control" name="coment">{{ old('coment',$introduction->coment) }}</textarea>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class=''>
                <div class='form-group'>
                    <label for='name'>チーム名</label>
                    <input type='text' name='name' class="form-control" value="{{old('name',$team->name)}}">
                </div>
            </div>
            <div class="">
                <div class="form-group mt-3">
                    <label for="team_pic" class='col-sm-6'>チーム写真</label>
                    <input type="file" name="team_pic">
                </div>
                <div class="right">
                    @if($introduction->team_pic)
                        <img class="team_pic"src="{{asset($introduction->team_pic)}}" alt="">
                    @else
                        <img class="team_pic"src="{{asset('image/team_pic2.jpg')}}" alt="">
                    @endif
                </div>
            </div>
        </div>
        </div> 
        <div class="text-center mt-3 mb-5">
            <button type="submit" class='btn btn-outline-primary btn-lg mt-5 col-sm-8'>introduce</button>
        </div>
    </form>
@endsection('content')