<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIDDOC extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('encarregado', function (Blueprint $table) {
           $table->string("tipoDocumento", 60)->after("apelido")->change();
           $table->string("nrDocumento", 20)->after("tipoDocumento")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('encarregado', function (Blueprint $table) {
            $table->dropColumn("tipoDocumento");
            $table->dropColumn("nrDocumento");
        });
    }
}
