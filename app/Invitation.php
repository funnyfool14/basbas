<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class,'invitations_users','invitation_id','user_id')->withTimestamps();
    }
    
    public function unsigned()
    {
        return $this->users()->where('accept',0)->get();
    }
    
    public function sign()
    {
        $own_id=\Auth::id();
        return $this->users()->where('user_id',$own_id)->where('accept',0)->updateExistingPivot($own_id,['accept'=>'1']);
    }
    
    public function signed($invitation_id)
    {
        return $this->users()->where('invitation_id',$invitation_id)->where('accept',0)->doesntExist();
    }
}
