<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminFuncionario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminFuncionario', function (Blueprint $table) {
            $table->unsignedInteger('idAdministrador');
            $table->unsignedInteger("idFuncionario");
            $table->dateTime("data")->default(now());
            $table->primary(["idAdministrador", "idFuncionario"]);
            $table->foreign("idAdministrador")->references("idFuncionario")->on("funcionario");
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
        Schema::dropIfExists('adminFuncionario');
    }
}
