<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Chat;
//これがないと”Auth::"が使えない
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        //$me=\Auth::user();
        
        //$chats=$me->chats()->get();
    }
    
    
    public function show($user_id)
    {
        //$chat_id=0;
        $me=\Auth::user();
        $my_id=\Auth::id();
        $reciever=User::findOrFail($user_id);
        
        //DB::table('chats_users')->where('user_id',$user_id)->get('chat_id')->toArray()を無名関数で呼び出し
        //相手の紐づくchat_idを取得
        $chat_id=DB::table('chats_users')->whereIn('chat_id', function ($query) use ($user_id) {
            $query->select('chat_id')
                ->from('chats_users')
                ->where('user_id', $user_id);
        //その中から自分に紐づくcaht_idを取得し$chatとして定義
        })->where('user_id', $my_id)->first('chat_id');
        
        //$chatがある時
        /*if(isset($chat)){
            $chat_id=$chat->id;
        }
        //$chatがない時
        else{*/if(is_null($chat_id)){
            $chat=new Chat;
            $chat->save();
            //生成したチャットのインスタンスからidを取得
            $chat_id=$chat->id;
            //自分と相手のidを中間テーブルにレコード
            $chat->users()->sync([$my_id,$user_id]);
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