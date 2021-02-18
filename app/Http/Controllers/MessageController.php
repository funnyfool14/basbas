<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Chat;
use App\Room;
//これがないと”Auth::"が使えない
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        $own_id=\Auth::id();
        $me=\Auth::user();
        
        $chats=$me->chats()->get();
        
        return view('messages.index',[
            'chats'=>$chats,
            //'messages'=>$messages,
            //'users'=>$users
            ]);
    }
    
    public function show($user_id)
    {
        $own_id=\Auth::id();
        $reciever=User::findOrFail($user_id);
        
        
        $messages=Message::where('own_id',$own_id)->where('user_id',$user_id)->orderBy('id','desc');
        $messages=$messages->orWhere(function($messages)use($own_id,$user_id){
            $messages->where('own_id',$user_id)->where('user_id',$own_id);})->paginate(20);

        return view('messages.show',[
            'own_id'=>$own_id,
            'user_id'=>$user_id,
            'reciever'=>$reciever,
            'messages'=>$messages,]);
        
        //Messageモデルでsender_idのカラムにログインユーザのidがあり
        //かつreciever_idのカラムに指定したユーザのidがあるインスタンスを取得
        /*$messages=Message::where('sender_id','=',$sender_id)->where('reciever_id','=',$reciever_id);
        //AandB orWhere CandD AかつBもしくはCかつD  
        $messages=$messages->orWhere(function($messages)use($sender_id,$reciever_id){
            $messages->where('sender_id','=',$reciever_id);
            $messages->where('reciever_id','=',$sender_id);
        })->get();*/
        
        
        /*return view('messages.show',[
            'sender_id'=>$sender_id,
            'reciever_id'=>$reciever_id,
            'reciever'=>$reciever,
            'messages'=>$messages,]);*/
    }
    
    
    public function store(Request $request,$user_id)
    { 
        $own_id=\Auth::id();
        $message=new Message;
        
        $message->own_id=$own_id;
        $message->user_id=$user_id;
        $message->message=$request->message;
        $message->save();
        
        $message->users()->sync([$own_id,$user_id]);
        
        $messages=Message::orderBy('id','desc')->get();
        
        return redirect(route('messages.show',[
            'messages'=>$messages,
            'id'=>$user_id,
            ]));
    }

}