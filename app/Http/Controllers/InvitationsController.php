<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Invitation;
use App\Team;
use Illuminate\Support\Facades\DB;

class InvitationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $own_id=\Auth::id();
        $me=\Auth::user();
        
        $invitations=$me->invited()->get();
        
        return view('invitations.index',[
            'invitations'=>$invitations,
            ]);
    }   
    
    
    public function create()
    {
        $me=\Auth::user();
        $own_id=\Auth::id();
        
        $friends=$me->friends()->where('user_id',$own_id)->get();
        
        return view('invitations.create',[
            'friends'=>$friends
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        
        return view ('invitations.invite',[
            'friend1'=>$friend1,
            'friend2'=>$friend2,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($invitation_id)
    {
        $invitation=Invitation::find($invitation_id);

        return view('invitations.reject',[
            'invitation'=>$invitation,
            'invitation_id'=>$invitation_id
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($invitation_id)
    {
        
        $invitation=Invitation::findOrFail($invitation_id);
        $invitation->sign();
        
        $dosent_exist=$invitation->signed();
        
        if($invitation->signed()==3){
            
            //招待を断ったユーザ
            $reject=$invitation->users()->where('accept',2)->pluck('user_id');
            $invitation->users()->detach($reject);
            
            $team=new Team;
            $team->name=$invitation->name;
            $team->invitation_id=$invitation_id;
            $team->captain=$invitation->captain;
            $team->save();

            $invitation->team_id=$team->id;
            $invitation->save();
            $users=$invitation->users()->where('accept',1)->pluck('user_id');
            $team->users()->sync($users);
        }
        
        /*$invitation_ids=DB::table('invitations_users')->whereIn('invitation_id',function($query) use ($own_id){
            $query->select('invitation_id')->from('invitations_users')->where('user_id',$own_id);
        })->where('accept',0)->pluck('invitation_id');*/
        
        return redirect(route('teams.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request,$invitation_id)
    {
        $invitation=Invitation::find($invitation_id);
        
        if($request->member2){
            $request->validate([
                'member1'=>'required|different:member2',
                'member2'=>'required',
                ]);
        $friend1_id=$request->member1;
        $friend2_id=$request->member2;
        
        $friend1=User::findOrFail($friend1_id);
        $friend2=User::findOrFail($friend2_id);
            
        $invitation->users()->attach($friend1_id);
        $invitation->users()->attach($friend2_id);
        
         return view ('invitations.invite',[
            'friend1'=>$friend1,
            'friend2'=>$friend2,
            ]);
        }
        else{
            $request->validate([
                'member1'=>'required',
                ]);
                
        $friend1_id=$request->member1;
        $friend1=User::findOrFail($friend1_id);
        $invitation->users()->attach($friend1_id);
        
         return view ('invitations.invite',[
            'friend1'=>$friend1,
            ]);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($invitation_id)
    {
        $own_id=\Auth::id();
        $invitation=Invitation::find($invitation_id);
        $invitation->not_sign($own_id);
        
        return redirect(route('teams.index'));
    }
    
     public function quit($invitation_id)
     {
        $invitation=Invitation::find($invitation_id);
        $invitation->delete();
        
        return redirect(route('teams.index'));         
     }
     
     public function reinvite($own_id)
     {
        //チーム結成前
        $invitation_ids=\Auth::user()->reinvite()->pluck('id');
        $invitations=Invitation::with('users.friends')->find($invitation_ids);
        
        return view('invitations.reinvite',[
            'invitations'=>$invitations,
            ]);
     }
}
