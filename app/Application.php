<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function messages()
    {
        return $this->hasMany(Team_message::class)->orderBy('created_at','desc')->get();
    }
    
    public function unchecked_messages_count()
    {
        return $this->messages()->where('check',0)->count();
    }
     
    
    public function users()
    {
        return $this->belongsToMany(User::class,'users_applications','application_id','user_id')->withTimestamps();
    }
    
    public function connect()//中間テーブルのデータを呼び出す
    {
        return \DB::table('users_applications')->where('application_id',$this->id)->where('user_id',\Auth::id())->first();
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class)->first();
    }
    
    public function applicant()
    {
        return $this->users()->where('user_id',\Auth::id())->exists();
    }
    
    public function not_applicant()
    {
        return $this->users()->where('user_id',\Auth::id())->doesntExist();
    }
    
    public function last_message()//中間テーブルのlast_message呼び出す
    {
        return DB::table('users_applications')->where('id',$connect_id)->first()->last_message;
    }
    
    public function apply()//中間テーブルのacceptの値を判別/application.showの入部申込ボタンに使用
    {
        return $this->connect()->accept;
    }
    
}
