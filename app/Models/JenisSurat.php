<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $fillable = [
    'kode',
    'nama',
    'template',
    'aktif'
];
}
