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
       
    }
    
    
    public function show($id)
    {
        
        $sender_id=\Auth::user()->id;
        $reciever=User::findOrFail($id);
        $reciever_id=$reciever->id;        
        /*Messageモデルでsender_idのカラムにログインユーザのidがあり
        かつreciever_idのカラムに指定したユーザのidがあるインスタンスを取得*/
        $messages=Message::where('sender_id','=',$sender_id)->where('reciever_id','=',$reciever_id);
        //AandB orWhere CandD AかつBもしくはCかつD  
        $messages=$messages->orWhere(function($messages)use($sender_id,$reciever_id){
            $messages->where('sender_id','=',$reciever_id);
            $messages->where('reciever_id','=',$sender_id);
        })->get();
        
        //試す
        /*$messages=Message::where('sender_id','=',$sender_id)->where('reciever_id','=',$reciever_id)
        ->orWhere('sender_id','=',$reciever_id)->where('reciever_id','=',$sender_id)->get()*/
        
        return view('messages.show',[
            'sender_id'=>$sender_id,
            'reciever'=>$reciever,
            'reciever_id'=>$reciever_id,
            'messages'=>$messages,]);
    }
    
    
    public function store(Request $request,$reciever_id)
    {   
    
        $me=\Auth::user();
        $exist=$me->chat()->where('user_id',$reciever_id);
        
        $message=new Message;
        $request->validate([
            'message'=>'required|max:255',
            ]);
        
        if($exist){
            $chat=$me->chat()->where('user_id',$reciever_id);
        }
        else{
            $chat=new Chat;
            $chat->user_id=$reciever_id;
            $chat->save();
        }
        
        $message->chat_id=$chat->id;    
        $message->sender_id=Auth::id();
        $message->reciever_id=$reciever_id;
        $message->message=$request->message;
        $message->save();
        
        //$messages=Message::orderBy('id','desc')->get();
        
        return redirect(route('messages.show',[
            'id'=>$reciever_id,
            ]));
    }

}
