<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsToRawatInapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('rawat_inaps', function (Blueprint $table) {
            $table->integer('id_perawat')->unsigned()->change();
            $table->foreign('id_perawat')->references('id')->on('perawats')
                    ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('status_pengobatan_id')->unsigned()->change();
            $table->foreign('status_pengobatan_id')->references('id')->on('status_pengobatans')
                    ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rawat_inaps', function (Blueprint $table) {
            $table->dropForeign('rawat_inaps_id_perawat_foreign');
            $table->dropIndex('rawat_inaps_id_perawat_foreign');
            $table->integer('id_perawat')->change();

            $table->dropForeign('rawat_inaps_status_pengobatan_id_foreign');
            $table->dropIndex('rawat_inaps_status_pengobatan_id_foreign');
            $table->integer('status_pengobatan_id')->change();
        });
    }
}
