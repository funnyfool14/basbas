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
                //副キャプテンがいる時
                if($introduction->deputy){
                    //キャプテンと副キャプテン以外のメンバーを返す
                    return $this->users()->whereNotIn('user_id',[$this->captain,$this->deputy()->id])->get();
                }
                else{
                    //副キャプテンがいなければキャプテン以外のメンバーを返す
                    return $this->users()->where('user_id','!=',$this->captain)->get();
                }
            }
            else{
                //intoroductionがまだなければキャプテン以外のメンバーを返す
                return $this->users()->where('user_id','!=',$this->captain)->get();
            }
    }
        
    public function is_member()//募集中表示のメンバー判定
    {
        return $this->users()->where('user_id',\Auth::id())->exists();
    }
    public function not_member($user_id)//非メンバー判定
    {
        return $this->users()->where('user_id',$user_id)->doesntExist();
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
    
    public function application()
    {
        return $this->hasOne(Application::class)->first();
    }
    
    public function applicant()
    {
        return $this->application()->users()->where('user_id',\Auth::id())->exists();
    }
   /* public function unchecked_messages_count()
    {
        $aprications=$this->applications();
        foreach($aprications as $application){
            $
        }
    }*/
    
}