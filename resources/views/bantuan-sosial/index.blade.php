<x-app-layout>
    <section
        x-data="{
            search: '',
            jenis: '',
            status: '',
            periode: '',
            resetFilter() {
                this.search = '';
                this.jenis = '';
                this.status = '';
                this.periode = '';
            }
        }"
        class="px-5 pt-6 md:px-0"
    >
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-bold text-emerald-600">Program Desa</p>
                <h1 class="text-2xl font-black text-slate-900">Bantuan Sosial</h1>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('bantuan-sosial.export-csv') }}"
                class="rounded-2xl bg-white px-4 py-3 text-sm font-black text-emerald-700 shadow-lg shadow-emerald-900/5">
                    Export
                </a>

                <a href="{{ route('bantuan-sosial.create') }}"
                class="rounded-2xl bg-gradient-to-br from-emerald-500 to-lime-400 px-4 py-3 text-sm font-black text-white shadow-lg shadow-emerald-900/20">
                    + Tambah
                </a>
            </div>
            
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

            <div class="mt-4 grid grid-cols-2 gap-3 md:grid-cols-4">
                <select x-model="jenis" class="rounded-2xl border-slate-200 text-sm font-bold">
                    <option value="">Semua Bantuan</option>
                    @foreach ($bantuans->pluck('jenis_bantuan')->filter()->unique()->values() as $jenisItem)
                        <option value="{{ $jenisItem }}">{{ $jenisItem }}</option>
                    @endforeach
                </select>

                <select x-model="status" class="rounded-2xl border-slate-200 text-sm font-bold">
                    <option value="">Semua Status</option>
                    <option value="Diajukan">Diajukan</option>
                    <option value="Diverifikasi">Diverifikasi</option>
                    <option value="Diterima">Diterima</option>
                    <option value="Ditolak">Ditolak</option>
                </select>

                <select x-model="periode" class="rounded-2xl border-slate-200 text-sm font-bold">
                    <option value="">Semua Periode</option>
                    @foreach ($bantuans->pluck('periode')->filter()->unique()->values() as $periodeItem)
                        <option value="{{ $periodeItem }}">{{ $periodeItem }}</option>
                    @endforeach
                </select>

                <button
                    type="button"
                    @click="resetFilter()"
                    class="rounded-2xl bg-emerald-50 px-4 py-3 text-sm font-black text-emerald-700">
                    Reset
                </button>
            </div>
        </div>

        <div class="mt-5 grid gap-4">
            @forelse ($bantuans as $bantuan)
                <div
                    x-show="
                        ('{{ strtolower($bantuan->penduduk?->nama ?? '') }}'.includes(search.toLowerCase()) || '{{ $bantuan->penduduk?->nik ?? '' }}'.includes(search)) &&
                        (jenis === '' || jenis === '{{ $bantuan->jenis_bantuan }}') &&
                        (status === '' || status === '{{ $bantuan->status }}') &&
                        (periode === '' || periode === '{{ $bantuan->periode }}')
                    "
                    x-transition
                    class="rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5 transition hover:-translate-y-1 hover:shadow-2xl"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-rose-100 text-2xl">
                                🎁
                            </div>

                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="font-black text-slate-900">
                                        {{ $bantuan->penduduk?->nama ?? '-' }}
                                    </h3>

                                    <span class="rounded-full px-3 py-1 text-[11px] font-black
                                        @if($bantuan->status == 'Diterima') bg-emerald-50 text-emerald-700
                                        @elseif($bantuan->status == 'Ditolak') bg-red-50 text-red-700
                                        @elseif($bantuan->status == 'Diverifikasi') bg-blue-50 text-blue-700
                                        @else bg-orange-50 text-orange-700
                                        @endif">
                                        {{ $bantuan->status }}
                                    </span>
                                </div>

                                <p class="mt-1 text-xs font-bold text-slate-400">
                                    {{ $bantuan->jenis_bantuan }} • {{ $bantuan->periode ?? '-' }}
                                </p>

                                <p class="mt-2 text-sm font-black text-emerald-600">
                                    Rp {{ number_format($bantuan->nominal ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('bantuan-sosial.show', $bantuan) }}"
                           class="rounded-xl bg-emerald-50 px-3 py-2 text-xs font-black text-emerald-700 transition hover:bg-emerald-600 hover:text-white">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="rounded-[2rem] bg-white p-8 text-center shadow-xl shadow-emerald-900/5">
                    <div class="text-5xl">🎁</div>
                    <h3 class="mt-4 text-lg font-black">Belum ada data bantuan</h3>
                    <p class="mt-1 text-sm font-semibold text-slate-500">
                        Silakan tambah data bantuan sosial.
                    </p>
                </div>
            @endforelse
        </div>
    </section>
</x-app-layout>