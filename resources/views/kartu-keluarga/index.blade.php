<x-app-layout>
    <section
        x-data="{
            search: '',
            rw: '',
            rt: '',
            dusun: '',
            blok: '',
            resetFilter() {
                this.search = '';
                this.rw = '';
                this.rt = '';
                this.dusun = '';
                this.blok = '';
            }
        }"
        class="px-5 pt-6 md:px-0"
    >
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-bold text-emerald-600">Manajemen Data</p>
                <h1 class="text-2xl font-black text-slate-900">Kartu Keluarga</h1>
            </div>

            <a href="{{ route('kartu-keluarga.create') }}"
               class="rounded-2xl bg-gradient-to-br from-emerald-500 to-lime-400 px-4 py-3 text-sm font-black text-white shadow-lg shadow-emerald-900/20">
                + Tambah
            </a>
        </div>

        @if (session('success'))
            <div class="mt-5 rounded-2xl bg-emerald-100 px-4 py-3 text-sm font-bold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-5 rounded-[2rem] bg-white p-4 shadow-xl shadow-emerald-900/5">
            <div class="flex items-center gap-3 rounded-2xl bg-slate-100 px-4 py-3">
                <span>🔍</span>
                <input
                    type="text"
                    x-model="search"
                    placeholder="Cari nomor KK atau kepala keluarga..."
                    class="w-full border-0 bg-transparent text-sm font-semibold outline-none ring-0 focus:ring-0">
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3 md:grid-cols-4">
                <select x-model="dusun" class="rounded-2xl border-slate-200 text-sm font-bold">
                    <option value="">Semua Dusun</option>
                    @foreach ($kartuKeluargas->pluck('dusun')->filter()->unique()->values() as $dusunItem)
                        <option value="{{ $dusunItem }}">{{ $dusunItem }}</option>
                    @endforeach
                </select>

                <select x-model="rw" class="rounded-2xl border-slate-200 text-sm font-bold">
                    <option value="">Semua RW</option>
                    @foreach ($kartuKeluargas->pluck('rw')->filter()->unique()->values() as $rwItem)
                        <option value="{{ $rwItem }}">RW {{ $rwItem }}</option>
                    @endforeach
                </select>

                <select x-model="rt" class="rounded-2xl border-slate-200 text-sm font-bold">
                    <option value="">Semua RT</option>
                    @foreach ($kartuKeluargas->pluck('rt')->filter()->unique()->values() as $rtItem)
                        <option value="{{ $rtItem }}">RT {{ $rtItem }}</option>
                    @endforeach
                </select>

                <select x-model="blok" class="rounded-2xl border-slate-200 text-sm font-bold">
                    <option value="">Semua Blok</option>
                    @foreach ($kartuKeluargas->pluck('blok')->filter()->unique()->values() as $blokItem)
                        <option value="{{ $blokItem }}">{{ $blokItem }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4 flex items-center justify-between rounded-2xl bg-emerald-50 px-4 py-3">
                <p class="text-sm font-black text-emerald-700">
                    Filter realtime aktif
                </p>

                <button
                    type="button"
                    @click="resetFilter()"
                    class="rounded-xl bg-white px-3 py-2 text-xs font-black text-emerald-700 shadow-sm">
                    Reset
                </button>
            </div>
        </div>

        <div class="mt-5 grid gap-4">
            @forelse ($kartuKeluargas as $kk)
                <div
                    x-show="
                        ('{{ strtolower($kk->kepala_keluarga) }}'.includes(search.toLowerCase()) || '{{ $kk->no_kk }}'.includes(search)) &&
                        (rw === '' || rw === '{{ $kk->rw }}') &&
                        (rt === '' || rt === '{{ $kk->rt }}') &&
                        (dusun === '' || dusun === '{{ $kk->dusun }}') &&
                        (blok === '' || blok === '{{ $kk->blok }}')
                    "
                    x-transition
                    class="rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5 transition hover:-translate-y-1 hover:shadow-2xl"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-lime-100 text-2xl">
                                🏡
                            </div>

                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="font-black text-slate-900">{{ $kk->kepala_keluarga }}</h3>

                                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-black text-emerald-700">
                                        {{ $kk->status }}
                                    </span>
                                </div>

                                <p class="mt-1 text-xs font-bold text-slate-400">
                                    No KK: {{ $kk->no_kk }}
                                </p>

                                <p class="mt-2 text-sm font-semibold text-slate-500">
                                    {{ $kk->dusun ?? '-' }} • {{ $kk->blok ?? '-' }}
                                </p>

                                <p class="mt-1 text-xs font-bold text-slate-400">
                                    RT {{ $kk->rt ?? '-' }} / RW {{ $kk->rw ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('kartu-keluarga.show', $kk) }}"
                           class="rounded-xl bg-emerald-50 px-3 py-2 text-xs font-black text-emerald-700 transition hover:bg-emerald-600 hover:text-white">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="rounded-[2rem] bg-white p-8 text-center shadow-xl shadow-emerald-900/5">
                    <div class="text-5xl">🏡</div>
                    <h3 class="mt-4 text-lg font-black">Belum ada data KK</h3>
                    <p class="mt-1 text-sm font-semibold text-slate-500">
                        Silakan tambah data kartu keluarga.
                    </p>
                </div>
            @endforelse
        </div>
    </section>
</x-app-layout>