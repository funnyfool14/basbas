@extends('commons.layouts')
@section('content')
    <div class="row">
        {{--左側表示--}}
        {{--シューズ--}}
        <aside class="col-sm-6">
            @include('shoes.show')
            <div class="row">
                @include('users.button')
                @include('users.profile')
            </div>
        </aside>
        {{--右側表示--}}
        <div class="col-sm-6">
            <div class="row">
                <h3 class="offset-6">{{$user->firstName}}</h3>
                <h3 class="ml-2">{{$user->lastName}}</h3>
            </div>
                {{--ユーザ写真--}}
                @include('users.picture')
                @if(isset($profiles))
                    @if(!is_null($profile->coment))
                        <div class="mt-2">
                            <h5 class="text-right">{{$profile->coment}}</h5>
                        </div>
                    @endif
                @endif
            {{--topに戻る--}}
            <div class="text-right mt-4">
                <h3>{!!link_to_route('users.index','back to top',[])!!}</h3>
            </div>
        </div>
        <div class="row">
            @foreach($pictures as $picture)
                <div class="col-sm-4 mt-4">
                    <img class=""src="{{asset('storage/'.$picture->pic)}}" alt="" width=100%></li>
                    @include('commons.nice_button')
                </div>
            @endforeach
        </div>
    </div>
@endsection(‘content’)