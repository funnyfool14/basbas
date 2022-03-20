<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hoop;
use Request as HoopRequest;

class HoopsController extends Controller
{

    public function index(Request $request)
    {
        // use Request as HoopRequest;を使って取得可能に
        $search = HoopRequest::get('s');
        $query = Hoop::query();
        // 検索するテキストが入力されている場合のみ
        if(!empty($search)) {
            $query->where('adress', 'like', '%'.$search.'%');
        }
        $hoops = $query->paginate(10);
        return view('hoops.index',[
        'hoops'=>$hoops, 'search'=>$search]);
    }

   
   //$query->where(['pref','city','area','phone','detail1','detail2','detail3'], 'like', '%'.$search.'%');
/*
    public function index()
    {
        $hoops=Hoop::all();
        return view ('hoops.index',
        ['hoops'=>$hoops]);
    }
*/
    public function create()
    {
        $hoop=new Hoop;
        
        return view ('hoops.create',
        ['hoop'=>$hoop,]);
    }

     public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:30',
            'adress'=>'required|max:100',
            'detail'=>'max:255',
            ]);
        Hoop::create([
            'name' => $request->name,
            'adress' => $request->adress,
            'detail1' => $request->detail,
            ]);
        
        return redirect()->route('hoops.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hoop = Hoop::find($id);

        return view ('hoops.show',[
            'hoop' => $hoop,
        ]);
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
