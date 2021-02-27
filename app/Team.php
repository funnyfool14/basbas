<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function usres(){
        return $this->belongsToMany(User::class,'users_teams','team_id','user_id')->withTimestamps();
    }
}
