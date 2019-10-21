<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reclamacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamacao', function (Blueprint $table) {
            $table->bigIncrements('idReclamacao');
            $table->string('tipo', 60)->nullable();
            $table->text("descricao");
            $table->enum("estado", ["0", "1"]);
            $table->dateTime('dataReclamacao')->default(now());
            $table->dateTime('dataResolucao')->nullable(true);
            $table->unsignedBigInteger("idEncarregado");
            $table->unsignedInteger("idFuncionario")->nullable(true);
            $table->foreign("idEncarregado")->references("idEncarregado")->on("encarregado");
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
        Schema::dropIfExists('reclamacao');
    }
}
