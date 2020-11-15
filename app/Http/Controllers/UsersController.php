<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $data=[];
        if(\Auth::check()){
            $user=\Auth::user();
            $name=$user->name;
            $manyShoes=$user->shoes()->orderby('id','desc')->paginate(1);
        
            $data=['user'=>$user,'name'=>$name,'manyShoes'=>$manyShoes,];}
            
        return view('welcome',$data);
    }
    
    public function edit($id)
    {
        $data=[];
        if(\Auth::check()){
            $user=\Auth::user();
            $name=$user->name;
            $manyShoes=$user->shoes()->orderby('id','desc')->get();
        
            $data=['user'=>$user,'name'=>$name,'manyShoes'=>$manyShoes,];}
            
        return view('users.edit',$data);
    }
    
    public function update(Request $request,$id)
    {
        $user=User::findOrFail($id);
        
        $request->validate([
            'name'=>'required']);
            
        if(\Auth::id()==$user->id){
            $user->name=$request->name;
            
            $user->save();
        }
        return redirect('/');
    }
}