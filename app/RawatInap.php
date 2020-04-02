<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawatInap extends Model
{
    protected $guarded = [];
    protected $fillable = ['id','kamar', 'id_perawat', 'status_pengobatan_id'];

    public function perawat()
    {
    return $this->belongsTo(Perawat::class,'id_perawat');
    }

    public function status_pengobatan()
    {
    return $this->belongsTo(StatusPengobatan::class);
    }
}
