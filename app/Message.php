<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable =[
        'chat/id','sender_id','reciever_id','message'];
    
    /*public function  user(){
        return $this->belongsTo(User::class);
    }*/
    
    public function  sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
    
    public function  reciever(){
        return $this->belongsTo(User::class,'reciever_id');
    }
    
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
    
}
