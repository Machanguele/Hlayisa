<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProfessorDisciplina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professordisciplina', function (Blueprint $table) {
            $table->unsignedInteger('idFuncionario');
            $table->unsignedInteger('idDisciplina');
            $table->primary(["idFuncionario", "idDisciplina"]);
            $table->foreign("idFuncionario")->references("idFuncionario")->on("funcionario");
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
        Schema::dropIfExists('professordisciplina');
    }
}
