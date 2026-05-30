<x-app-layout>
    <section
        x-data="{
            search: '',
            jenis: '',
            resetFilter() {
                this.search = '';
                this.jenis = '';
            }
        }"
        class="px-5 pt-6 md:px-0"
    >
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-bold text-emerald-600">Data Kependudukan</p>
                <h1 class="text-2xl font-black text-slate-900">Mutasi Penduduk</h1>
            </div>

            <a href="{{ route('mutasi-penduduk.create') }}"
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
                    placeholder="Cari nama atau NIK..."
                    class="w-full border-0 bg-transparent text-sm font-semibold outline-none ring-0 focus:ring-0">
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3">
                <select x-model="jenis" class="rounded-2xl border-slate-200 text-sm font-bold">
                    <option value="">Semua Mutasi</option>
                    <option value="Lahir">Lahir</option>
                    <option value="Meninggal">Meninggal</option>
                    <option value="Datang">Datang</option>
                    <option value="Pindah">Pindah</option>
                </select>

                <button
                    type="button"
                    @click="resetFilter()"
                    class="rounded-2xl bg-emerald-50 px-4 py-3 text-sm font-black text-emerald-700">
                    Reset Filter
                </button>
            </div>
        </div>

        <div class="mt-5 grid gap-4">
            @forelse ($mutasis as $mutasi)
                <div
                    x-show="
                        ('{{ strtolower($mutasi->penduduk?->nama ?? '') }}'.includes(search.toLowerCase()) || '{{ $mutasi->penduduk?->nik ?? '' }}'.includes(search)) &&
                        (jenis === '' || jenis === '{{ $mutasi->jenis_mutasi }}')
                    "
                    x-transition
                    class="rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5 transition hover:-translate-y-1 hover:shadow-2xl"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl
                                @if($mutasi->jenis_mutasi == 'Lahir') bg-emerald-100
                                @elseif($mutasi->jenis_mutasi == 'Datang') bg-blue-100
                                @elseif($mutasi->jenis_mutasi == 'Pindah') bg-orange-100
                                @else bg-red-100
                                @endif
                                text-2xl">
                                @if($mutasi->jenis_mutasi == 'Lahir') 👶
                                @elseif($mutasi->jenis_mutasi == 'Datang') 📥
                                @elseif($mutasi->jenis_mutasi == 'Pindah') 📤
                                @else 🕊️
                                @endif
                            </div>

                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="font-black text-slate-900">
                                        {{ $mutasi->penduduk?->nama ?? '-' }}
                                    </h3>

                                    <span class="rounded-full px-3 py-1 text-[11px] font-black
                                        @if($mutasi->jenis_mutasi == 'Lahir') bg-emerald-50 text-emerald-700
                                        @elseif($mutasi->jenis_mutasi == 'Datang') bg-blue-50 text-blue-700
                                        @elseif($mutasi->jenis_mutasi == 'Pindah') bg-orange-50 text-orange-700
                                        @else bg-red-50 text-red-700
                                        @endif">
                                        {{ $mutasi->jenis_mutasi }}
                                    </span>
                                </div>

                                <p class="mt-1 text-xs font-bold text-slate-400">
                                    NIK: {{ $mutasi->penduduk?->nik ?? '-' }}
                                </p>

                                <p class="mt-2 text-sm font-semibold text-slate-500">
                                    Tanggal: {{ $mutasi->tanggal_mutasi }}
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('mutasi-penduduk.show', $mutasi) }}"
                           class="rounded-xl bg-emerald-50 px-3 py-2 text-xs font-black text-emerald-700">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="rounded-[2rem] bg-white p-8 text-center shadow-xl shadow-emerald-900/5">
                    <div class="text-5xl">🔄</div>
                    <h3 class="mt-4 text-lg font-black">Belum ada mutasi</h3>
                    <p class="mt-1 text-sm font-semibold text-slate-500">
                        Silakan tambah data mutasi penduduk.
                    </p>
                </div>
            @endforelse
        </div>
    </section>
</x-app-layout>