<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Pusat Data</p>
            <h1 class="text-2xl font-black text-slate-900">Laporan Desa</h1>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            @foreach ([
                ['👥', 'Laporan Penduduk', 'Export data penduduk lengkap', route('penduduk.export-pdf'), route('penduduk.export-csv')],
                ['🏡', 'Laporan Kartu Keluarga', 'Export data KK lengkap', route('kartu-keluarga.export-pdf'), route('kartu-keluarga.export-csv')],
                ['📄', 'Laporan Surat', 'Export data surat menyurat', route('surat.export-pdf'), route('surat.export-csv')],
                ['🔄', 'Laporan Mutasi', 'Export data mutasi penduduk', route('mutasi-penduduk.export-pdf'), route('mutasi-penduduk.export-csv')],
                ['🎁', 'Laporan Bansos', 'Export data bantuan sosial', route('bantuan-sosial.export-pdf'), route('bantuan-sosial.export-csv')],
            ] as [$icon, $title, $desc, $pdfUrl, $csvUrl])
                <div class="rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5 transition hover:-translate-y-1 hover:shadow-2xl">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-2xl">
                                {{ $icon }}
                            </div>

                            <div>
                                <h3 class="font-black text-slate-900">{{ $title }}</h3>
                                <p class="mt-1 text-sm font-semibold text-slate-500">{{ $desc }}</p>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ $pdfUrl }}" target="_blank"
                               class="rounded-xl bg-slate-900 px-4 py-2 text-xs font-black text-white">
                                PDF
                            </a>

                            <a href="{{ $csvUrl }}"
                               class="rounded-xl bg-emerald-50 px-4 py-2 text-xs font-black text-emerald-700">
                                CSV
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>