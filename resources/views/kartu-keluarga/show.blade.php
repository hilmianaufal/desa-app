<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        @if (session('success'))
            <div class="mb-5 rounded-2xl bg-emerald-100 px-4 py-3 text-sm font-bold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-[2rem] bg-gradient-to-br from-emerald-500 to-lime-400 p-6 text-white shadow-xl shadow-emerald-900/20">
            <p class="text-sm font-bold text-emerald-50">Detail Kartu Keluarga</p>
            <h1 class="mt-1 text-3xl font-black">{{ $kartuKeluarga->kepala_keluarga }}</h1>
            <p class="mt-2 text-sm font-semibold text-emerald-50">{{ $kartuKeluarga->no_kk }}</p>
        </div>

<div class="mt-5 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-emerald-600">Anggota Keluarga</p>
            <h2 class="text-xl font-black text-slate-900">
                {{ $kartuKeluarga->penduduks->count() }} Anggota
            </h2>
        </div>

        <a href="{{ route('penduduk.create') }}"
           class="rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-black text-white">
            + Tambah
        </a>
    </div>

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
                                {{ $anggota->jenis_kelamin }} • {{ $anggota->pekerjaan ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('penduduk.show', $anggota) }}"
                       class="rounded-xl bg-white px-3 py-2 text-xs font-black text-emerald-700">
                        Detail
                    </a>
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
</div>
    </section>
</x-app-layout>