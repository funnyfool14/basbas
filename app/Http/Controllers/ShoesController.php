<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            ]);
        $request->user()->shoes()->create([
            'brand'=>$request->brand,
            'model'=>$request->model,
            'size'=>$request->size,
            ]);
        
        return redirect('/');
    }
    
    public function edit($id)
    {
        if(\Auth::check()){
            $shoes=Shoe::findOrFail($id);
            $brand=$shoes->brand;
            $model=$shoes->model;
            $size=$shoes->size;
        }
            
        return view('shoes.edit',
        ['shoes'=>$shoes,'brand'=>$brand,'model'=>$model,'size'=>$size]);
    }    
    
    public function update(Request $request,$id)
    {
        $shoes=Shoe::findOrFail($id);
        $user=\Auth::user();
            
        $request->validate([
            'brand'=>'required|max:20',
            'model'=>'required|max:30',]);
            
        if(\Auth::id()==$user->id){
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
