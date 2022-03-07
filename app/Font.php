<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Font extends Model
{
    public function cartoes(){
        return $this->hasMany('App\Cartao', 'font_id');
    }
}
