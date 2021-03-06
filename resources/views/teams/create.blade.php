@extends('commons.layouts')
@section('content')
@if(count($friends)>=2)
    <div class="">
        <form method="POST" action="{{route('teams.invite')}}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            <h4 class='mt-4'>チームメイトを２名 friendから招待する</h4>
            <div class="">
                <label for='formInputName' class='mt-2'>member</label>
                <select class='form-control'name='member1'>
                    <label for='member1'>member</label>
                    <option value=''disabled selected style='display:none;'>friend の中から選択</option>
                    @foreach($friends as $friend)
                        <option value='{{$friend->id}}'@if(old('member1')==$friend->id) selected @endif>{{$friend->firstName.' '.$friend->lastName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="">
                <label for='member2' class='mt-4'>member</label>
                <select class='form-control' name='member2'>
                    <label for='member2'>member</label>
                    <option value=''disabled selected style='display:none;'>friend の中から選択</option>
                    @foreach($friends as $friend)
                        <option value='{{$friend->id}}'@if(old('member1')==$friend->id) selected @endif>{{$friend->firstName.' '.$friend->lastName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-center mt-5">
                <button type="submit" class='btn btn-outline-primary btn-lg mt-5 col-sm-8'>invite to the team</button>
            </div>    
        </form>
    </div>
    {{--{!!Form::open(['route'=>['teams.invite'],])!!}
        <div class="form-group">
            {!!Form::label('name','Team name')!!}
            {!!Form::text('name',null,['class'=>'form-control'])!!}
        </div>
        <h4>チームメイトを２名 friendから招待する</h4>
        
        <div class="form-group">
            {!!Form::label('member1','member')!!}
            {!!Form::select('member1',$friends,null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('member2','member')!!}
            {!!Form::select('member2',$friends,null,['class'=>'form-control'])!!}
        </div>
        {!!Form::submit('Invite to the team',['class'=>'btn-block mt-4 btn-lg'])!!}
    {!!Form::close()!!}--}}
@else
    <div class="centering">
        <h3>friend が２人以上いるとチーム作成ができます</h3>
            {{--戻るボタン--}}
            <div class="mt-5 offset-4 col-4">
                {!!link_to_route('users.index','戻る',[],['class'=>'btn btn-outline-secondary btn-block'])!!}
            </div>
    </div>
@endif 
@endsection(‘content’)