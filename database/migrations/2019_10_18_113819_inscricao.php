<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inscricao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscricao', function (Blueprint $table) {
            $table->bigIncrements('idInscricao');
            $table->enum("estado", ["Pendente", "Inscrito"]);
            $table->unsignedInteger("idFuncionario");
            $table->foreign("idFuncionario")->references("idFuncionario")->on("funcionario");
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
        Schema::dropIfExists('inscricao');
    }
}
