<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    public $timestamps = true;
    protected $fillable = ["nome", "apelido", "telefone", "email", "localFoto", "password", "genero"];
    protected $table = "aluno";
}
