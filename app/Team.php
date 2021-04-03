<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function users(){
        return $this->belongsToMany(User::class,'users_teams','team_id','user_id')->withTimestamps();
    }
    
    public function introduction()
    {
        return $this->hasOne(Introduction::class);
    }
    public function members()//キャプテンと副キャプテンを除外/チームのメンバー一覧
    {
        $introduction=$this->introduction()->first();
        
        if($introduction->deputy){
            return $this->users()->whereNotIn('id',[$this->captain,$this->introduction()->deputy])->get();
        }
        else{
            return $this->users()->where('user_id','!=',$this->captain)->get();
        }
    }
}
