<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsToPerawatsTeble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perawats', function (Blueprint $table){
            $table->integer('dokter_id')->unsigned()->change();
            $table->foreign('dokter_id')->references('id')->on('dokters')
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
        Schema::table('perawats', function (Blueprint $table) {
            $table->dropForeign('perawats_dokter_id_foreign');
                $table->dropIndex('perawats_dokter_id_foreign');
                $table->integer('dokter_id')->change();
        });
    }
}
