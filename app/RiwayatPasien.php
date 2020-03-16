<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatPasien extends Model
{
    protected $guarded = [];
    protected $fillable = ['pasien_id', 'dokter_id', 'status_pengobatan_id', 'diagnosa_penyakit', 'rawat_inap_id'];

    public function pasien()
    {
    return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function dokter()
    {
    return $this->belongsTo(Dokter::class);
    }

    public function statuspengobatan()
    {
    return $this->belongsTo(StatusPengobatan::class, 'status_pengobatan_id');
    }

    public function rawatinap()
    {
    return $this->belongsTo(RawatInap::class, 'rawat_inap_id');
    }

}
