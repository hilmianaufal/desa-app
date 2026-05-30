<aside class="hidden w-72 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5 md:block">
    <div class="rounded-3xl bg-gradient-to-br from-emerald-500 via-green-500 to-lime-400 p-5 text-white shadow-lg">
        <div class="text-4xl">🌿</div>
        <h1 class="mt-3 text-xl font-black">Desa Digital</h1>
        <p class="text-sm text-emerald-50">Manajemen Data Desa</p>
    </div>

    <nav class="mt-6 space-y-2">
        @foreach ([
            ['🏠','Dashboard', route('dashboard')],
            ['👥','Penduduk', route('penduduk.index')],
            ['🏡','Kartu Keluarga', route('kartu-keluarga.index')],
            ['📄','Surat', route('surat.index')],
            ['🔄','Mutasi', route('mutasi-penduduk.index')],
            ['🎁','Bansos', route('bantuan-sosial.index')],
            ['📊','Laporan', route('laporan.index')],
            ['⚙️','Pengaturan', route('settings.index')],
        ] as [$icon, $label, $url])
            <a href="{{ $url }}"
               class="flex items-center gap-3 rounded-2xl px-4 py-3 font-semibold text-slate-600 transition hover:bg-emerald-50 hover:text-emerald-700">
                <span class="text-xl">{{ $icon }}</span>
                {{ $label }}
            </a>
        @endforeach
    </nav>
</aside>