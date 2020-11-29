<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
   // public function brand()
    //{
      //  return $this>hasMany(Shoe::class);
    //}
    
    
    public function shoes()
    {
        return $this->hasMany(Shoe::class);
    }
    
        public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
    
        public function nice()
    {
        return $this->belongsToMany(Picture::class,'nice','user_id','pic_id')->withTimestamps();
    }
    
    public function is_nice($picId)
    {
    //Userインスタンスのnice一覧からpic_idのカラムに$picIdがあるか確認
        return $this->nice()->where('pic_id',$picId)->exists();   
    }
    
    public function like($picId)
    {
        $exist=$this->is_nice($picId);
        
        if($exist){
            return false;
        }
        else{
            $this->nice()->attach($picId);
        }
    }
    
    public function not_so($picId)
    {
        $exist=$this->is_nice($picId);
        
        if($exist){
            $this->nice()->detach($picId);
        }
        else{
            return false;
        };
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    public function requests()
    {
        return $this->belongsToMany(User::class,'friends','user_id','friend_id')->withTimestamps();
        
    }
    
    public function asked()
    {
        return $this->belongsToMany(User::class,'friends','friend_id','user_id')->withTimestamps;
    }
        //$user->loadRelationshipCounts();
    
    public function request($friend_id)
    {
        $exist=$this->sent_request($friend_id);
        //$exist=Auth::user()->sent_request($friend_id);
        $its_me=$this->id==$friend_id;
        
        if($exist||$its_me){
            return false;
        }
        else{
            $this->requests()->attach($friend_id);
        }
    }
    
    public function cancel($friend_id)
    {
        $exist=$this->sent_request($friend_id);
        $its_me=$this->id==$friend_id;
        
        if($exist&&$its_me){
            $this->requests()->detach($friend_id);
            
        }
        else{
            return false;
        }
    }
    
    public function refuse()
    {
        ;
    }
    
    public function accept()
    {
        ;
    }
    
    public function sent_request($friend_id)
    {
        return $this->requests()->where('friend_id',$friend_id)->exists(); 
    }
        
    /*public function friends()
    {
        //AかつBの記述方法
        return $this->belongsToMany(User::class,'friends','user_id','friend_id')
        ->hasMany(User::class,'friends','friend_id','user_id')->withTimestamps();
    }*/
    
    
    public function loadRelationshipCounts()
    {
        $this->loadCount(['requests','asked',]);
    }
}
