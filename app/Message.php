<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable =[
        'chat_id','sender_id','reciever_id','message'];
    
    /*public function  user(){
        return $this->belongsTo(User::class);
    }*/
    public function chat()
    {
        return $this->belongsToMany(User::class,'chats','message_id','my_id')->withTimeStamps();
    }    
    
}
