<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Funcionario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario', function (Blueprint $table) {
            $table->increments('idFuncionario')->autoIncrement();
            $table->string("nome", 60);
            $table->string("apelido", 60);
            $table->enum("genero", ["M", "F"]);
            $table->string("nomeFoto", 255)->nullable($value=false);
            $table->string("cargo", 60);
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
        Schema::dropIfExists('funcionario');
    }
}
