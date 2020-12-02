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
    
    public function destroy($friend_id)
    {
        \Auth::user()->cancel($friend_id);
        //$uer=User::findOrFail($friend_id);
        return back();
    }
    
    public function asked()
    {
        $users=\Auth::user()->requested()->get();
        
        return view('friend.asked',[
            'users'=>$users,]);
    }
    
    public function index()
    {
        $users=\Auth::user()->friends()->get();

        return view('friend.index',[
            'users'=>$users,]);        
    }
    
    public function store($friend_id)
    {
        \Auth::user()->accept($friend_id);
        
        return redirect('/');
    }
    
    public function release($friend_id)
    {
        \Auth::user()->friends()->detach($friend_id);
        
        return redirect('/');
    }
    
    public function reject($friend_id)
    {
        $requestuser=User::findOrFail($friend_id);
        $requesteduser_id=\Auth::id();
        
        $requestuser->requests()->detach($requesteduser_id);
        
        return redirect('/');
    }
}
