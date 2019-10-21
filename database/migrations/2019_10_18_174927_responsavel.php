<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Responsavel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsavel', function (Blueprint $table) {
            $table->bigIncrements('idReponsavel');
            $table->string("nome", 60);
            $table->string("apelido", 60);
            $table->enum('genero', ['M', 'F']);
            $table->string("nomeFoto", 255)->nullable(true);
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
        SchenaSchema::dropIfExists('responsavel');
    }
}
