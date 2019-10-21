<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlunoPagamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunomensalidade', function (Blueprint $table) {
            $table->unsignedBigInteger('idAluno');
            $table->unsignedInteger('idMensalidade');
            $table->date("data")->default(now());
            $table->decimal("valorPago",10,3);
            $table->decimal("divida", 10,3);
            $table->enum("situacao",["paga", "Naopaga"]);
            $table->primary(["idAluno", "idMensalidade"]);
            $table->foreign("idAluno")->references("idAluno")->on("Aluno");
            $table->foreign("idMensalidade")->references("idMensalidade")->on("Mensalidade");
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
        Schema::dropIfExists('alunomensalidade');
    }
}
