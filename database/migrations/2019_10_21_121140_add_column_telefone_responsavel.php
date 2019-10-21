<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTelefoneResponsavel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responsavel', function (Blueprint $table) {
            $table->renameColumn("idReponsavel", "idResponsavel");
            DB::statement('alter table responsavel add column telefone varchar(15);');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responsavel', function (Blueprint $table) {
            $table->dropColumn('telefone');
        });
    }
}
