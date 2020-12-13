<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Picture;
use App\Message;
use App\Profile;

class UsersController extends Controller
{
    public function index()
    {
        $data=[];
        $allPictures=Picture::orderby('id','desc')->get();
        if(\Auth::check()){ 
            $user=\Auth::user();
            $manyShoes=$user->shoes()->orderby('id','desc')->paginate(1);
            $pictures=$user->pictures()->orderby('created_at','desc')->get();
            foreach($pictures as $picture)
            $picture->loadRelationshipCounts();
            $user->loadRelationshipCounts();
            
            $data=['user'=>$user,'manyShoes'=>$manyShoes,'pictures'=>$pictures,'allPictures'=>$allPictures,];
        
        return view('welcome',$data);}
            
        else{
            $data=['allPictures'=>$allPictures,];
            foreach($allPictures as $picture)
            $picture->loadRelationshipCounts();
            
            
        return view('welcome',$data);
        }
    }
    
    public function edit($id)
    {
        $data=[];
        if(\Auth::check()){
            $user=\Auth::user();
            $id=\Auth::id();
            $name=$user->firstName;
            $manyShoes=$user->shoes()->orderby('id','desc')->get();
            $pictures=$user->pictures()->orderby('created_at','desc')->get();
            $profile=$user->profile()->orderby('created_at','desc')->first();
            //$profile=Profile::findOrFail($id)->orderby('id','desc')->first();

            
        
            $data=['user'=>$user,'name'=>$name,'manyShoes'=>$manyShoes,'pictures'=>$pictures,'profile'=>$profile];}
        return view('users.edit',$data);
    }
    
    public function update(Request $request,$id)
    {
        $user=User::findOrFail($id);
        
        $request->validate([
            'firstName'=>'required',
            'lastName'=>'required'
            ]);
            
        if(\Auth::id()==$user->id){
            $user->firstName=$request->firstName;
            $user->lastName=$request->lastName;
            
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
            $manyShoes=$user->shoes()->orderby('id','desc')->paginate(1);
            $pictures=$user->pictures()->orderby('created_at','desc')->get();
            //$profile=$user->profile()->orderby('created_at','desc')->first();
            $profile=Profile::findOrFail($id)->orderby('id','desc')->first();
            //$profile=Profile::orderby('id','desc')->where('user_id',$id)->first();
            //foreach($pictures as $picture)
            //$picture->loadRelationshipCounts();
            /*$messages=$user->messages()->orderby('created_at','desc')->get();
            foreach($messages as $message);*/
            
            $data=['user'=>$user,'manyShoes'=>$manyShoes,'pictures'=>$pictures,
            'allPictures'=>$allPictures,'profile'=>$profile,/*'picture'=>$picture,/*'message'=>$message,*/];
        
        return view('users.show',$data);
        }
        
    }
}