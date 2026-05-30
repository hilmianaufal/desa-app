<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'penduduk_id',
        'nomor_surat',
        'jenis_surat',
        'keperluan',
        'status',
        'tanggal_surat',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}