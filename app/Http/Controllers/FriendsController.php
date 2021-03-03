<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FriendsController extends Controller
{
    public function confirm($friend_id)
    {
        $user=User::findOrFail($friend_id);
        
        return view('friend.request',
        ['user'=>$user,]);
    }
    
    public function send($friend_id)
    {
        \Auth::user()->request($friend_id);
        
        return redirect(route('users.show',
        ['user'=>$friend_id,]));
    }
    
    public function cancel($friend_id)
    {
        //\Auth::user()->cancel($friend_id);
        $user=\Auth::user();
        $user->requests()->detach($friend_id);

        return redirect(route('users.show',[
            'user'=>$friend_id,
            ]));
    }
    
    public function asked()
    {
        $users=\Auth::user()->requested()->get();
        
        return view('friend.asked',[
            'users'=>$users,]);
    }
    
    public function index($id)
    {
        $user=User::findOrFail($id);
        //相手のfriend_idカラムに自分のidがあるfriendsデータを抜き出す
        $users=$user->friends()->where('user_id',$id)->get();

        return view('friend.index',[
            'users'=>$users,
            'id'=>$id]);        
    }
    
    public function store($friend_id)
    {
        \Auth::user()->accept($friend_id);
        
        return redirect('/');
    }
    
    public function release($friend_id)
    {
        $my_id=\Auth::id();
        $user=User::findOrFail($friend_id);
        //attachとdetachはリレーションを返すメソッドにしか使えない
        //自分のfriendから指定ユーザを削除
        \Auth::user()->friends()->detach($friend_id);
        //指定ユーザのfriendからユーザを削除
        $user->friends()->detach($my_id);
        //この記述だとリクエストの履歴が残ってしまう
        //\Auth::user()->friends()->updateExistingPivot($friend_id,['accept'=>'0']);
        
        //\Auth::user()->requests()->detach($friend_id);
        //\Auth::user()->requested()->detach($friend_id);
        
        return redirect('/');
    }
    
    public function reject($friend_id)
    {
        
        $requestuser=User::findOrFail($friend_id);
        $requesteduser_id=\Auth::id();
        
        //送った側のfridnd_idカラムから自分のidを削除してリクエストを取り消す
        $requestuser->requests()->detach($requesteduser_id);
        
        return redirect('/');
    }
    
        public function reject_confirm($friend_id)
    {
        $user=User::findOrFail($friend_id);
        
        return view('friend.reject',
        ['user'=>$user,]);
    }
    
        public function store_confirm($friend_id)
    {
        $user=User::findOrFail($friend_id);
        
        return view('friend.accept',
        ['user'=>$user,]);
    }
}
