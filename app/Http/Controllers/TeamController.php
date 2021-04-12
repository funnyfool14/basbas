<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\User;
use App\Invitation;
use App\Introduction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
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
        
        //user_idにログインユーザのidがある中間テーブルのデータの中からaceptが0の値をもつデータを配列として変数に代入
        //ログインユーザが０か１にしててまだ０が残ってる未結成のチーム
        /*$invitation_ids=DB::table('invitations_users')->whereIn('invitation_id',function($query) use ($own_id){
            $query->select('invitation_id')->from('invitations_users')->where('user_id',$own_id)->where('accept','!=',2);
        })->where('accept',0)->pluck('invitation_id');*/
        
        //ログインユーザが断ってないintationで結成前のデータを取得
        $invitation_ids=$me->invitations()->where('accept','!=',2)->pluck('invitation_id');
        $invitations=Invitation::with('users')->where('team_id',null)->find($invitation_ids);
        //ログインユーザの所属チーム
        $teams=$me->teams()->get();
        //断ってないinvitation チーム作成数の制限のために使用
        $invited=$me->invitations()->whereIn('accept',[0,1])->get();
        //断ったinvitation ”やっぱり参加”用
        $rejections=$me->invitations()->where('accept',2)->get();
        
        return view('team.index',[
            'teams'=>$teams,
            'invitations'=>$invitations,
            'invited'=>$invited,
            'rejections'=>$rejections
            ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team=Team::find($id);
        $members=$team->members();
        $introduction=$team->introduction()->first();
        
        return view('team.show',[
            'team'=>$team,
            'members'=>$members,
            'introduction'=>$introduction,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($team_id)
    {
        $team=Team::find($team_id);
        $introduction=$team->introduction()->first();
        
        if(empty($introduction)){
            $introduction=new Introduction;
            $introduction->team_id=$team_id;
            $introduction->save();
        }

        return view('team.edit',[
            'team'=>$team,
            'introduction'=>$introduction,
            ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $team_id)
    {
        $request->validate([
            'local'=>'max:20',
            'coat'=>'max:20',
            'logo_pic'=>'image',
            'team_pic'=>'image',
            'local'=>'max:20',
            'coment'=>'max:255',
            ]);
        
        $team=Team::find($team_id);
        $introduction=Introduction::where('team_id',$team_id)->first();
        
        $introduction->local=$request->local;
        $introduction->coat=$request->coat;
        $introduction->level=$request->level;
        $introduction->deputy=$request->deputy;
        $introduction->coment=$request->coment;
        
        if($request->file('logo_pic')){
        $logo_pic=$request->file('logo_pic');
        $logo_path=Storage::disk('s3')->putfile('logo_album',$logo_pic,'public');
        $logo_url=Storage::disk('s3')->url($logo_path);
        $introduction->logo_pic=$user_url;
        }
        
        if($request->file('team_pic')){    
        $team_pic=$request->file('team_pic');
        $logo_path=Storage::disk('s3')->putfile('team_album',$team_pic,'public');
        $team_url=Storage::disk('s3')->url($team_path);
        $introduction->team_pic=$team_url;
        }
        
        $introduction->save();
        
        return redirect(route('team.show',[
            'team'=>$team
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
