<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlunoDisciplina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunodisciplina', function (Blueprint $table) {
            $table->unsignedBigInteger('idAluno');
            $table->unsignedInteger('idDisciplina');
            $table->primary(["idALuno", "idDisciplina"]);
            $table->string("classificacao", 60);
            $table->foreign("idAluno")->references("idAluno")->on("aluno");
            $table->foreign("idDisciplina")->references("idDisciplina")->on("disciplina");
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
        Schema::dropIfExists('alunodisciplina');
    }
}
