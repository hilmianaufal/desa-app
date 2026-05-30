<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Setting;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $surats = Surat::with('penduduk')->latest()->get();

        return view('surat.index', compact('surats'));
    }

    public function create()
    {
        $penduduks = Penduduk::latest()->get();

        return view('surat.create', compact('penduduks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_surat' => 'required|string|max:255',
            'keperluan' => 'nullable|string',
        ]);

        Surat::create([
            'penduduk_id' => $request->penduduk_id,
            'nomor_surat' => $this->generateNomorSurat($request->jenis_surat),
            'jenis_surat' => $request->jenis_surat,
            'keperluan' => $request->keperluan,
            'status' => 'Diajukan',
            'tanggal_surat' => now(),
        ]);

        return redirect()->route('surat.index')->with('success', 'Pengajuan surat berhasil dibuat.');
    }

    public function show(Surat $surat)
    {
        $surat->load('penduduk');

        return view('surat.show', compact('surat'));
    }

    public function updateStatus(Request $request, Surat $surat)
    {
        $request->validate([
            'status' => 'required|in:Diajukan,Diproses,Selesai,Ditolak',
        ]);

        $surat->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status surat berhasil diperbarui.');
    }

public function cetak(Surat $surat)
{
    $surat->load('penduduk');

    $setting = Setting::firstOrCreate([]);

    $logoBase64 = $this->imageToBase64($setting->logo_desa);
    $ttdBase64 = $this->imageToBase64($setting->ttd_kepala_desa);

    $pdf = Pdf::loadView('surat.cetak', compact(
        'surat',
        'setting',
        'logoBase64',
        'ttdBase64'
    ))->setPaper('A4', 'portrait');

    $filename = str_replace(['/', '\\'], '-', $surat->nomor_surat) . '.pdf';

    return $pdf->stream($filename);
}

private function imageToBase64($path)
{
    if (!$path) {
        return null;
    }

    $fullPath = public_path($path);

    if (!file_exists($fullPath)) {
        return null;
    }

    $mime = mime_content_type($fullPath);

    if (!str_starts_with($mime, 'image/')) {
        return null;
    }

    $data = file_get_contents($fullPath);

    return 'data:' . $mime . ';base64,' . base64_encode($data);
}

    private function generateNomorSurat($jenisSurat)
    {
        $kode = match ($jenisSurat) {
            'Surat Keterangan Domisili' => '470',
            'Surat Keterangan Tidak Mampu' => '460',
            'Surat Keterangan Usaha' => '503',
            'Surat Pengantar KTP' => '474',
            'Surat Keterangan Kelahiran' => '472',
            'Surat Keterangan Kematian' => '474.3',
            default => '470',
        };

        $urutan = Surat::whereYear('created_at', date('Y'))->count() + 1;

        return $kode . '/' . str_pad($urutan, 3, '0', STR_PAD_LEFT) . '/DESA/' . date('Y');
    }


    public function exportCsv()
    {
        $filename = 'laporan-surat.csv';
        $surats = Surat::with('penduduk')->latest()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($surats) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Nomor Surat', 'Jenis Surat', 'Nama Pemohon', 'NIK', 'Tanggal Surat', 'Status', 'Keperluan']);

            foreach ($surats as $surat) {
                fputcsv($file, [
                    $surat->nomor_surat,
                    $surat->jenis_surat,
                    $surat->penduduk?->nama,
                    $surat->penduduk?->nik,
                    $surat->tanggal_surat,
                    $surat->status,
                    $surat->keperluan,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf()
    {
        $surats = Surat::with('penduduk')->latest()->get();

        $pdf = Pdf::loadView('laporan.pdf.surat', compact('surats'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-surat.pdf');
    }

}