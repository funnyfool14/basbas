<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Invitation;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $me=\Auth::user();
        $own_id=\Auth::id();
        
        //ログインユーザに関連するusers_teamsのデータを取得
        $user_team=$me->teams()->where('user_id',$own_id)->get();
    
        $team_ids=$user_team->pluck('team_id');
        $teams=Team::findOrFail($team_ids);
        
        return view('teams.index',[
            'teams'=>$teams,
            ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\
     */
    public function create()
    {
        $me=\Auth::user();
        $own_id=\Auth::id();
        
        $friends=$me->friends()->where('user_id',$own_id)->get();
        //dd($friends);
        
        return view('teams.create',[
            'friends'=>$friends
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invite(Request $request)
    {
        $request->validate([
            'name'=>'required|max:30',
            'member1'=>'required|different:member2',
            'member2'=>'required',
            ]);
        
        $own_id=\Auth::id();
        $member1=$request->member1;
        $member2=$request->member2;
        
        $invitation=new Invitation;
        $invitation->captain=$own_id;
        $invitation->name=$request->name;
        $invitation->save();
        
        $invitation->users()->sync([$member1,$member2]);
        $invitation->sign();
        
        return view ('teams.invite',[
            'member1'=>$member1,
            'member2'=>$member2
            ]);
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
        //
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
