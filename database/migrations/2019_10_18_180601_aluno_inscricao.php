<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlunoInscricao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunoinscricao', function (Blueprint $table) {
            $table->unsignedBigInteger('idAluno');
            $table->unsignedBigInteger('idInscricao');
            $table->date("data")->default(now());
            $table->primary(["idAluno", "idInscricao"]);
            $table->foreign("idAluno")->references("idAluno")->on("aluno");
            $table->foreign("idInscricao")->references("idInscricao")->on("inscricao");
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
        Schema::dropIfExists('alunoinscricao');
    }
}
