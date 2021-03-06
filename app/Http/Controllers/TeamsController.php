<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\User;
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
        $teams=$me->teams()->get();
        $invitations=$me->invitations()->get();
        
        return view('teams.index',[
            'teams'=>$teams,
            'invitations'=>$invitations,
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
        $friend1_id=$request->member1;
        $friend2_id=$request->member2;
        
        $friend1=User::findOrFail($friend1_id);
        $friend2=User::findOrFail($friend2_id);
        
        $invitation=new Invitation;
        $invitation->captain=$own_id;
        $invitation->name=$request->name;
        $invitation->save();
        
        $invitation->users()->sync([$own_id,$friend1_id,$friend2_id]);
        $invitation->sign();
        
        return view ('teams.invite',[
            'friend1'=>$friend1,
            'friend2'=>$friend2,
            ]);
    }
    
    public function invited()
    {
        $own_id=\Auth::id();
        $me=\Auth::user();
        
        $invitations=$me->invited()->get();
        
        return view('teams.invited',[
            'invitations'=>$invitations,
            ]);
    }
    
    public function accept($invitation_id)
    {
        $own_id=\Auth::id();
        $me=\Auth::user();
        
        $invitation=Invitation::findOrFail($invitation_id);
        $invitation->sign();
        
        
        $exsit=$invitation->signed($invitation_id);
        
        if($exsit){
            $team=new Team;
            $team->name=$invitation->name;
            $team->name=$invitation->name;
            $team->captain=$invitation->captain;
            $team->save();
            
            $users=$invitation->users()->pluck('user_id');
            $team->users()->sync($users);
            
        }
        
        $invitations=$me->invitations()->where('accept',0)->get();
        $teams=$me->teams()->get();
        
        return view('teams.index',[
            'teams'=>$teams,
            'invitations'=>$invitations,
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
