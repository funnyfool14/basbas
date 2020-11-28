<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
//これがないと”Auth::"が使えない
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $users=User::where('id','<>',$user->id)->get();
        
        return view('messages.index',[
            'users'=>$users,
            /*'message'=>$message,*/]);
    }
    
    
    public function show($id)
    {
        $sender_id=\Auth::user()->id;
        $reciever_id=User::findOrFail($id)->id;
        /*Messageモデルでsender_idのカラムにログインユーザのidがあり
        かつreciever_idのカラムに指定したユーザのidがあるインスタンスを取得*/
        $messages=Message::where('sender_id','=',$sender_id)->where('reciever_id','=',$reciever_id);
        //AandB orWhere CandD AかつBもしくはCかつD  
        $messages->orWhere(function($messages)use($sender_id,$reciever_id){
            $messages->where('sender_id','=',$reciever_id);
            $messages->where('reciever_id','=',$sender_id);
        });
        return view('messages.show',[
            'sender_id'=>$sender_id,
            'reciever_id'=>$reciever_id,
            'messages'=>$messages,]);
    }
    
    
    public function store(Request $request,$reciever_id)
    {   
        $message=new Message;
        $request->validate([
            'message'=>'required|max:255',
            ]);
            
        $message->sender_id=Auth::id();
        $message->reciever_id=$reciever_id;
        $message->message=$request->message;
        $message->save();
        
        //$messages=Message::orderBy('id','desc')->get();
        
        return redirect(route('messages.show',[
            'id'=>$reciever_id,
            ]));
    }
    
    
    public function create()
    {
        $message=new Message;
        
        return view('messages,show');
    }
}
