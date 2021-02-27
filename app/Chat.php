<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class,'users_chats','chat_id','user_id')->withTimestamps();
    }
    
    public function chat_user()
    {   
        $own_id=\Auth::id();
        $users_ids=$this->users()->where('user_id','!=',$own_id)->pluck('user_id');
        return User::findOrFail($users_ids);
    }
    public function dates()
    {
        //updated_atから年月日のみ取得
        $date=\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('Y-m-d');
        //updated_atの日時を変数に代入
        $update=\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at);
        
        //update_atの年月日が今日の年月日の場合
        if($date==\Carbon\Carbon::now()->toDateString()){
            //updatede_atの時間を返す
            return $update->format('H:i');
        }
        //それ以外は
        else{
            //updated_atの月日を返す
            return $update->format('m月d日');
        }
        
    }
    
}