<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Introduction extends Model
{
    public function deputy_user()//
    {
        return $deputy=User::find($this->deputy);
    }
}
