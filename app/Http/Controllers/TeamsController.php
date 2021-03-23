<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\User;
use App\Invitation;
use Illuminate\Support\Facades\DB;

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
        
        return view('teams.index',[
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
