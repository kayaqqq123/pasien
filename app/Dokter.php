<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $guarded = [];
    protected $fillable = ['nama', 'tipe_dokter_id', 'jenis_kelamin'];

    public function tipe_dokter()
    {
    return $this->belongsTo(TipeDokter::class);
    }
}
