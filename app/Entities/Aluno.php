<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    public $timestamps = true;
    protected $fillable = ["nome",
    "apelido", "dataNascimento",
    "genero", "nomeFoto", "tipoDocumento", "nrDocumento", "necEspecial",
    "descricao", "idEncarregado"];
    protected $table = "aluno";

    public function encarregado()
    {
        return $this->hasOne('App\Entities\Encarregado', 'idEncarregado');
    }
}
