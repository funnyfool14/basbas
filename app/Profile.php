<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'nickname','gender', 'birthplace', 'local','position','favorite_player','coment',
    ];    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
