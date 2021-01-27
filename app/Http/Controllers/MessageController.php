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
        //$me=\Auth::user();
        
        //$chats=$me->chats()->get();
    }
    
    
    public function show($user_id)
    {
        $chat_id=0;
        $me=\Auth::user();
        $my_id=\Auth::id();
        $reciever=User::findOrFail($user_id);

        //自分と紐づくチャット一覧を取得
        $chats=$me->chats;
        foreach($chats as $chat){
            //dd($chat);
            //それぞれのチャットのユーザを配列にして取り出す
            $ids=$chat->users()->pluck('user_id')->toArray();
            //$my_idと$user_idの配列の組み合わせがあれば
            if(in_array($my_id,$ids)&&in_array($user_id,$ids)){
                //その組み合わせのチャットのidを取り出す
                $chat_id=$chat->id
            ;}
            
            if($chat_id){
                $chat=Chat::find($chat_id);
            }
            //なければ
            else{
                //インスタンスを生成し
                $chat=new Chat;
                $chat->save();
                //生成したチャットのインスタンスからidを取得
                $chat_id=$chat->id;
                //自分と相手のidを中間テーブルにレコード
                $chat->users()->sync([$my_id,$user_id]);
            }
        }
        //chat_idでメッセージを呼び出す
        $messages=Message::where('chat_id',$chat_id);
        
        return view('messages.show',[
            'id'=>$chat_id,
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
