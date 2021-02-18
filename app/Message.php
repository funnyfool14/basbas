<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable =[
        'own_id','user_id','message'];
        
    public function user()
    {
        $this->belongsTo(User::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class,'chats','message_id','user_id')->withTimestamps();
    }
    
}
