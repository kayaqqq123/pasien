<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = ['nama', 'alamat', 'telepon', 'jenis_kelamin', 'foto'];
}
