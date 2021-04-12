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
            if($introduction){
                if($introduction->deputy){
                    return $this->users()->whereNotIn('user_id',[$this->captain,$this->deputy()->id])->get();
                }
                else{
                    return $this->users()->where('user_id','!=',$this->captain)->get();
                }
            }
            else{
                return $this->users()->where('user_id','!=',$this->captain)->get();
            }
            
    }
    
     public function appointment()//キャプテン以外のメンバー/副キャプテンの任命
     {
         return $this->users()->where('user_id','!=',$this->captain)->get();
     }
    public function captain()
    {
        return User::find($this->captain);
    }
    public function deputy()
    {
        $introduction=$this->introduction()->first();
        $user_id=$introduction->deputy;
        
        return User::find($user_id);
    }
     
}