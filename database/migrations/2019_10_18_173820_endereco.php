<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Endereco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco', function (Blueprint $table) {
            $table->bigIncrements('idEndereco');
            $table->unsignedBigInteger('idAluno');
            $table->string("bairro",60)->nullable($value=true);
            $table->string("avenida", 60)->nullable($value=true);
            $table->integer('numeroCasa')->unsigned()->nullable($value=true);
            $table->foreign("idAluno")->references("idAluno")->on("Aluno");
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
        Schema::dropIfExists('endereco');
    }
}
