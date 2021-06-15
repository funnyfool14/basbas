<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \App\Application;
use App\Team;
use App\Team_message;

class ApplicationsController extends Controller
{
    public function apply ($team_id)
    {
        $application=Team::find($team_id)->application();
        
        if($application->not_applicant()){
            $application->users()->attach(\Auth::id());
        }
        
        $connect_id=$application->connect()->id;

         return redirect(route('application.show',[
             'id'=>$connect_id,
             ]));
        
    }
     
     
     public function show ($connect_id)
     {
         $application=Application::find( function ($application_id) use ($connect_id){
             $application_id->select('application_id')->from('users_applications')->where('id',$connect_id);
         });
         
        $team=$application->team();
         
        if($team->not_member(\Auth::id())){
            if($application->users()->where('user_id',\Auth::id())->doesntExist()){ 
            $application->users()->attach(\Auth::id());};
        };
        
        $messages=$application->messages()->where('connect_id',$connect_id);

         return view('application.show',[
             'team'=>$team,
             'application'=>$application,
             'messages'=>$messages,
             'connect_id'=>$connect_id,
             ]);
     }
     
     public function message(Request $request,$connect_id)
     {
        $request->validate([
            'message'=>'required|max:100']);
        
        $application=Application::find(function($application_id)use($connect_id){
            $application_id->select('application_id')->from('users_applications')->where('id',$connect_id);
        });
        
        $message=new Team_message;
        $message->user_id=\Auth::id();
        $message->connect_id=$connect_id;
        $message->application_id=$application->id;
        $message->message=$request->message;
        if($application->team()->is_member()){
            $message->check=1;
        }
        $message->save();

        if($application->applicant()){
            \Auth::user()->application()->updateExistingPivot($application->id,['last_message'=>$request->message]);
        } 
        return back();
    }
    
    public function  destroy($message_id)
    {
        $message=Team_message::find($message_id);
        
        $team_id=Application::find($message->application_id)->team_id;
        
        $message->delete();
        
        return back();
    }
    
    public function check($message_id)
    {
        $message=Team_message::find($message_id);
        
        $message->check=1;
        $message->save();
        
        return back();
        
    }
    
    public function recheck($message_id)
    {
        $message=Team_message::find($message_id);
        
        $message->check=0;
        $message->save();
        
        return back();
        
    }
    
    public function index($team_id)
    {
        $application=Application::where('team_id',$team_id)->first();
        $applicants=$application->users()->get();
        $team=Team::find($team_id);
        
        return view('application.index',[
            'applicants'=>$applicants,
            'team'=>$team,
            ]);
    }
    
    public function request($connect_id)
    {
        $application=Application::find(function($application_id)use($connect_id){
            $application_id->select('application_id')->from('users_applications')->where('id',$connect_id);
        });
        if(($application->apply())==0){
            \Auth::user()->application()->updateExistingPivot($application->id,['accept'=>'1']);
        }
        elseif(($application->apply())==1){
            \Auth::user()->application()->updateExistingPivot($application->id,['accept'=>'0']);
        }
        
        return back();
    }
    public function accept_check($connect_id)
    {
        $applicant=User::find(function($user_id)use($connect_id){
            $user_id->select('user_id')->from('users_applications')->where('id',$connect_id);
        });
        
        return view('application.accept_check',[
            'connect_id'=>$connect_id,
            'applicant'=>$applicant,
            ]);
    }
    public function accept($connect_id)
    {
        $user_id=User::find(function($user_id)use($connect_id){
            $user_id->select('user_id')->from('users_applications')->where('id',$connect_id);
        })->id;
        
        $application=Application::find(function($application_id)use($connect_id){
            $application_id->select('application_id')->from('users_applications')->where('id',$connect_id);
        });
        
        $team=$application->team();
        
        //checkが０のteam_messageの全てのcheckを１にする
        //$unchecked_messages=Team_message::where('connect_id',$connect_id)->where('check','0')->get();
        $unchecked_messages=Team_message::where('connect_id',$connect_id)->where('check','0')->get();
        foreach ($unchecked_messages as $unchecked_message)
            $unchecked_message -> check = 1 ;
            $unchecked_message -> save();
        
        //対象のユーザがメンバーでなければチームに加え入部申請のデータを消す
        if($team->not_member($user_id)){
        $team->users()->attach($user_id);
        $application->users()->detach($user_id);
        }
        


        return redirect(route('team.show',[
             'team'=>$team,
             ]));
    }
}
