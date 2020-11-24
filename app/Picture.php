<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable =[
        'pic','content'];
        
    public function user()
    {
        return $this->belongsTo(User::class);
    }
        
    public function take_nice()
    {
        return $this->belongsToMany(User::class,'nice','pic_id','uer_id')->withTimeStamps();
    }     
    
    public function loadRelationshipCounts()
    {
        $this->loadcounts('take_nice');
    }
    
    //public function favorite_users()
    //{
        //return $this->belongsToMany(User::class,'favorite','','')->withTimestamps();
    //}
    
}
