<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Encarregado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encarregado', function (Blueprint $table) {
            $table->bigInteger('idEncarregado')->autoIncrement()->unsigned();
            $table->string('nome', 60)->nullable($value=false);
            $table->string("apelido", 60)->nullable($value=false);
            $table->string("telefone", 15)->nullable($value=false)->unique();
            $table->string('email', 100)->nullable($value=true)->unique();
            $table->string("nomeFoto", 255)->nullable($value=true);
            $table->string("localFoto", 255)->nullable($value=true);
            $table->string("password", 40);
            $table->enum('genero', ['M', 'F']);
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
        Schema::dropIfExists('Encarregado');
    }
}
