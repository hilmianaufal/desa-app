<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Edit Data</p>
            <h1 class="text-2xl font-black text-slate-900">
                {{ $kartuKeluarga->kepala_keluarga }}
            </h1>
        </div>

        @if ($errors->any())
            <div class="mt-5 rounded-2xl bg-red-50 px-4 py-3 text-sm font-bold text-red-600">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('kartu-keluarga.update', $kartuKeluarga) }}"
            method="POST"
            class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5"
        >
            @csrf
            @method('PUT')

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-sm font-black text-slate-700">Nomor KK</label>
                    <input
                        name="no_kk"
                        value="{{ old('no_kk', $kartuKeluarga->no_kk) }}"
                        placeholder="Nomor KK"
                        class="mt-2 w-full rounded-2xl border-slate-200"
                        required>
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Kepala Keluarga</label>
                    <input
                        name="kepala_keluarga"
                        value="{{ old('kepala_keluarga', $kartuKeluarga->kepala_keluarga) }}"
                        placeholder="Nama Kepala Keluarga"
                        class="mt-2 w-full rounded-2xl border-slate-200"
                        required>
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Dusun</label>
                    <input
                        name="dusun"
                        value="{{ old('dusun', $kartuKeluarga->dusun) }}"
                        placeholder="Dusun"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Blok</label>
                    <input
                        name="blok"
                        value="{{ old('blok', $kartuKeluarga->blok) }}"
                        placeholder="Blok"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">RT</label>
                    <input
                        name="rt"
                        value="{{ old('rt', $kartuKeluarga->rt) }}"
                        placeholder="RT"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">RW</label>
                    <input
                        name="rw"
                        value="{{ old('rw', $kartuKeluarga->rw) }}"
                        placeholder="RW"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Status</label>
                    <select
                        name="status"
                        class="mt-2 w-full rounded-2xl border-slate-200"
                    >
                        <option value="Aktif" @selected(old('status', $kartuKeluarga->status) == 'Aktif')>
                            Aktif
                        </option>
                        <option value="Pindah" @selected(old('status', $kartuKeluarga->status) == 'Pindah')>
                            Pindah
                        </option>
                        <option value="Tidak Aktif" @selected(old('status', $kartuKeluarga->status) == 'Tidak Aktif')>
                            Tidak Aktif
                        </option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <label class="text-sm font-black text-slate-700">Alamat Lengkap</label>
                <textarea
                    name="alamat"
                    placeholder="Alamat Lengkap"
                    class="mt-2 w-full rounded-2xl border-slate-200"
                >{{ old('alamat', $kartuKeluarga->alamat) }}</textarea>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('kartu-keluarga.show', $kartuKeluarga) }}"
                   class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white shadow-lg shadow-emerald-900/20">
                    Update
                </button>
            </div>
        </form>

        <form
            action="{{ route('kartu-keluarga.destroy', $kartuKeluarga) }}"
            method="POST"
            class="mt-4"
            onsubmit="return confirm('Yakin ingin menghapus data KK ini? Data anggota penduduk tidak ikut terhapus, hanya relasi KK yang akan kosong jika database memakai nullOnDelete.')"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="w-full rounded-2xl bg-red-50 px-5 py-3 font-black text-red-600 transition hover:bg-red-600 hover:text-white">
                Hapus Data KK
            </button>
        </form>
    </section>
</x-app-layout>