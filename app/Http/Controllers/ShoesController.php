<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Shoe;
use App\Picture;

class ShoesController extends Controller
{
    public function create()
    {
        $shoes=new Shoe;
        //$picture=new Picture;
        
        return view('shoes.create',[
            'shoes'=>$shoes,
            /*'picture'=>$picture*/
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'brand'=>'required|max:20',
            'model'=>'required|max:30',
            'shoes_pic'=>'image'
            ]);
            
        /*if(!is_null($request->shoes_pic)){
            $shoes_pic=$request->file('shoes_pic');
            $shoes_path=Storage::disk('s3')->putfile('shoes_album',$shoes_pic,'public');
            $shoes_url=Storage::disk('s3')->url($shoes_path);*/
        if($request->shoes_pic){
            $shoes_pic = $request->file('shoes_pic');
            $path = $shoes_pic->store('storage','public');
        
            $request->user()->shoes()->create([
            'brand'=>$request->brand,
            'model'=>$request->model,
            'size'=>$request->size,
            //'shoes_pic'=>$shoes_url,
            'shoes_pic'=>$path,
        ]);
        }
        
        else{$request->user()->shoes()->create([
            'brand'=>$request->brand,
            'model'=>$request->model,
            'size'=>$request->size,
            ]);
        }
        return redirect('/');
    }
    
    public function edit($id)
    {
        if(\Auth::check()){
            $shoes=Shoe::findOrFail($id);
        }
            
        return view('shoes.edit',
        ['shoes'=>$shoes]);
    }    
    
    public function update(Request $request,$id)
    {
        $shoes=Shoe::findOrFail($id);
        $user=\Auth::user();
            
        $request->validate([
            'brand'=>'required|max:20',
            'model'=>'required|max:30',
            'shoes_pic'=>'image'
            ]);
            
        if(\Auth::id()==$user->id){
            /*if(!is_null($request->shoes_pic)){
                $shoes_pic=$request->file('shoes_pic');
                $shoes_path=Storage::disk('s3')->putfile('shoes_album',$shoes_pic,'public');
                $shoes_url=Storage::disk('s3')->url($shoes_path);
                $shoes->shoes_pic=$shoes_url;
            }*/

            if($request->shoes_pic){
                $shoes_pic = $request->file('shoes_pic');
                $path = $shoes->pic->store('storage','public');
                $shoes->shoes_pic = $path;
            }
               
            $shoes->brand=$request->brand;
            $shoes->model=$request->model;
            $shoes->size=$request->size;
            
            $shoes->save();
        }
        return redirect('/');
    }

    public function destroy($id)
    {
        $shoes=\App\Shoe::findOrFail($id);
        if(\Auth::id()==$shoes->user_id){
            $shoes->delete();
        }
        
        return back();
    }
}
