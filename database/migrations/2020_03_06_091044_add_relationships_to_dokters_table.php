<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsToDoktersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokters', function (Blueprint $table) {
                $table->integer('tipe_dokter_id')->unsigned()->change();
                $table->foreign('tipe_dokter_id')->references('id')->on('tipe_dokters')
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
        Schema::table('dokters', function (Blueprint $table) {
                $table->dropForeign('dokters_tipe_dokter_id_foreign');
                $table->dropIndex('dokters_tipe_dokter_id_foreign');
                $table->integer('tipe_dokter_id')->change();
            });
    }
}
