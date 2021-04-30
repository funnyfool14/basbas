@extends('commons.layouts')
@section('content')
{{--メッセージ送信ボタンと申し込みボタン--}}
    {{--メッセージボタンでメッセージ送信--}}
    <h1 class='mb-5'>{{$team->name}}</h1>
    <form method='POST' action='{{route('application.message',['application'=>$team->id])}}' enctype='multipart/form-data'>
        @csrf
        @method('POST')
        <div class='row'>
            <div class="form-group col-sm-9">
                <input type="text" class="form-control" name="message" value=''>
            </div>
            <div class='ml-3'>
                <button type="submit" class='btn btn-outline-primary'>send</button>
            </div>
        </div>    
    </form>
    <div class=''>
        @foreach($messages as $message)
            <div class='mt-5'>
                @if($message->applicant())
                    <div class="text-right">
                        <div class='row'>
             	            <h3 class='col-sm-10'>{{$message->message}}</h3>
             	            @if(($message->user_id)==Auth::id())
                                <form method='POST' action='{{route('application.message_delete',['message'=>$message->id])}}' enctype='multipart/form-data'>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class='btn btn-outline-danger btn-sm'>delete</button>
                                </form>
                            @elseif(($team->captain())==Auth::user()|($team->deputy())==Auth::user())
                                @if(($message->check)==0)
                                    <form method='POST' action='{{route('application.message_check',['message'=>$message->id])}}' enctype='multipart/form-data'>
                                        @csrf
                                        @method('put')
                                        <button type="submit" class='btn btn-outline-danger btn-sm'>要チェック</button>
                                    </form>
                                @elseif(($message->check)!=0)
                                    <form method='POST' action='{{route('application.message_recheck',['message'=>$message->id])}}' enctype='multipart/form-data'>
                                        @csrf
                                        @method('put')
                                        <button type="submit" class='btn btn-outline-success btn-sm'>チェック済</button>
                                    </form>    
                                @endif    
                            @endif    
                        </div>    
                 	    <h4 class=''>{{$message->user()->firstName.' '.$message->user()->lastName}}</h4>
	                </div>
    	        @else
	                <div class='text-left'>
                        <div class='row'>
             	            @if(($message->user_id)==Auth::id())
                                <div class='form-group offset-sm-1'>
                                    <form method='POST' action='{{route('application.message_delete',['message'=>$message->id])}}' enctype='multipart/form-data'>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class='btn btn-outline-danger btn-sm'>delete</button>
                                    </form>
                                </div>
                            @endif
             	            <h3 class='offset-sm-1'>{{$message->message}}</h3>
                        </div>   
                 	    <h4 class=''>{{$message->user()->firstName.' '.$message->user()->lastName}}</h4>
	                </div>
    	       @endif
    	   </div>
    	@endforeach
	</div>       
@endsection('content')