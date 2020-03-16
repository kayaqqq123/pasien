<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    protected $guarded = [];
    protected $fillable = ['nama', 'dokter_id', 'jenis_kelamin'];

    public function dokter()
    {
    return $this->belongsTo(Dokter::class);
    }
}
