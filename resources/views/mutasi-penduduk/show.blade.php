<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div class="rounded-[2rem] bg-gradient-to-br from-emerald-500 to-lime-400 p-6 text-white shadow-xl shadow-emerald-900/20">
            <p class="text-sm font-bold text-emerald-50">Detail Mutasi</p>
            <h1 class="mt-1 text-3xl font-black">{{ $mutasiPenduduk->jenis_mutasi }}</h1>
            <p class="mt-2 text-sm font-semibold text-emerald-50">
                {{ $mutasiPenduduk->penduduk?->nama ?? '-' }}
            </p>
        </div>

        <div class="mt-5 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ([
                    'Nama Penduduk' => $mutasiPenduduk->penduduk?->nama,
                    'NIK' => $mutasiPenduduk->penduduk?->nik,
                    'Jenis Mutasi' => $mutasiPenduduk->jenis_mutasi,
                    'Tanggal Mutasi' => $mutasiPenduduk->tanggal_mutasi,
                    'Status Penduduk' => $mutasiPenduduk->penduduk?->status,
                    'Keterangan' => $mutasiPenduduk->keterangan,
                ] as $label => $value)
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-xs font-black uppercase text-slate-400">{{ $label }}</p>
                        <p class="mt-1 font-bold text-slate-800">{{ $value ?? '-' }}</p>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('mutasi-penduduk.edit', $mutasiPenduduk) }}"
            class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white">
                Edit
            </a>
            <div class="mt-6 flex gap-3">
                <a href="{{ route('mutasi-penduduk.index') }}"
                   class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Kembali
                </a>
            </div>
        </div>
    </section>
</x-app-layout>