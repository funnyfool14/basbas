<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
        public function messages()
    {
        $this->hasMany(Message::class);
    }
}