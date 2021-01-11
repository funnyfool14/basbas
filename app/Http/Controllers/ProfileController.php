<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Profile;
use App\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=\Auth::id();
        
        $request->validate([
            'nickname'=>'max:20',
            'gender'=>'max:20',
            'birthplace'=>'max:20',
            'local'=>'max:20',
            'position'=>'max:20',
            'favorite_player'=>'max:20',
            'coment'=>'max:255',
            'user_pic'=>'image',
            ]);
            
        if(!is_null($request->user_pic)){
            $user_pic=$request->file('user_pic');
            $user_path=Storage::disk('s3')->putfile('user_album',$user_pic,'public');
            $user_url=Storage::disk('s3')->url($user_path);
            $request->user()->profile()->create([
            'user_pic'=>$user_url
            ]);
        }    
                
            $request->user()->profile()->create([
            'nickname'=>$request->nickname,
            'gender'=>$request->gender,
            'birthplace'=>$request->birthplace,
            'local'=>$request->local,
            'position'=>$request->position,
            'favorite_player'=>$request->favorite_player,
            'coment'=>$request->coment,
            ]);
        
        return redirect(route('users.show',[
            'user'=>$id,
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $profile_id)
    {
        $request->validate([
            'nickname'=>'max:20',
            'gender'=>'max:20',
            'birthplace'=>'max:20',
            'local'=>'max:20',
            'position'=>'max:20',
            'favorite_player'=>'max:20',
            'coment'=>'max:255',
            'user_pic'=>'image'
            ]);
        
        $profile=Profile::findOrFail($profile_id);
        $id=$profile->user_id;

        if(\Auth::id()==$id){
        
            if(!is_null($request->user_pic)){    
                $user_pic=$request->file('user_pic');
                $user_path=Storage::disk('s3')->putfile('user_album',$user_pic,'public');
                $user_url=Storage::disk('s3')->url($user_path);
                $profile->user_pic=$user_url;
                }
            $profile->nickname=$request->nickname;
            $profile->gender=$request->gender;
            $profile->birthplace=$request->birthplace;
            $profile->local=$request->local;
            $profile->position=$request->position;
            $profile->favorite_player=$request->favorite_player;
            $profile->coment=$request->coment;
            
            $profile->save();
        }
        
        return redirect(route('users.show',[
            'user'=>$id,
            ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
