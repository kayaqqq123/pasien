<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['id', 'nama'];

    public function user() {
        return $this->hasMany(User::class, 'id_roles');
    }
}
