<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div class="rounded-[2rem] bg-gradient-to-br from-emerald-500 to-lime-400 p-6 text-white shadow-xl shadow-emerald-900/20">
            <p class="text-sm font-bold text-emerald-50">Detail Penduduk</p>
            <h1 class="mt-1 text-3xl font-black">{{ $penduduk->nama }}</h1>
            <p class="mt-2 text-sm font-semibold text-emerald-50">{{ $penduduk->nik }}</p>
        </div>

        <div class="mt-5 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
<div class="grid gap-4">
    @forelse ($kartuKeluarga->penduduks as $anggota)
        <div class="rounded-2xl bg-slate-50 p-4">
            <div class="flex items-start justify-between gap-4">
                <div class="flex gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl {{ $anggota->jenis_kelamin == 'Laki-laki' ? 'bg-blue-100' : 'bg-pink-100' }} text-xl">
                        {{ $anggota->jenis_kelamin == 'Laki-laki' ? '👨' : '👩' }}
                    </div>

                    <div>
                        <h3 class="font-black text-slate-900">{{ $anggota->nama }}</h3>

                        <p class="mt-1 text-xs font-bold text-slate-400">
                            NIK: {{ $anggota->nik }}
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-500">
                            {{ $anggota->jenis_kelamin }}
                            • {{ $anggota->umur ?? '-' }} Tahun
                            • {{ $anggota->pekerjaan ?? '-' }}
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            {{ $anggota->tempat_lahir ?? '-' }},
                            {{ $anggota->tanggal_lahir
                                ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y')
                                : '-' }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('penduduk.show', $anggota) }}"
                       class="rounded-xl bg-white px-3 py-2 text-xs font-black text-emerald-700">
                        Detail
                    </a>

                    <form
                        action="{{ route('penduduk.destroy', $anggota) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus anggota penduduk ini?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="rounded-xl bg-red-50 px-3 py-2 text-xs font-black text-red-700">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="rounded-2xl bg-slate-50 p-8 text-center">
            <div class="text-4xl">👨‍👩‍👧</div>
            <h3 class="mt-3 font-black text-slate-900">Belum ada anggota</h3>
            <p class="mt-1 text-sm font-semibold text-slate-500">
                Belum ada penduduk yang terhubung ke KK ini.
            </p>
        </div>
    @endforelse
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