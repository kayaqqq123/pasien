<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsToRiwayatPasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riwayat_pasiens', function (Blueprint $table) {
            $table->foreign('pasien_id')->references('id')->on('pasiens')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('dokter_id')->references('id')->on('dokters')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status_pengobatan_id')->references('id')->on('status_pengobatans')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('rawat_inap_id')->references('id')->on('rawat_inaps')
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
        Schema::table('riwayat_pasiens', function (Blueprint $table) {
            //
        });
    }
}
