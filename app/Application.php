<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function messages()
    {
        return $this->hasMany(Team_message::class)->where('application_id',$this->id)->orderBy('id','desc')->get();
    }
    
    public function unchecked_messages_count()
    {
        return $this->messages()->where('check',0)->count();
    }
     
    
    public function users()
    {
        return $this->belongsToMany(User::class,'users_applications','application_id','user_id')->withTimestamps();
    }
    
    /*public function user()//4/29削除
    {
        return $this->users()->where('user_id',\Auth::id())->first();
    }*/
}
