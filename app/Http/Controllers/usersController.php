<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class usersController extends Controller
{
    public function index()
    {
        if(\Auth::check()){
            $user=\Auth::user();}
    return view('welcome',['user'=>$user,]);
    }

}