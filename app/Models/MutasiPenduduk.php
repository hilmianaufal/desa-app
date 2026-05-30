<?php

namespace App\Models;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;

class MutasiPenduduk extends Model
{
    protected $fillable = [
        'penduduk_id',
        'jenis_mutasi',
        'tanggal_mutasi',
        'keterangan',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function exportPdf()
    {
        $mutasis = MutasiPenduduk::with('penduduk')->latest()->get();

        $pdf = Pdf::loadView('laporan.pdf.mutasi', compact('mutasis'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-mutasi.pdf');
    }
}