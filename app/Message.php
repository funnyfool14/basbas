<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable =[
        'chat_id','user_id'/*'sender_id','reciever_id'*/,'message'];
        
        public function user()
    {
        $this->belongsTo(User::class);
    }

}
