<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName','lastName', 'email', 'password','comment'
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
    
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }    
    
    
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
    
    public function requests()
    {
        //自分が誰かにリクエストを送って未承認の数の取得
        return $this->belongsToMany(User::class,'friends','user_id','friend_id')->withTimestamps();
        
    }
    
    public function requested()
    {
        //承認してないリクエストの数の取得
        return $this->belongsToMany(User::class,'friends','friend_id','user_id')->where('accept',0)->withTimestamps();
    }
    
    public function friends()
    {   
        //承認したリクエストの数の取得
        return $this->belongsToMany(User::class,'friends','user_id','friend_id')->where('accept',1)->withTimestamps();;
        
        // return $data1->union($data2->select(DB::raw('users.*, `friends`.`user_id` as `pivot_user_id`, `friends`.`friend_id` as `pivot_friend_id`')));
    
        /*$data1 = $this->leftJoin('friends', 'users.id', '=', 'friends.friend_id')->where('user_id', $this->id)->where('accept', 1)->select('users.*');
        $data2 = $this->leftJoin('friends', 'users.id', '=', 'friends.user_id')->where('friend_id', $this->id)->where('accept', 1)->select('users.*');

        return $data1->union($data2);*/
    
    }
    
    public function is_friend($friend_id)
    {
        return $this->friends()->where('user_id',$friend_id)->exists();
    }
    
    
    public function request($friend_id)
    {
        $exist=$this->sent_request($friend_id);
        $its_me=$this->id==$friend_id;
        
        //リクエスト済みなら実行しない
        if($exist||$its_me){
            return false;
        }
        else{
            //リクエストしてなければfriend_idカラムに$friend_idを入力
            $this->requests()->attach($friend_id);
        }
    }
    
    public function accept($friend_id)
    {
        $requestuser=User::findOrFail($friend_id);
        $requests_id=\Auth::id();
        
        //リクエストされた側のidをリクエストしたユーザのfriend_idに入力しacceptカラムを１にする
        $requestuser->requested()->attach($this->id,['accept'=>'1']);
        //送られたリクエストのacceptカラムを１にする
        return $this->requested()->updateExistingPivot($friend_id,['accept'=>'1']);
        
        //return $this->requested()->attach($friend_id,['accept'=>'1']);
        /*ここから下を実行するとFriendsTableのデータごと消える
        $requestuser->requested()->detach($requests_id);
        $requestuser->requests()->detach($requests_id);
        $this->requested()->detach($friend_id);
        return $this->requests()->detach($friend_id);*/
        
        //同じデータで同じことしてるだけ
        /*$requestuser->requests()->updateExistingPivot($requests_id,['accept'=>'1']);
        return $this->requested()->updateExistingPivot($friend_id,['accept'=>'1']);*/
    }
    
    
    public function sent_request($friend_id)
    {
        return $this->requests()->where('friend_id',$friend_id)->exists(); 
    }
    
        public function take_request($friend_id)
    {
        $requestuser=User::findOrFail($friend_id);
        $my_id=\Auth::id();
        return $requestuser->requests()->where('friend_id',$my_id)->exists(); 
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    public function chats()
    {
        return $this->belongsToMany(Chat::class,'users_chats','user_id','chat_id')->withTimestamps();
    }
    
    public function teams()
    {
        return $this->belongsToMany(Team::class,'users_teams','user_id','team_id')->withTimestamps();
    }
    
    
    public function invitations()
    {
        return $this->belongsToMany(Invitation::class,'invitations_users','user_id','invitation_id')->withPivot(['accept'])->withTimestamps();
    }
    
    public function invited()//TOPのチームに招待されている数のカウント
    {
        return $this->invitations()->where('accept',0)->withTimestamps();
    }    
    
     public function signed($invitation_id)//招待を受け参加した時の判定
    {
        return $this->invitations()->where('invitation_id',$invitation_id)->where('accept',1)->exists();
    }
    
    public function not_signed($invitation_id)//招待を受け返事をしてない時の判定
    {
        return $this->invitations()->where('invitation_id',$invitation_id)->where('accept',0)->exists();
    }
    
    public function reinvite()//メンバー招待し直すチームを呼び出す/InvitationController reinvite()
    {
        //ログインユーザが関連する中間テーブルでaccept２のInvitation_idを配列で取り出す
        $invitation_ids=DB::table('invitations_users')->whereIn('invitation_id',function ($query){
            $query->select('invitation_id')->from('invitations_users')->where('user_id',\Auth::id());
        })->where('accept',2)->pluck('invitation_id');
        //invitatio_idからログインユーザがcaptainでチーム結成してないInvitationのインスタンスを呼び出す
        return Invitation::where('captain',\Auth::id())->where('team_id',null)->find($invitation_ids);
    }
    
    public function reinvite_count()//acceptが0か1のレコードを数える/
    {
        //return $this->has('invitations.inviting_users','>=',2)->count();
        return Invitation::has('inviting_users', '>=', 2)->get()->count();
        return $this->invitations()->;
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadcount('requested','friends','profile','invited',);
    }
}
