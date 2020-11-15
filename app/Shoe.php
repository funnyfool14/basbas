<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $fillable = [
        'brand','model','size'];
    
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
