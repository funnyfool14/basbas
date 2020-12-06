<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //
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
    public function update(Request $request, $id)
    {
        $profile=new Profile;
        
        $request->validate([
            'nickname'=>'max:20',
            'gender'=>'max:20',
            'birthplace'=>'max:20',
            'local'=>'max:20',
            'position'=>'max:20',
            'favorite_player'=>'max:20'
            ]);
        if(\Auth::id()==$user->id){    
            $profile->nickname=$request->nickname;
            $profile->gender=$request->gender;
            $profile->birthplace=$request->birthplace;
            $profile->local=$request->local;
            $profile->position=$request->position;
            $profile->favorite_player=$request->favorite_player;
        
            $profile->save();
        }
        
        return redirect(route('users.show',[
            'id'=>$id,
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
