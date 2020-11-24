<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NiceController extends Controller
{
    public function like($picId)
    {
        \Auth::user()->like($picId);
        return back();
        
    }
    
    public function not_so($picId)
    {
        \Auth::user()->not_so($picId);
        return back();
    }
}
