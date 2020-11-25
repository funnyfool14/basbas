<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable =[
        'sender_id','reciver_id','mesage'];
    
    public function user(){
    return $this->belongsTo(User::class);
    }
}
