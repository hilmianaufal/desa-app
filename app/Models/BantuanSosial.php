<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BantuanSosial extends Model
{
    protected $fillable = [
        'penduduk_id',
        'jenis_bantuan',
        'periode',
        'nominal',
        'status',
        'keterangan',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}