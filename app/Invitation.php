<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invitation extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class,'invitations_users','invitation_id','user_id')->withPivot(['accept'])->withTimestamps();
    }
    
    public function sign()//招待を受け参加する
    {
        $own_id=\Auth::id();
        return $this->users()->where('user_id',$own_id)->whereIn('accept',[0,2])->updateExistingPivot($own_id,['accept'=>'1']);
    }
    
    public function not_sign($user_id)//招待を断る
    {
        return $this->users()->where('user_id',$user_id)->updateExistingPivot($user_id,['accept'=>'2']);
    }
    
    public function signed()//team作成時の判定
    {
        //return $this->users()->where('accept',0)->orWhere('accept',2)->doesntExist();
        return $this->users()->where('accept',1)->count();
    }
    
    
    /*public function unsigned($user_id)
    {
        return $this->users()->where('user_id',$user_id)->where('accept',0)->exists();
    }*/
    
    public function not_signed()//招待を受け返事をしてない時の判定
    {
        return $this->users()->where('accept',0)->get();
    }
    
    public function accept()//friendを招待し直す人数を判定
    {
        return $this->users()->where('accept',1)->get();
    }
    
    
    public function waiting()//チーム結成の承諾待ち　再勧誘の必要がないinvitation
    {
        return $this->users()->whereIn('accept',[0,1])->get();
    }
    
    
    public function not_invited()//再招待リスト/invitations.reinvite
    {
        $invitation_id=$this->id;
        //friendで紐づいているユーザのid
        $friend_ids=\Auth::user()->friends()->pluck('friend_id');
        //招待されたことのないユーザのid
        return User::whereNotIn('id',function ($query) use ($invitation_id){
            $query->select('user_id')->from('invitations_users')->where('invitation_id',$invitation_id);
        })->find($friend_ids);
    }
    
    public function inviting_users()//acceptni0か1のレコード
    {
        //return $this->users()->where('accept',0)->orWhere('accept',1);
        return $this->users()->wherePivotIn('accept', [0, 1]);
        /*$own_id=\Auth::id();
        
        return DB::table('invitations_users')->whereIn('invitation_id',function($query)use($own_id){
            $query->select('invitation_id')->from('invitations_users')->where('user_id',$own_id);
        })->wherePivotIn('accept', [0, 1]);*/
    }
    
}
