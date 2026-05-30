<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'nama_desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'alamat',
        'kode_pos',
        'telepon',
        'email',
        'website',
        'nama_kepala_desa',
        'nip_kepala_desa',
        'logo_desa',
        'ttd_kepala_desa',
    ];
}