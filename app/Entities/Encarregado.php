<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Encarregado extends Model
{
    public $timestamps = true;
    protected $fillable = ["nome", "apelido", "telefone", "email", "localFoto", "password", "genero"];
    protected $table = "encarregado";
    protected $hidden = ["password", "remember_token"];
}
