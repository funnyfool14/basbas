<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Application;
use App\Team;
use App\Team_message;

class ApplicationsController extends Controller
{
     
     public function join ($team_id)
     {
        $team=Team::find($team_id);

        if($team->application()){
            $application=$team->application()->first();
            }
            
        else{
            $application=new Application;
            $application->team_id=$team_id;
            $application->save();
            $application->users()->attach(\Auth::id());
        } 
            
            $messages=$application->messages();

         return view('application.join',[
             'team'=>$team,
             'application'=>$application,
             'messages'=>$messages,
             ]);
     }
     
     public function message(Request $request,$team_id)
     {
        $team=Team::find($team_id);
        $application=Application::where('team_id',$team_id)->first();
        
        $message=new Team_message;
        $message->user_id=\Auth::id();
        $message->application_id=$application->id;
        $message->message=$request->message;
        $message->save();
        
        $messages=$application->messages();
        
        return redirect (route('application.join',[
             'team'=>$team,
             'application'=>$application,
             'messages'=>$messages,
             'id'=>$team_id,
            ]));
    }
    
    public function  destroy($message_id)
    {
        //dd($message_id);
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
        $team=Team::find($team_id);
        $application=$team->application()->first();
        
        $applicants=$application->users()->get();
        
        return view('application.index',[
            'application'=>$application,
            'applicants'=>$applicants,
            ]);
    }
}
