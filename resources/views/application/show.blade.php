@extends('commons.layouts')
@section('content')
{{--メッセージ送信ボタンと申し込みボタン--}}
    {{--メッセージボタンでメッセージ送信--}} 
<div class ="row">    
    <h1 class='mb-5'>{{link_to_route('team.show',$team->name,[$team->id],[])}}</h1>
    <div class='offset-sm-1 col-sm-4'>
        @if($team->applicant())
            @if(($application->apply())==0)
            <form method='POST' action='{{route('application.request',['id'=>$connect_id])}}' enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                <button type="submit" class='btn btn-outline-primary btn-block btn-lg'>入部を申し込む</button>
            </form>
            @elseif(($application->apply())==1)
            <form method='POST' action='{{route('application.request',['id'=>$connect_id])}}' enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                <button type="submit" class='btn btn-outline-danger btn-block btn-lg'>申し込みのキャンセル</button>
            </form>
            @endif
        @endif
    </div>
</div>
<div>
    <form method='POST' action='{{route('application.message',['application'=>$connect_id])}}' enctype='multipart/form-data'>
        @csrf
        @method('POST')
        <div class='row'>
            <div class="form-group col-sm-9">
                <textarea type="text" class="form-control" style ="height:40px" name="message" ></textarea>
            </div>
            <div class='ml-3 col-sm-2'>
                <button type="submit" class='btn btn-outline-success btn-block'>send</button>
            </div>
        </div>    
    </form>
</div>
<div class=''>
    @foreach($messages as $message)
        <div class='mt-5'>
            @if($message->applicant())
            <div class="text-right">
                <div class='row'>
                    <h3 class='col-sm-10'>{!!nl2br(e($message->message))!!}</h3>
                    {{--メッセージ送信者に削除ボタン--}}
                    <div class='col-sm-2'>
                        @if(($message->user_id)==Auth::id())
                        <form method='POST' action='{{route('application.message_delete',['message'=>$message->id])}}' enctype='multipart/form-data'>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class='btn btn-outline-danger btn-sm'>delete</button>
                        </form>
                        {{--キャプテンと副キャプテンに既読チェックボタン--}}    
                        @elseif(($team->captain())==Auth::user())
                        @include('application.message_check')
                        @elseif($team->introduction())
                            @if(($team->deputy())==Auth::user())
                            @include('application.message_check')
                            @endif
                        @endif
                    </div>
                </div>    
                <h4 class='mr-5'>{{$message->user()->firstName.' '.$message->user()->lastName}}</h4>
            </div>
            @else
            <div class='text-left'>
                <div class='row'>
                    @if(($message->user_id)==Auth::id())
                    <div class='form-group col-sm-1 '>
                        <form method='POST' action='{{route('application.message_delete',['message'=>$message->id])}}' enctype='multipart/form-data'>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class='btn btn-outline-danger btn-sm btn-block'>delete</button>
                        </form>
                    </div>
                    @else
                    <div class='offset-sm-1'>{{''}}</div>
                    @endif
                    <h3 class='offset-sm-1'>{!!nl2br(e($message->message))!!}</h3>
                </div>   
                <h4 class='ml-5'>{{$message->user()->firstName.' '.$message->user()->lastName}}</h4>
            </div>
            @endif
        </div>
    @endforeach
</div>       
@endsection('content')