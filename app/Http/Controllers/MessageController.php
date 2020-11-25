<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;

class MessageController extends Controller
{
    public function show($id)
    {
        $sender_id=\Auth::user()->id;
        $reciever_id=User::findOrFail($id)->id;
        $message=new Message;
        /*Messageモデルでsender_idのカラムにログインユーザのidがあり
        reciever_idのカラムに指定したユーザのidがあるインスタンスを取得*/
        $messages=Message::where('sender_id',$sender_id)->where('reciever_id',$reciever_id);
        //AandB orWhere CandD AかつBもしくはCかつD  
        $messages->orWhere(function($messages)use($sender_id,$reciever_id){
            $messages->where('sender_id',$reciever_id);
            $messages->where('reciever_id',$sender_id);
        });
        return view('messages.show',[
            'sender_id'=>$sender_id,
            'reciever_id'=>$reciever_id,
            'messages'=>$messages,
            'message'=>$message,]);
    }
    
    public function store(Request $request)
    {   
        $request->validate([
            'message'=>'required|max:255',
            ]);
        $sender_id=\Auth::id();
        $message=$request->message;
        
        $request->user()->messages()->create([
            'sender_id'=>$request->sender_id,
            'message'=>$request->messsage,
            ]);
        return redirect()->route('messages.show');
    }
    
    
    public function create()
    {
        $message=new Message;
        
        return view('messages,show');
    }
}
