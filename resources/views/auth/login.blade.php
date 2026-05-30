<x-guest-layout>
    <div class="min-h-screen bg-[#F4FBF7] px-5 py-8 md:flex md:items-center md:justify-center">
        <div class="mx-auto w-full max-w-6xl overflow-hidden rounded-[2.5rem] bg-white shadow-2xl shadow-emerald-900/10 md:grid md:grid-cols-2">

            <div class="relative hidden overflow-hidden bg-gradient-to-br from-emerald-500 via-green-500 to-lime-400 p-10 text-white md:block">
                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/20"></div>
                <div class="absolute bottom-10 right-10 h-32 w-32 rounded-full bg-white/10"></div>

                <div class="relative z-10 flex h-full flex-col justify-between">
                    <div>
                        <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-white/20 text-4xl shadow-xl backdrop-blur">
                            🌿
                        </div>

                        <h1 class="mt-8 text-4xl font-black leading-tight">
                            Desa Digital Premium
                        </h1>

                        <p class="mt-4 max-w-md text-sm font-semibold leading-7 text-emerald-50">
                            Kelola data penduduk, kartu keluarga, surat menyurat, mutasi, dan bantuan sosial desa dalam satu dashboard modern.
                        </p>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div class="rounded-3xl bg-white/20 p-4 backdrop-blur">
                            <p class="text-2xl font-black">24/7</p>
                            <p class="text-xs font-bold text-emerald-50">Online</p>
                        </div>

                        <div class="rounded-3xl bg-white/20 p-4 backdrop-blur">
                            <p class="text-2xl font-black">PDF</p>
                            <p class="text-xs font-bold text-emerald-50">Laporan</p>
                        </div>

                        <div class="rounded-3xl bg-white/20 p-4 backdrop-blur">
                            <p class="text-2xl font-black">Aman</p>
                            <p class="text-xs font-bold text-emerald-50">Data Desa</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-12">
                <div class="mb-8 text-center md:text-left">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-3xl bg-gradient-to-br from-emerald-500 to-lime-400 text-3xl text-white shadow-xl shadow-emerald-900/20 md:mx-0">
                        🏡
                    </div>

                    <h2 class="mt-5 text-3xl font-black text-slate-900">
                        Selamat Datang
                    </h2>

                    <p class="mt-2 text-sm font-semibold text-slate-500">
                        Masuk ke dashboard manajemen data desa.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="text-sm font-black text-slate-700">Email</label>
                        <div class="mt-2 flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 focus-within:border-emerald-400 focus-within:bg-white">
                            <span class="text-lg">✉️</span>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="admin@desa.id"
                                class="w-full border-0 bg-transparent p-0 text-sm font-bold text-slate-800 placeholder:text-slate-400 focus:ring-0">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password" class="text-sm font-black text-slate-700">Password</label>
                        <div class="mt-2 flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 focus-within:border-emerald-400 focus-within:bg-white">
                            <span class="text-lg">🔒</span>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="w-full border-0 bg-transparent p-0 text-sm font-bold text-slate-800 placeholder:text-slate-400 focus:ring-0">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                                name="remember">
                            <span class="ms-2 text-sm font-bold text-slate-500">
                                Ingat saya
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-black text-emerald-600 hover:text-emerald-700" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-gradient-to-br from-emerald-500 to-lime-400 px-5 py-4 text-sm font-black text-white shadow-xl shadow-emerald-900/20 transition hover:-translate-y-0.5 hover:shadow-2xl active:scale-95">
                        Masuk Dashboard
                    </button>
                </form>

                <div class="mt-8 rounded-3xl bg-emerald-50 p-4 text-center">
                    <p class="text-xs font-bold text-emerald-700">
                        Sistem Manajemen Data Desa • Mobile First • Premium UI
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>