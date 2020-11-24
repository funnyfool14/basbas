<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Picture;

class UsersController extends Controller
{
    public function index()
    {
        $data=[];
        $allPictures=Picture::orderby('id','desc')->get();
        
        if(\Auth::check()){ 
            $user=\Auth::user();
            $name=$user->name;
            $manyShoes=$user->shoes()->orderby('id','desc')->paginate(1);
            $pictures=$user->pictures()->orderby('created_at','desc')->get();
            
            $data=['user'=>$user,'name'=>$name,'manyShoes'=>$manyShoes,'pictures'=>$pictures,'allPictures'=>$allPictures,];
        
        return view('welcome',$data);}
            
        else{
            $data=['allPictures'=>$allPictures,];
            
        return view('welcome',$data);
        }
    }
    
    public function edit($id)
    {
        $data=[];
        if(\Auth::check()){
            $user=\Auth::user();
            $name=$user->name;
            $manyShoes=$user->shoes()->orderby('id','desc')->get();
            $pictures=$user->pictures()->orderby('created_at','desc')->get();
        
            $data=['user'=>$user,'name'=>$name,'manyShoes'=>$manyShoes,'pictures'=>$pictures,];}
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
    
    public function show($id)
    {
        $data=[];
        $allPictures=Picture::orderby('id','desc')->get();
        
        if(\Auth::check()){ 
            $user=User::findOrFail($id);
            $name=$user->name;
            $manyShoes=$user->shoes()->orderby('id','desc')->paginate(1);
            $pictures=$user->pictures()->orderby('created_at','desc')->get();
            
            $data=['user'=>$user,'name'=>$name,'manyShoes'=>$manyShoes,'pictures'=>$pictures,'allPictures'=>$allPictures,];
        
        return view('users.show',$data);
        }
    }
}