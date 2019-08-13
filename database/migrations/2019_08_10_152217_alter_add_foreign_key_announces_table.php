<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddForeignKeyAnnouncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announces', function (Blueprint $table) {
            $table->unsignedBigInteger('ventas_id');
            $table->foreign('ventas_id')->references('id')->on('ventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announces', function($table) {
            $table->dropForeign('ventas_id');
            $table->dropColumn('ventas_id');
        });
    }
}
