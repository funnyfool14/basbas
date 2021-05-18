<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Introduction;
use Illuminate\Support\Facades\Storage;
use App\Team;

class IntroductionController extends Controller
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
        
        $team->name=$request->name;
        $introduction->local=$request->local;
        $introduction->coat=$request->coat;
        $introduction->gender=$request->gender;
        $introduction->generation=$request->generation;
        $introduction->level=$request->level;
        $introduction->deputy=$request->deputy;
        $introduction->coment=$request->coment;
        
        if($request->file('logo_pic')){
        $logo_pic=$request->file('logo_pic');
        $logo_path=Storage::disk('s3')->putfile('logo_album',$logo_pic,'public');
        $logo_url=Storage::disk('s3')->url($logo_path);
        $introduction->logo_pic=$logo_url;
        }
        
        if($request->file('team_pic')){    
        $team_pic=$request->file('team_pic');
        $team_path=Storage::disk('s3')->putfile('team_album',$team_pic,'public');
        $team_url=Storage::disk('s3')->url($team_path);
        $introduction->team_pic=$team_url;
        }
        
        $team->save();
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
