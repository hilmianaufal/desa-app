<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div class="rounded-[2rem] bg-gradient-to-br from-emerald-500 to-lime-400 p-6 text-white shadow-xl shadow-emerald-900/20">
            <p class="text-sm font-bold text-emerald-50">Detail Penduduk</p>
            <h1 class="mt-1 text-3xl font-black">{{ $penduduk->nama }}</h1>
            <p class="mt-2 text-sm font-semibold text-emerald-50">{{ $penduduk->nik }}</p>
        </div>

        <div class="mt-5 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ([
                    'Nomor KK' => $penduduk->no_kk,
                    'Jenis Kelamin' => $penduduk->jenis_kelamin,
                    'Tempat Lahir' => $penduduk->tempat_lahir,
                    'Tanggal Lahir' => $penduduk->tanggal_lahir,
                    'Agama' => $penduduk->agama,
                    'Pendidikan' => $penduduk->pendidikan,
                    'Pekerjaan' => $penduduk->pekerjaan,
                    'Status Perkawinan' => $penduduk->status_perkawinan,
                    'RT' => $penduduk->rt,
                    'RW' => $penduduk->rw,
                    'Dusun' => $penduduk->dusun,
                    'Blok' => $penduduk->blok,
                    'Status' => $penduduk->status,
                    'Alamat' => $penduduk->alamat,
                    'Nomor KK' => $penduduk->kartuKeluarga?->no_kk ?? $penduduk->no_kk,
                    'Kepala Keluarga' => $penduduk->kartuKeluarga?->kepala_keluarga,
                ] as $label => $value)
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-xs font-black uppercase text-slate-400">{{ $label }}</p>
                        <p class="mt-1 font-bold text-slate-800">{{ $value ?? '-' }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('penduduk.index') }}" class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Kembali
                </a>

                <a href="{{ route('penduduk.edit', $penduduk) }}" class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white">
                    Edit
                </a>

                <form action="{{ route('penduduk.destroy', $penduduk) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus data penduduk ini?')">
                    @csrf
                    @method('DELETE')

                    <button class="rounded-2xl bg-red-50 px-5 py-3 font-black text-red-600">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>