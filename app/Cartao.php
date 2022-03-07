<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{

    protected $fillable = [
        'texto',
        'eixo_X',
        'eixo_Y',
        'tamanho',

        'image_id',
        'font_id',
    ];


    public function imagem(){
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }
    public function fonte(){
        return $this->belongsTo(Font::class, 'font_id', 'id');
    }
}
