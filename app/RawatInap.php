<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawatInap extends Model
{
    protected $guarded = [];
    protected $fillable = ['no_kamar', 'id_perawat'];

    public function perawat()
    {
    return $this->belongsTo(Perawat::class,'id_perawat');
    }
}
