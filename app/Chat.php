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
        return $this->belongsToMany(User::class,'chats_users','chat_id','user_id')->withTimestamps();
    }
}