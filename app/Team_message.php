<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team_message extends Model
{
    public function user()//メッセージの送信者の呼び出し
    {
        return $this->belongsTo(User::class)->first();
    }
    
    public function team()//messageからテームを呼び出す
    {
        $application=Application::find($this->application_id);
        return Team::find($application->team_id)->first();
    }
    
    public function applicant()//messageのuser_idがメンバーのidじゃない
    {
        $team=$this->team();
        
        return $team->users()->where('user_id',$this->user_id)->doesntExist();
    }
}
