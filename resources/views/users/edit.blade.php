@extends('commons.layouts')
@section('content')
    @if(Auth::check())
        <div class="row">
            <aside class="col-sm-6">
                <p class="mt-1">-shoes一覧-</p>
                    {{--shose一覧を表示--}}
                    @foreach($manyShoes as $shoes)
                        {{--shoes情報--}}
                        <div class="row mt-3">
                            <div class="col-3">
                                @if(empty($shoes->shoes_pic))
                                    <img class="shoes_pic_small"src="{{asset('image/shoes_pic.jpg')}}" alt="">
                                @else
                                    <img class="shoes_pic_small"src="{{asset('storage/'.$shoes->shoes_pic)}}" alt="">
                                @endif
                            </div>
                            <div class="mt-1 col-9">
                                <h5 class="">{!!$shoes->brand!!}</h5>
                                <h4 class="offset-1">{!!$shoes->model!!}</h4>
                                @if(!is_null($shoes->size))
                                    <h5 class="mt-2 ml-3">{!!number_format($shoes->size, 1)!!}cm</h5>
                                @endif
                            </div>
                        </div>
                        {{--ボタン--}}
                        <div class="row">
                            <div class="col-sm-6">
                                {!!Form::model($shoes,['route'=>['shoes.edit',$shoes->id],'method'=>'get','class'=>'xxxx'])!!}
    　                          {!!Form::submit('edit',['class'=>'btn btn-outline-secondary btn-sm btn-block'])!!}
                            　  {!!Form::close()!!}
                            </div>
                            <div class="col-sm-6">
                                {!!Form::model($shoes,['route'=>['shoes.destroy',$shoes->id],'method'=>'delete','class'=>'xxxx'])!!}
                                {!!Form::submit('delete',['class'=>'btn btn-outline-danger btn-sm btn-block'])!!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                    @endforeach
                    {{--shoes 新規作成--}}
                    <div class="mt-4">
                        {!!link_to_route('shoes.create','get new shose!',[],['class'=>'btn btn-outline-primary btn-block'])!!}
                    </div>
                    {{--プロフィール--}}
                    @if (empty($profile)){{--未作成--}}
                        <div class="profile_edit">
                            {!!Form::model($profile,['route'=>['profile.store',$user->id],'files'=>true,'method'=>'post','enctype'=>"multipart/form-data",])!!}
                    @else{{--作成済み--}}
                        <div class="profile_edit">
                            {!!Form::model($profile,['route'=>['profile.update',$profile->id],'files'=>true,'method'=>'put','enctype'=>"multipart/form-data",])!!}
                    @endif
                            <div class="form-group">
                                {!!Form::file('user_pic')!!}
                            </div>
                            <div class="form-group">  
                                {!!Form::label('nickname','ニックネーム')!!}
                                {!!Form::text('nickname',null,['class'=>'form-control'])!!}
                            </div>   
                            <div class="form-group">                            
                                {!!Form::label('gender','性別')!!}
                                {!!Form::text('gender',null,['class'=>'form-control'])!!}
                            </div>   
                            <div class="form-group">
                                {!!Form::label('birthplace','出身地')!!}
                                {!!Form::text('birthplace',null,['class'=>'form-control'])!!}
                            </div>   
                            <div class="form-group">
                                {!!Form::label('local','居住地')!!}
                                {!!Form::text('local',null,['class'=>'form-control'])!!}
                            </div>   
                            <div class="form-group">
                                {!!Form::label('position','ポジション')!!}
                                {!!Form::text('position',null,['class'=>'form-control'])!!}
                            </div>   
                            <div class="form-group">  
                                {!!Form::label('favorite_player','好きな選手')!!}
                                {!!Form::text('favorite_player',null,['class'=>'form-control'])!!}
                            </div>
                            <div class="form-group">  
                                {!!Form::label('coment','コメント')!!}
                                {!!Form::text('coment',null,['class'=>'form-control'])!!}
                            </div>
                            {!!Form::submit('register',['class'=>'mt-2 btn btn-outline-primary'])!!}
                        {!!Form::close()!!}
                    </div>
                </aside>
                {{--表示右側--}}
                <div class="col-sm-6">
                    <div class="row">
                        <h3 class="text-right">{{ Auth::user()->firstName.' '.Auth::user()->lastName}}</h3>
                    </div>
                    <div class="text-right">
                        {!!Form::model($user,['route'=>['users.update',$user->id],'method'=>'put'])!!}
                        {!!Form::label('firstName','rename')!!}
                        {!!Form::text('firstName',null)!!}
                        {!!Form::text('lastName',null)!!}
                        {!!Form::submit('update',[])!!}
                        {!!Form::close()!!}
                    </div>
                {{--ユーザ写真--}}
                    @if(empty($profile->user_pic))
                        <img class="user_pic"src="{{asset('image/user_pic.jpg')}}" alt="">
                    @else
                        <img class="user_pic"src="{{asset('storage/'.$user->pic)}}" alt="">
                    @endif
                    
                </div>
            {{--pic表示--}}
            <div class="row mt-4">
                @foreach($pictures as $picture)
                    <div class="col-4">
                        <img class="mt-1"src="{{asset('storage/'.$picture->pic)}}" alt="" width=100%></li>
                        {{--link_to_routeだとgetメソッドにルートされる
                        {!!link_to_route('pictures.destroy','delete',[$picture->id],['class'=>'text-danger'])!!}--}}
                        <div class="mb-2">
                            {!!Form::model($picture,['route'=>['pictures.destroy',$picture->id],'method'=>'delete'])!!}
　                          {!!Form::submit('delete',['class'=>'btn btn-outline-danger btn-sm btn-block'])!!}
                            {!!Form::close()!!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="text-center">
            <h1>{!!link_to_route('login','log in',[],)!!}</h1>
            <p class="mt-4">or</p>
            <h1 class="mb-5">{!!link_to_route('signup.get','register',[],)!!} </h1>
            <h1 class="mt-5">Bas×Bas</h1>
        </div>
    @endif
@endsection('content')