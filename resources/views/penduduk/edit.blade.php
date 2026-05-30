<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Edit Data</p>
            <h1 class="text-2xl font-black text-slate-900">{{ $penduduk->nama }}</h1>
        </div>

        <form action="{{ route('penduduk.update', $penduduk) }}" method="POST" class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5" <form
            x-data="{
                selected: '{{ old('kartu_keluarga_id', $penduduk->kartu_keluarga_id) }}',
                kks: @js($kartuKeluargas),
                get kk() {
                    return this.kks.find(item => item.id == this.selected)
                }
            }"
            action="{{ route('penduduk.update', $penduduk) }}"
            method="POST"
            class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5"
        >>
            @csrf
            @method('PUT')

            <div class="grid gap-4 md:grid-cols-2">
                <input name="nik" value="{{ old('nik', $penduduk->nik) }}" class="rounded-2xl border-slate-200" required>
                <input name="no_kk" value="{{ old('no_kk', $penduduk->no_kk) }}" class="rounded-2xl border-slate-200">
                <input name="nama" value="{{ old('nama', $penduduk->nama) }}" class="rounded-2xl border-slate-200" required>

                <select name="jenis_kelamin" class="rounded-2xl border-slate-200" required>
                    <option value="Laki-laki" @selected(old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
                    <option value="Perempuan" @selected(old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Perempuan')>Perempuan</option>
                </select>
                <select x-model="selected" name="kartu_keluarga_id" class="rounded-2xl border-slate-200">
                    <option value="">Pilih Kartu Keluarga</option>
                    @foreach ($kartuKeluargas as $kk)
                        <option value="{{ $kk->id }}">
                            {{ $kk->no_kk }} - {{ $kk->kepala_keluarga }}
                        </option>
                    @endforeach
                </select>
                <input name="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" class="rounded-2xl border-slate-200">
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir) }}" class="rounded-2xl border-slate-200">

                <input name="agama" value="{{ old('agama', $penduduk->agama) }}" class="rounded-2xl border-slate-200">
                <input name="pendidikan" value="{{ old('pendidikan', $penduduk->pendidikan) }}" class="rounded-2xl border-slate-200">
                <input name="pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}" class="rounded-2xl border-slate-200">
                <input name="status_perkawinan" value="{{ old('status_perkawinan', $penduduk->status_perkawinan) }}" class="rounded-2xl border-slate-200">

                 <input name="no_kk" :value="kk ? kk.no_kk : '{{ old('no_kk', $penduduk->no_kk) }}'" class="rounded-2xl border-slate-200">

                <input name="dusun" :value="kk ? kk.dusun : '{{ old('dusun', $penduduk->dusun) }}'" class="rounded-2xl border-slate-200">

                <input name="blok" :value="kk ? kk.blok : '{{ old('blok', $penduduk->blok) }}'" class="rounded-2xl border-slate-200">

                <input name="rt" :value="kk ? kk.rt : '{{ old('rt', $penduduk->rt) }}'" class="rounded-2xl border-slate-200">

                <input name="rw" :value="kk ? kk.rw : '{{ old('rw', $penduduk->rw) }}'" class="rounded-2xl border-slate-200">

            </div>

            <textarea name="alamat" class="mt-4 w-full rounded-2xl border-slate-200" x-text="kk ? kk.alamat : '{{ old('alamat', $penduduk->alamat) }}'"></textarea>
            <div class="mt-6 flex gap-3">
                <a href="{{ route('penduduk.show', $penduduk) }}" class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Batal
                </a>

                <button class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white">
                    Update
                </button>
            </div>
        </form>

        <form action="{{ route('penduduk.destroy', $penduduk) }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')

            <button onclick="return confirm('Yakin ingin menghapus data ini?')"
                    class="w-full rounded-2xl bg-red-50 px-5 py-3 font-black text-red-600">
                Hapus Data
            </button>
        </form>
    </section>
</x-app-layout>