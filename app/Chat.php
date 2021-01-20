<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
    
    public function reciever()
    {
        return $this->belongsTo(User::class,'reciver_id');
    }
}
