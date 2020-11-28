<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FriendsController extends Controller
{
    public function request($friend_id)
    {
        $user=User::findOrFail($friend_id);
        
        return view('friend.request',
        ['user'=>$user,]);
    }
    
    public function store($friend_id)
    {
        Auth::user()->request($friend_id);
        
        return back();
    }
}
