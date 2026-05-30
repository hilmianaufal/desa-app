<nav class="fixed bottom-0 left-0 right-0 z-50 mx-auto max-w-md rounded-t-[2rem] border border-white/70 bg-white/90 px-4 py-3 shadow-2xl backdrop-blur md:hidden">
    <div class="grid grid-cols-5 items-center text-center text-xs font-bold text-slate-400">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'text-emerald-600' : '' }}">
            <div class="mx-auto mb-1 flex h-10 w-10 items-center justify-center rounded-full {{ request()->routeIs('dashboard') ? 'bg-emerald-500 text-white' : 'bg-slate-100' }}">
                🏠
            </div>
            Home
        </a>

        {{-- Penduduk --}}
        <a href="{{ route('penduduk.index') }}"
           class="{{ request()->routeIs('penduduk.*') ? 'text-emerald-600' : '' }}">
            <div class="mx-auto mb-1 flex h-10 w-10 items-center justify-center rounded-full {{ request()->routeIs('penduduk.*') ? 'bg-emerald-500 text-white' : 'bg-slate-100' }}">
                👥
            </div>
            Data
        </a>

        {{-- Tambah Penduduk --}}
        <a href="{{ route('penduduk.create') }}">
            <div class="mx-auto -mt-8 mb-1 flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-lime-400 text-2xl text-white shadow-xl">
                +
            </div>
            Tambah
        </a>

        {{-- Surat --}}
        <a href="{{ route('surat.index') }}"
           class="{{ request()->routeIs('surat.*') ? 'text-emerald-600' : '' }}">
            <div class="mx-auto mb-1 flex h-10 w-10 items-center justify-center rounded-full {{ request()->routeIs('surat.*') ? 'bg-emerald-500 text-white' : 'bg-slate-100' }}">
                📄
            </div>
            Surat
        </a>

        {{-- Pengaturan --}}
        <a href="{{ route('settings.index') }}"
           class="{{ request()->routeIs('settings.*') ? 'text-emerald-600' : '' }}">
            <div class="mx-auto mb-1 flex h-10 w-10 items-center justify-center rounded-full {{ request()->routeIs('settings.*') ? 'bg-emerald-500 text-white' : 'bg-slate-100' }}">
                ⚙️
            </div>
            Setting
        </a>

    </div>
</nav>