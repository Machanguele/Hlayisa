<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Aluno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno', function (Blueprint $table) {
            $table->bigIncrements('idAluno');
            $table->string("nome", 60);
            $table->string("apelido", 60);
            $table->date("dataNascimento");
            $table->enum('genero', ['M', 'F']);
            $table->string("nomeFoto")->nullable($value=true);
            $table->enum('necEspecial', ['sim', 'nao'])->default("nao");
            $table->string("descricao")->nullable($value=true);
            $table->unsignedBigInteger("idEncarregado");
            $table->foreign("idEncarregado")->references("idEncarregado")->on("encarregado");
            $table->unsignedInteger("idTurma");
            $table->foreign("idTurma")->references("idTurma")->on("turma");
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aluno');
    }
}
