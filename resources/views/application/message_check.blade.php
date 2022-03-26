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