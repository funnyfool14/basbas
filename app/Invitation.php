<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class,'invitations_users','invitation_id','user_id')->withTimestamps();
    }
    
    public function sign()
    {
        $own_id=\Auth::id();
        return $this->users()->attach($own_id,['accept'=>'1']);
    }
}
