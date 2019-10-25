<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableReclamacaoAddDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reclamacao', function (Blueprint $table) {
            $table->addColumn("enum(['0', '1'])",'estado')->default('0');
            $table->timestamps('dataReclamacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reclamacao', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
}
