<?php

namespace App\Http\Controllers;

use App\Models\BantuanSosial;
use App\Models\Penduduk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BantuanSosialController extends Controller
{
    public function index()
    {
        $bantuans = BantuanSosial::with('penduduk')->latest()->get();

        return view('bantuan-sosial.index', compact('bantuans'));
    }

    public function create()
    {
        $penduduks = Penduduk::latest()->get();

        return view('bantuan-sosial.create', compact('penduduks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_bantuan' => 'required|string|max:255',
            'periode' => 'nullable|string|max:255',
            'nominal' => 'nullable|numeric',
            'status' => 'required|in:Diajukan,Diverifikasi,Diterima,Ditolak',
            'keterangan' => 'nullable|string',
        ]);

        BantuanSosial::create($request->all());

        return redirect()->route('bantuan-sosial.index')
            ->with('success', 'Data bantuan sosial berhasil ditambahkan.');
    }

    public function show(BantuanSosial $bantuanSosial)
    {
        $bantuanSosial->load('penduduk');

        return view('bantuan-sosial.show', compact('bantuanSosial'));
    }

    public function edit(BantuanSosial $bantuanSosial)
    {
        $penduduks = Penduduk::latest()->get();

        return view('bantuan-sosial.edit', compact('bantuanSosial', 'penduduks'));
    }

    public function update(Request $request, BantuanSosial $bantuanSosial)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_bantuan' => 'required|string|max:255',
            'periode' => 'nullable|string|max:255',
            'nominal' => 'nullable|numeric',
            'status' => 'required|in:Diajukan,Diverifikasi,Diterima,Ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $bantuanSosial->update($request->all());

        return redirect()->route('bantuan-sosial.show', $bantuanSosial)
            ->with('success', 'Data bantuan sosial berhasil diperbarui.');
    }

    public function destroy(BantuanSosial $bantuanSosial)
    {
        $bantuanSosial->delete();

        return redirect()->route('bantuan-sosial.index')
            ->with('success', 'Data bantuan sosial berhasil dihapus.');
    }

    public function exportCsv()
{
    $filename = 'laporan-bantuan-sosial.csv';

    $bantuans = BantuanSosial::with('penduduk')->latest()->get();

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function () use ($bantuans) {
        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'Nama',
            'NIK',
            'Jenis Bantuan',
            'Periode',
            'Nominal',
            'Status',
            'Keterangan',
        ]);

        foreach ($bantuans as $bantuan) {
            fputcsv($file, [
                $bantuan->penduduk?->nama,
                $bantuan->penduduk?->nik,
                $bantuan->jenis_bantuan,
                $bantuan->periode,
                $bantuan->nominal,
                $bantuan->status,
                $bantuan->keterangan,
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

    public function exportPdf()
    {
        $bantuans = BantuanSosial::with('penduduk')->latest()->get();

        $pdf = Pdf::loadView('laporan.pdf.bansos', compact('bantuans'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-bantuan-sosial.pdf');
    }
}