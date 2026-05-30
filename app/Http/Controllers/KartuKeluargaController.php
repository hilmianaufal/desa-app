<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KartuKeluargaController extends Controller
{
    public function index()
    {
        $kartuKeluargas = KartuKeluarga::latest()->get();

        return view('kartu-keluarga.index', compact('kartuKeluargas'));
    }

    public function create()
    {
        return view('kartu-keluarga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|digits:16|unique:kartu_keluargas,no_kk',
            'kepala_keluarga' => 'required|string|max:255',
        ]);

        KartuKeluarga::create($request->all());

        return redirect()->route('kartu-keluarga.index')->with('success', 'Data Kartu Keluarga berhasil ditambahkan.');
    }

    public function show(KartuKeluarga $kartuKeluarga)
    {
        $kartuKeluarga->load('penduduks');

        return view('kartu-keluarga.show', compact('kartuKeluarga'));
    }

    public function edit(KartuKeluarga $kartuKeluarga)
    {
        return view('kartu-keluarga.edit', compact('kartuKeluarga'));
    }

    public function update(Request $request, KartuKeluarga $kartuKeluarga)
    {
        $request->validate([
            'no_kk' => 'required|digits:16|unique:kartu_keluargas,no_kk,' . $kartuKeluarga->id,
            'kepala_keluarga' => 'required|string|max:255',
        ]);

        $kartuKeluarga->update($request->all());

        return redirect()->route('kartu-keluarga.show', $kartuKeluarga)
            ->with('success', 'Data Kartu Keluarga berhasil diperbarui.');
    }

    public function destroy(KartuKeluarga $kartuKeluarga)
    {
        $kartuKeluarga->delete();

        return redirect()->route('kartu-keluarga.index')
            ->with('success', 'Data Kartu Keluarga berhasil dihapus.');
    }


    public function exportCsv()
    {
        $filename = 'laporan-kartu-keluarga.csv';
        $kks = KartuKeluarga::latest()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($kks) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['No KK', 'Kepala Keluarga', 'Dusun', 'Blok', 'RT', 'RW', 'Alamat', 'Status']);

            foreach ($kks as $kk) {
                fputcsv($file, [
                    $kk->no_kk,
                    $kk->kepala_keluarga,
                    $kk->dusun,
                    $kk->blok,
                    $kk->rt,
                    $kk->rw,
                    $kk->alamat,
                    $kk->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function exportPdf()
    {
        $kartuKeluargas = KartuKeluarga::latest()->get();

        $pdf = Pdf::loadView('laporan.pdf.kartu-keluarga', compact('kartuKeluargas'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-kartu-keluarga.pdf');
    }

    
}