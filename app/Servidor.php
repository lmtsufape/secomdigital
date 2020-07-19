<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
  protected $fillable = ['siape', 'nome', 'email', 'data_nascimento'];
}
