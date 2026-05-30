<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'alamat',
        'dusun',
        'blok',
        'rt',
        'rw',
        'status',
    ];


    public function penduduks()
    {
        return $this->hasMany(Penduduk::class);
    }
}