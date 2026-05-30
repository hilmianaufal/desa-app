<?php

use App\Http\Controllers\BantuanSosialController;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\MutasiPendudukController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SuratController;
use App\Models\BantuanSosial;
use App\Models\KartuKeluarga;
use App\Models\MutasiPenduduk;
use App\Models\Penduduk;
use App\Models\Surat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $totalPenduduk = Penduduk::count();
    $totalAktif = Penduduk::where('status', 'Aktif')->count();
    $totalLaki = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
    $totalPerempuan = Penduduk::where('jenis_kelamin', 'Perempuan')->count();
    $totalKK = KartuKeluarga::count();

    $totalSurat = Surat::count();
    $suratDiajukan = Surat::where('status', 'Diajukan')->count();
    $suratDiproses = Surat::where('status', 'Diproses')->count();
    $suratSelesai = Surat::where('status', 'Selesai')->count();

    $totalMutasi = MutasiPenduduk::count();
    $totalMeninggal = MutasiPenduduk::where('jenis_mutasi', 'Meninggal')->count();
    $totalPindah = MutasiPenduduk::where('jenis_mutasi', 'Pindah')->count();
    $totalDatang = MutasiPenduduk::where('jenis_mutasi', 'Datang')->count();
    $totalLahir = MutasiPenduduk::where('jenis_mutasi', 'Lahir')->count();


    $totalBansos = BantuanSosial::count();
    $bansosDiajukan = BantuanSosial::where('status', 'Diajukan')->count();
    $bansosDiterima = BantuanSosial::where('status', 'Diterima')->count();
    $totalNominalBansos = BantuanSosial::where('status', 'Diterima')->sum('nominal');

    return view('dashboard', compact(
        'totalPenduduk',
        'totalAktif',
        'totalLaki',
        'totalPerempuan',
        'totalKK',
        'totalSurat',
        'suratDiajukan',
        'suratDiproses',
        'suratSelesai',
        'totalMutasi',
        'totalMeninggal',
        'totalPindah',
        'totalDatang',
        'totalLahir',

        'totalBansos',
        'bansosDiajukan',
        'bansosDiterima',
        'totalNominalBansos'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('penduduk', PendudukController::class);
    Route::resource('kartu-keluarga', KartuKeluargaController::class);
    Route::resource('surat', SuratController::class);
    Route::patch('/surat/{surat}/status', [SuratController::class, 'updateStatus'])
    ->name('surat.update-status');
    Route::get('/surat/{surat}/cetak', [SuratController::class, 'cetak'])
    ->name('surat.cetak');
    Route::resource('bantuan-sosial', BantuanSosialController::class);

    Route::resource('mutasi-penduduk', MutasiPendudukController::class);

    Route::get('/bantuan-sosial-export-csv', [BantuanSosialController::class, 'exportCsv'])
    ->name('bantuan-sosial.export-csv');

    Route::get('/penduduk-export-csv', [PendudukController::class, 'exportCsv'])
    ->name('penduduk.export-csv');

    Route::get('/kartu-keluarga-export-csv', [KartuKeluargaController::class, 'exportCsv'])
    ->name('kartu-keluarga.export-csv');

    Route::get('/surat-export-csv', [SuratController::class, 'exportCsv'])
        ->name('surat.export-csv');

    Route::get('/mutasi-penduduk-export-csv', [MutasiPendudukController::class, 'exportCsv'])
        ->name('mutasi-penduduk.export-csv');

    Route::get('/kartu-keluarga-export-pdf', [KartuKeluargaController::class, 'exportPdf'])
    ->name('kartu-keluarga.export-pdf');

    Route::get('/surat-export-pdf', [SuratController::class, 'exportPdf'])
        ->name('surat.export-pdf');

    Route::get('/mutasi-penduduk-export-pdf', [MutasiPendudukController::class, 'exportPdf'])
        ->name('mutasi-penduduk.export-pdf');

    Route::get('/bantuan-sosial-export-pdf', [BantuanSosialController::class, 'exportPdf'])
        ->name('bantuan-sosial.export-pdf');    

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/laporan', function () {
    return view('laporan.index');
})->middleware(['auth', 'verified'])->name('laporan.index');
    Route::get(
        '/penduduk-export-pdf',
        [PendudukController::class, 'exportPdf']
    )->name('penduduk.export-pdf');

    
});

require __DIR__.'/auth.php';