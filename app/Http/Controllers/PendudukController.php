<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
        public function index(Request $request)
        {
            $penduduks = Penduduk::latest()->get();

            return view('penduduk.index', compact('penduduks'));
        }

    public function create()
    {
        $kartuKeluargas = KartuKeluarga::latest()->get();

        return view('penduduk.create', compact('kartuKeluargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16|unique:penduduks,nik',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
        ]);

        Penduduk::create($request->all());

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function show(Penduduk $penduduk)
    {
        return view('penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk)
    {
        $kartuKeluargas = KartuKeluarga::latest()->get();

        return view('penduduk.edit', compact('penduduk', 'kartuKeluargas'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $request->validate([
            'nik' => 'required|digits:16|unique:penduduks,nik,' . $penduduk->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
        ]);

        $penduduk->update($request->all());

        return redirect()->route('penduduk.show', $penduduk)->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
    }

    public function exportCsv()
    {
        $filename = 'laporan-penduduk.csv';

        $penduduks = Penduduk::latest()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($penduduks) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'NIK',
                'No KK',
                'Nama',
                'Jenis Kelamin',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Agama',
                'Pendidikan',
                'Pekerjaan',
                'Status Perkawinan',
                'Dusun',
                'Blok',
                'RT',
                'RW',
                'Alamat',
                'Status',
            ]);

            foreach ($penduduks as $penduduk) {
                fputcsv($file, [
                    $penduduk->nik,
                    $penduduk->no_kk,
                    $penduduk->nama,
                    $penduduk->jenis_kelamin,
                    $penduduk->tempat_lahir,
                    $penduduk->tanggal_lahir,
                    $penduduk->agama,
                    $penduduk->pendidikan,
                    $penduduk->pekerjaan,
                    $penduduk->status_perkawinan,
                    $penduduk->dusun,
                    $penduduk->blok,
                    $penduduk->rt,
                    $penduduk->rw,
                    $penduduk->alamat,
                    $penduduk->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $query = Penduduk::query();

        if ($request->filled('dusun')) {
            $query->where('dusun', $request->dusun);
        }

        if ($request->filled('rw')) {
            $query->where('rw', $request->rw);
        }

        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }

        if ($request->filled('blok')) {
            $query->where('blok', $request->blok);
        }

        $penduduks = $query->latest()->get();

        $filter = [
            'dusun' => $request->dusun,
            'rw' => $request->rw,
            'rt' => $request->rt,
            'blok' => $request->blok,
        ];

        $pdf = Pdf::loadView('laporan.pdf.penduduk', compact('penduduks', 'filter'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-penduduk.pdf');
    }
}