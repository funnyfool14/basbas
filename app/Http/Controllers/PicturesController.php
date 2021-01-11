<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Picture;

class PicturesController extends Controller
{
    public function create()
    {
        $picture=new Picture;
        
        return view('pictures.create',
        ['picture'=>$picture,]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'pic'=>'required|image',
            'content'=>'max:255']);
        /**
         * 自動生成されたファイル名が付与されてS3に保存される。
         * 第三引数に'public'を付与しないと外部からアクセスできないので注意。
         */
        $picture=$request->file('pic');
        $path = Storage::disk('s3')->putFile('album', $picture, 'public');
        /* ファイルパスから参照するURLを生成する */
        $url = Storage::disk('s3')->url($path);
        
        $request->user()->pictures()->create([
            'pic'=>$url,
            'content'=>$request->content,
            ]);
        
        return redirect('/',);
    }
    
    public function index()
    {
        //全部表示するページも作る
        $allPictures=Picture::orderby('id','desc')->get();
        /*foreach($allPictures as $picture)
        $picture->loadRelationshipCounts();*/
        return view('pictures.index',[
            'allPictures'=>$allPictures,
            //'picture'=>$picture,
        ]);
    }
    
    public function destroy ($id){
        $picture=\App\Picture::findOrFail($id);
        if(\Auth::id()==$picture->user_id){
            $picture->delete();
        }
        
        return back();
    }
    
    public function show(){
        
    }
}
