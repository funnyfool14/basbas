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
        $uer=User::findOrFail($friend_id);
        return back();
    }
}
