<x-app-layout>
    <section class="relative overflow-hidden rounded-b-[2.5rem] bg-gradient-to-br from-emerald-500 via-green-500 to-lime-400 px-5 pb-8 pt-6 text-white shadow-xl shadow-emerald-900/20 md:rounded-[2rem] md:px-8">
        <div class="absolute -right-16 -top-16 h-44 w-44 rounded-full bg-white/20"></div>
        <div class="absolute bottom-8 right-8 h-24 w-24 rounded-full bg-white/10"></div>

        <div class="relative flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-emerald-50">Halo, Admin Desa 👋</p>
                <h2 class="mt-1 text-2xl font-black md:text-3xl">Dashboard Desa</h2>
            </div>

            <button class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/25 text-2xl shadow-lg backdrop-blur transition active:scale-95">
                🔔
            </button>
        </div>

        <div class="relative mt-7 rounded-[2rem] border border-white/20 bg-white/20 p-5 backdrop-blur-xl md:max-w-xl">
            <p class="text-sm text-emerald-50">Total Penduduk Aktif</p>

            <div class="mt-2 flex items-end justify-between">
                <h1 class="text-5xl font-black">{{ number_format($totalPenduduk) }}</h1>

            <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-emerald-700">
                {{ number_format($totalAktif) }} Aktif
            </span>
            </div>

            <p class="mt-3 text-sm text-emerald-50">Data administrasi desa tahun 2026</p>
        </div>
    </section>

    <section class="grid grid-cols-2 gap-4 px-5 py-6 md:grid-cols-4 md:px-0">
            @foreach ([
                ['👥', $totalPenduduk, 'Total Penduduk', 'from-emerald-50 to-white', 'text-emerald-600'],
                ['🏡', $totalKK, 'Kartu Keluarga', 'from-lime-50 to-white', 'text-lime-600'],
                ['👨', $totalLaki, 'Laki-laki', 'from-blue-50 to-white', 'text-blue-600'],
                ['👩', $totalPerempuan, 'Perempuan', 'from-pink-50 to-white', 'text-pink-600'],
                ['📄', $totalSurat, 'Total Surat', 'from-cyan-50 to-white', 'text-cyan-600'],
                ['🎁', $totalBansos, 'Data Bansos', 'from-rose-50 to-white', 'text-rose-600'],
            ] as [$icon, $number, $title, $bg, $color])
            <div class="rounded-[1.7rem] border border-white bg-gradient-to-br {{ $bg }} p-5 shadow-lg shadow-emerald-900/5 transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-2xl shadow-sm">
                    {{ $icon }}
                </div>

                <h3 class="mt-4 text-2xl font-black {{ $color }}">{{ number_format($number) }}</h3>
                <p class="text-sm font-semibold text-slate-500">{{ $title }}</p>
            </div>
        @endforeach
    </section>

    <section class="px-5 md:px-0">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-black">Menu Utama</h2>
            <button class="text-sm font-bold text-emerald-600">Lihat semua</button>
        </div>

        <div class="grid grid-cols-3 gap-4 md:grid-cols-6">
            @foreach ([
                ['👥', 'Penduduk', 'bg-emerald-100 text-emerald-700', route('penduduk.index')],
                ['🏡', 'KK', 'bg-lime-100 text-lime-700', route('kartu-keluarga.index')],
                ['📄', 'Surat', 'bg-cyan-100 text-cyan-700', route('surat.index')],
                ['🔄', 'Mutasi', 'bg-orange-100 text-orange-700', route('mutasi-penduduk.index')],
                ['🎁', 'Bansos', 'bg-rose-100 text-rose-700', route('bantuan-sosial.index')],
                ['📊', 'Laporan', 'bg-violet-100 text-violet-700', '#'],
            ] as [$icon, $title, $style, $url])
                <a href="{{ $url }}"
                   class="group rounded-[1.7rem] bg-white p-4 text-center shadow-lg shadow-emerald-900/5 transition duration-300 hover:-translate-y-1 hover:shadow-2xl active:scale-95">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl {{ $style }} text-2xl transition group-hover:scale-110">
                        {{ $icon }}
                    </div>

                    <p class="mt-3 text-sm font-black text-slate-700">{{ $title }}</p>
                </a>
            @endforeach
        </div>
    </section>
    <section class="mt-7 px-5 md:px-0">
    <div class="rounded-[2rem] bg-slate-950 p-5 text-white shadow-xl shadow-slate-900/20">
        <p class="text-sm font-bold text-emerald-300">Status Surat</p>
        <h2 class="mt-1 text-2xl font-black">Administrasi Surat Desa</h2>

        <div class="mt-5 grid grid-cols-3 gap-3">
            <div class="rounded-2xl bg-white/10 p-4">
                <p class="text-2xl font-black">{{ $suratDiajukan }}</p>
                <p class="text-xs font-bold text-slate-300">Diajukan</p>
            </div>

            <div class="rounded-2xl bg-white/10 p-4">
                <p class="text-2xl font-black">{{ $suratDiproses }}</p>
                <p class="text-xs font-bold text-slate-300">Diproses</p>
            </div>

            <div class="rounded-2xl bg-white/10 p-4">
                <p class="text-2xl font-black">{{ $suratSelesai }}</p>
                <p class="text-xs font-bold text-slate-300">Selesai</p>
            </div>
        </div>

        <a href="{{ route('surat.index') }}"
           class="mt-5 inline-block rounded-2xl bg-emerald-400 px-5 py-3 text-sm font-black text-slate-950">
            Kelola Surat
        </a>
    </div>
</section>
<section class="mt-5 px-5 md:px-0">
    <div class="rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
        <p class="text-sm font-bold text-emerald-600">Statistik Mutasi</p>
        <h2 class="mt-1 text-2xl font-black text-slate-900">
            {{ $totalMutasi }} Riwayat Mutasi
        </h2>

        <div class="mt-5 grid grid-cols-2 gap-3 md:grid-cols-4">
            <div class="rounded-2xl bg-emerald-50 p-4">
                <p class="text-2xl font-black text-emerald-600">{{ $totalLahir }}</p>
                <p class="text-xs font-bold text-slate-500">Lahir</p>
            </div>

            <div class="rounded-2xl bg-blue-50 p-4">
                <p class="text-2xl font-black text-blue-600">{{ $totalDatang }}</p>
                <p class="text-xs font-bold text-slate-500">Datang</p>
            </div>

            <div class="rounded-2xl bg-orange-50 p-4">
                <p class="text-2xl font-black text-orange-600">{{ $totalPindah }}</p>
                <p class="text-xs font-bold text-slate-500">Pindah</p>
            </div>

            <div class="rounded-2xl bg-red-50 p-4">
                <p class="text-2xl font-black text-red-600">{{ $totalMeninggal }}</p>
                <p class="text-xs font-bold text-slate-500">Meninggal</p>
            </div>
        </div>

        <a href="{{ route('mutasi-penduduk.index') }}"
           class="mt-5 inline-block rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-black text-white">
            Kelola Mutasi
        </a>
    </div>
</section>
<section class="mt-5 px-5 md:px-0">
    <div class="rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
        <p class="text-sm font-bold text-emerald-600">Bantuan Sosial</p>
        <h2 class="mt-1 text-2xl font-black text-slate-900">
            Rp {{ number_format($totalNominalBansos, 0, ',', '.') }}
        </h2>
        <p class="mt-1 text-sm font-bold text-slate-400">Total bantuan diterima</p>

        <div class="mt-5 grid grid-cols-2 gap-3">
            <div class="rounded-2xl bg-rose-50 p-4">
                <p class="text-2xl font-black text-rose-600">{{ $bansosDiajukan }}</p>
                <p class="text-xs font-bold text-slate-500">Diajukan</p>
            </div>

            <div class="rounded-2xl bg-emerald-50 p-4">
                <p class="text-2xl font-black text-emerald-600">{{ $bansosDiterima }}</p>
                <p class="text-xs font-bold text-slate-500">Diterima</p>
            </div>
        </div>

        <a href="{{ route('bantuan-sosial.index') }}"
           class="mt-5 inline-block rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-black text-white">
            Kelola Bansos
        </a>
    </div>
</section>
</x-app-layout>