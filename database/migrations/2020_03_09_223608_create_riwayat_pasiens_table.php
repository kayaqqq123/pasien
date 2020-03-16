<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pasiens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pasien_id')->unsigned()->index();
            $table->integer('dokter_id')->unsigned()->index();
            $table->integer('status_pengobatan_id')->unsigned()->index();
            $table->string('diagnosa_penyakit');
            $table->integer('rawat_inap_id')->nullable()->unsigned()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pasiens');
    }
}
