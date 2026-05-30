<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Konfigurasi Aplikasi</p>
            <h1 class="text-2xl font-black text-slate-900">Pengaturan Desa</h1>
        </div>

        @if (session('success'))
            <div class="mt-5 rounded-2xl bg-emerald-100 px-4 py-3 text-sm font-bold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('settings.update', $setting) }}" method="POST" enctype="multipart/form-data"
              class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
            @csrf
            @method('PUT')

            <div class="grid gap-4 md:grid-cols-2">
                <input name="nama_desa" value="{{ old('nama_desa', $setting->nama_desa) }}" placeholder="Nama Desa" class="rounded-2xl border-slate-200">
                <input name="kecamatan" value="{{ old('kecamatan', $setting->kecamatan) }}" placeholder="Kecamatan" class="rounded-2xl border-slate-200">
                <input name="kabupaten" value="{{ old('kabupaten', $setting->kabupaten) }}" placeholder="Kabupaten" class="rounded-2xl border-slate-200">
                <input name="provinsi" value="{{ old('provinsi', $setting->provinsi) }}" placeholder="Provinsi" class="rounded-2xl border-slate-200">
                <input name="kode_pos" value="{{ old('kode_pos', $setting->kode_pos) }}" placeholder="Kode Pos" class="rounded-2xl border-slate-200">
                <input name="telepon" value="{{ old('telepon', $setting->telepon) }}" placeholder="Telepon" class="rounded-2xl border-slate-200">
                <input name="email" value="{{ old('email', $setting->email) }}" placeholder="Email" class="rounded-2xl border-slate-200">
                <input name="website" value="{{ old('website', $setting->website) }}" placeholder="Website" class="rounded-2xl border-slate-200">
                <input name="nama_kepala_desa" value="{{ old('nama_kepala_desa', $setting->nama_kepala_desa) }}" placeholder="Nama Kepala Desa" class="rounded-2xl border-slate-200">
                <input name="nip_kepala_desa" value="{{ old('nip_kepala_desa', $setting->nip_kepala_desa) }}" placeholder="NIP Kepala Desa" class="rounded-2xl border-slate-200">
            </div>

            <textarea name="alamat" placeholder="Alamat Desa" class="mt-4 w-full rounded-2xl border-slate-200">{{ old('alamat', $setting->alamat) }}</textarea>

            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-4">
                    <label class="text-sm font-black text-slate-700">Logo Desa</label>

                    @if ($setting->logo_desa)
                        <img src="{{ asset($setting->logo_desa) }}" class="mt-3 h-20 rounded-xl bg-white p-2">
                    @endif

                    <input type="file" name="logo_desa" class="mt-3 w-full rounded-2xl border border-slate-200 bg-white p-3 text-sm">
                </div>

                <div class="rounded-2xl bg-slate-50 p-4">
                    <label class="text-sm font-black text-slate-700">TTD Kepala Desa</label>

                    @if ($setting->ttd_kepala_desa)
                        <img src="{{ asset($setting->ttd_kepala_desa) }}" class="mt-3 h-20 rounded-xl bg-white p-2">
                    @endif

                    <input type="file" name="ttd_kepala_desa" class="mt-3 w-full rounded-2xl border border-slate-200 bg-white p-3 text-sm">
                </div>
            </div>

            <button class="mt-6 rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white shadow-lg shadow-emerald-900/20">
                Simpan Pengaturan
            </button>
        </form>
    </section>
</x-app-layout>