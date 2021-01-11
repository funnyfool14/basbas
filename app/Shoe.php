<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $fillable = [
        'brand','model','size','shoes_pic'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
