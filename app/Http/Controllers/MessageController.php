<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Chat;
//これがないと”Auth::"が使えない
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $me=\Auth::user();
        
        $chats=$me->chat()->get();
    }
    
    
    public function show($user_id)
    {
        $me=\Auth::id();
        $my_id=\Auth::id();
        $reciever=User::findOrFail($user_id);
        
        if($me->chats()->where('user_id',$user_id)->exists()){
            $chat_id=$me->chats()->where('user_id',$user_id);
        }
        else{
            $chat=new Chat;
            $chat->save();
            $chat_id=$chat->id;
            
            $me->chats()->attach($chat_id);
            $reciever->chats()->attach($chat_id);
        }
        
        
        $messages=Message::where('user_id',$my_id)->orwhere('user_id',$id)->get();//変更点
        
        return view('messages.show',[
            'chat_id'=>$chat_id,
            'reciever'=>$reciever,
            'messages'=>$messages,]);
        
        /*$sender_id=\Auth::user()->id;
        $reciever=User::findOrFail($id);
        $reciever_id=$reciever->id;        
        //Messageモデルでsender_idのカラムにログインユーザのidがあり
        //かつreciever_idのカラムに指定したユーザのidがあるインスタンスを取得
        $messages=Message::where('sender_id','=',$sender_id)->where('reciever_id','=',$reciever_id);
        //AandB orWhere CandD AかつBもしくはCかつD  
        $messages=$messages->orWhere(function($messages)use($sender_id,$reciever_id){
            $messages->where('sender_id','=',$reciever_id);
            $messages->where('reciever_id','=',$sender_id);
        })->get();*/
        
        //試す
        /*$messages=Message::where('sender_id','=',$sender_id)->where('reciever_id','=',$reciever_id)
        ->orWhere('sender_id','=',$reciever_id)->where('reciever_id','=',$sender_id)->get()*/
        
        /*return view('messages.show',[
            'sender_id'=>$sender_id,
            'reciever_id'=>$reciever_id,
            'reciever'=>$reciever,
            'messages'=>$messages,]);*/
    }
    
    
    public function store(Request $request,$user_id)
    { 
        $me=\Auth::user();
        $message=new Message;
        $chat=$me->chats()->where('user_id',$user_id);
        
        
        $message->chat_id=$chat->id;    
        $message->user_id=Auth::id();
        $message->message=$request->message;
        $message->save();
        
        //$messages=Message::orderBy('id','desc')->get();
        
        return redirect(route('messages.show',[
            'chat_id'=>$chat_id,
            ]));
    }

}
