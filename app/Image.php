<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Image extends Model
{
    public function cartao(){
        return $this->hasOne('App\Cartao', 'image_id');
    }

    public function getSrcAttribute(){

    	return Storage::url($this->file);
    }
}
