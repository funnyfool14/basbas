<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class,'users_invitations','invitation_id','user_id')->withTimestamps();
    }
}
