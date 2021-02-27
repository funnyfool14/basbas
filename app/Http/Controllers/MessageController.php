<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Chat;
use App\Room;
//日付表示のためのライブラリ
use Carbon\Carbon;
//これがないと”Auth::"が使えない
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        $own_id=\Auth::id();
        $me=\Auth::user();
        
        $chat_ids=DB::table('users_chats')->where('user_id',$own_id)->orderBy('updated_at','desc')->pluck('chat_id');
        $chats=Chat::findOrFail($chat_ids);
        
        return view('messages.index',[
            'chats'=>$chats,
            ]);
    }
    
    public function show($user_id)
    {
        $own_id=\Auth::id();
        $user=User::findOrFail($user_id);
        
        //$user_idの関連するchat_idと共通の値をもつ中間テーブルのデータから$own_idをもつデータを取得
        $user_chat=DB::table('users_chats')->whereIn('chat_id',function($query)use($user_id,$own_id){
            $query->select('chat_id')->from('users_chats')->where('user_id',$user_id);
        })->where('user_id',$own_id)->first();
        //Chatのインスタンスがない時
        if(is_null($user_chat)){
            //インスタンスを生成して
            $chat=new Chat;
            $chat->save();
            //中間テーブルに$user_idとown_idを代入
            $chat->users()->sync([$own_id,$user_id]);
            //$user_idの関連するchat_idと共通の値をもつ中間テーブルのデータから$own_idをもつデータを取得
            $user_chat=DB::table('users_chats')->whereIn('chat_id',function($query)use($user_id,$own_id){
                $query->select('chat_id')->from('users_chats')->where('user_id',$user_id);
            })->where('user_id',$own_id)->first();
        }
        //$chat_idを中間テーブルの値から定義
        $chat_id=$user_chat->chat_id;
        //$chat_idからChatのインスタンスを取得
        $chat=Chat::findOrFail($chat_id);
        $user=User::findOrFail($user_id);
        
        //chatに関連するmessageを取得
        //$messages=$chat->messages()->orderBy('id','desc')->paginate(20);
        $messages=$chat->messages()->latest()->paginate(20);
        return view('messages.show',[
            'own_id'=>$own_id,
            'user_id'=>$user_id,
            'user'=>$user,
            'messages'=>$messages,]);
    }
    
    
    public function store(Request $request,$user_id)
    { 
        $own_id=\Auth::id();
        $user=User::findOrFail($user_id);
        
        //$user_idの関連するchat_idと共通の値���もつ中間テーブルのデータから$own_idをもつデータを取得
        $user_chat=DB::table('users_chats')->whereIn('chat_id',function($query)use($user_id,$own_id){
            $query->select('chat_id')->from('users_chats')->where('user_id',$user_id);
        })->where('user_id',$own_id)->first();
        
        $chat_id=$user_chat->chat_id;
        $chat=Chat::findOrFail($chat_id);
        
        $message=new Message;
        $message->user_id=$own_id;
        $message->chat_id=$chat_id;
        $message->message=$request->message;
        $message->save();
        
        $chat->latest_message=$request->message;
        $chat->save();
        
        return redirect(route('messages.show',[
            'id'=>$user_id,
            ]));
    }

}