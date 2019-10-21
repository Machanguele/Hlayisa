<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlunoResponsavel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunoReponsavel', function (Blueprint $table) {
            $table->unsignedBigInteger('idAluno');
            $table->unsignedBigInteger("idReponsavel");
            $table->primary(["idAluno", "idReponsavel"]);
            $table->foreign("idAluno")->references("idAluno")->on("Aluno");
            $table->foreign("idReponsavel")->references("idReponsavel")->on("responsavel");
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
        Schema::dropIfExists('alunoReponsavel');
    }
}
