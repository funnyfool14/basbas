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
    
}
