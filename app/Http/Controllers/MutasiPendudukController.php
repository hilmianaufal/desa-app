<?php

namespace App\Http\Controllers;

use App\Models\MutasiPenduduk;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class MutasiPendudukController extends Controller
{
    public function index()
    {
        $mutasis = MutasiPenduduk::with('penduduk')->latest()->get();

        return view('mutasi-penduduk.index', compact('mutasis'));
    }

    public function create()
    {
        $penduduks = Penduduk::latest()->get();

        return view('mutasi-penduduk.create', compact('penduduks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_mutasi' => 'required|in:Lahir,Meninggal,Datang,Pindah',
            'tanggal_mutasi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $mutasi = MutasiPenduduk::create($request->all());

        if ($request->jenis_mutasi === 'Meninggal') {
            $mutasi->penduduk?->update(['status' => 'Meninggal']);
        }

        if ($request->jenis_mutasi === 'Pindah') {
            $mutasi->penduduk?->update(['status' => 'Pindah']);
        }

        if (in_array($request->jenis_mutasi, ['Lahir', 'Datang'])) {
            $mutasi->penduduk?->update(['status' => 'Aktif']);
        }

        return redirect()->route('mutasi-penduduk.index')
            ->with('success', 'Data mutasi penduduk berhasil ditambahkan.');
    }

    public function show(MutasiPenduduk $mutasiPenduduk)
    {
        $mutasiPenduduk->load('penduduk');

        return view('mutasi-penduduk.show', compact('mutasiPenduduk'));
    }


    public function edit(MutasiPenduduk $mutasiPenduduk)
    {
        $penduduks = Penduduk::latest()->get();

        return view('mutasi-penduduk.edit', compact('mutasiPenduduk', 'penduduks'));
    }

    public function update(Request $request, MutasiPenduduk $mutasiPenduduk)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_mutasi' => 'required|in:Lahir,Meninggal,Datang,Pindah',
            'tanggal_mutasi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $mutasiPenduduk->update($request->all());

        if ($request->jenis_mutasi === 'Meninggal') {
            $mutasiPenduduk->penduduk?->update(['status' => 'Meninggal']);
        }

        if ($request->jenis_mutasi === 'Pindah') {
            $mutasiPenduduk->penduduk?->update(['status' => 'Pindah']);
        }

        if (in_array($request->jenis_mutasi, ['Lahir', 'Datang'])) {
            $mutasiPenduduk->penduduk?->update(['status' => 'Aktif']);
        }

        return redirect()->route('mutasi-penduduk.show', $mutasiPenduduk)
            ->with('success', 'Data mutasi berhasil diperbarui.');
    }

    public function destroy(MutasiPenduduk $mutasiPenduduk)
    {
        $mutasiPenduduk->delete();

        return redirect()->route('mutasi-penduduk.index')
            ->with('success', 'Data mutasi berhasil dihapus.');
    }


    public function exportCsv()
    {
        $filename = 'laporan-mutasi-penduduk.csv';
        $mutasis = MutasiPenduduk::with('penduduk')->latest()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($mutasis) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Nama', 'NIK', 'Jenis Mutasi', 'Tanggal Mutasi', 'Keterangan']);

            foreach ($mutasis as $mutasi) {
                fputcsv($file, [
                    $mutasi->penduduk?->nama,
                    $mutasi->penduduk?->nik,
                    $mutasi->jenis_mutasi,
                    $mutasi->tanggal_mutasi,
                    $mutasi->keterangan,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}