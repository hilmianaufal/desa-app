<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-bold text-emerald-600">Administrasi</p>
                <h1 class="text-2xl font-black text-slate-900">Surat Menyurat</h1>
            </div>

            <a href="{{ route('surat.create') }}"
               class="rounded-2xl bg-gradient-to-br from-emerald-500 to-lime-400 px-4 py-3 text-sm font-black text-white shadow-lg shadow-emerald-900/20">
                + Buat
            </a>
        </div>

        @if (session('success'))
            <div class="mt-5 rounded-2xl bg-emerald-100 px-4 py-3 text-sm font-bold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5 grid gap-4">
            @forelse ($surats as $surat)
                <div class="rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5 transition hover:-translate-y-1 hover:shadow-2xl">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-100 text-2xl">
                                📄
                            </div>

                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="font-black text-slate-900">{{ $surat->jenis_surat }}</h3>

                                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-black text-emerald-700">
                                        {{ $surat->status }}
                                    </span>
                                </div>

                                <p class="mt-1 text-xs font-bold text-slate-400">
                                    {{ $surat->nomor_surat }}
                                </p>

                                <p class="mt-2 text-sm font-semibold text-slate-500">
                                    {{ $surat->penduduk?->nama ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('surat.show', $surat) }}"
                           class="rounded-xl bg-emerald-50 px-3 py-2 text-xs font-black text-emerald-700">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="rounded-[2rem] bg-white p-8 text-center shadow-xl shadow-emerald-900/5">
                    <div class="text-5xl">📄</div>
                    <h3 class="mt-4 text-lg font-black">Belum ada surat</h3>
                    <p class="mt-1 text-sm font-semibold text-slate-500">Silakan buat pengajuan surat baru.</p>
                </div>
            @endforelse
        </div>
    </section>
</x-app-layout>