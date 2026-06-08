<?php

namespace App\Models;

use App\Models\BantuanSosial;
use App\Models\KartuKeluarga;
use App\Models\MutasiPenduduk;
use App\Models\Surat;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $fillable = [
        'nik',
        'no_kk',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'umur',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'pekerjaan',
        'status_perkawinan',
        'alamat',
        'rt',
        'rw',
        'status',
        'dusun',
        'blok',
        'kartu_keluarga_id',
    ];

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class);
    }

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }


    public function mutasiPenduduks()
    {
        return $this->hasMany(MutasiPenduduk::class);
    }

        public function bantuanSosials()
    {
        return $this->hasMany(BantuanSosial::class);
    }


}
