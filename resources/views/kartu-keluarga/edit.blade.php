<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Edit Data</p>
            <h1 class="text-2xl font-black text-slate-900">{{ $kartuKeluarga->kepala_keluarga }}</h1>
        </div>

        <form action="{{ route('kartu-keluarga.update', $kartuKeluarga) }}" method="POST" class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
            @csrf
            @method('PUT')

            <div class="grid gap-4 md:grid-cols-2">
                <input name="no_kk" value="{{ old('no_kk', $kartuKeluarga->no_kk) }}" class="rounded-2xl border-slate-200" required>
                <input name="kepala_keluarga" value="{{ old('kepala_keluarga', $kartuKeluarga->kepala_keluarga) }}" class="rounded-2xl border-slate-200" required>

                <input name="dusun" value="{{ old('dusun', $kartuKeluarga->dusun) }}" class="rounded-2xl border-slate-200">
                <input name="blok" value="{{ old('blok', $kartuKeluarga->blok) }}" class="rounded-2xl border-slate-200">

                <input name="rt" value="{{ old('rt', $kartuKeluarga->rt) }}" class="rounded-2xl border-slate-200">
                <input name="rw" value="{{ old('rw', $kartuKeluarga->rw) }}" class="rounded-2xl border-slate-200">
            </div>

            <textarea name="alamat" class="mt-4 w-full rounded-2xl border-slate-200">{{ old('alamat', $kartuKeluarga->alamat) }}</textarea>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('kartu-keluarga.show', $kartuKeluarga) }}" class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Batal
                </a>

                <button class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white">
                    Update
                </button>
            </div>
        </form>

        <form action="{{ route('kartu-keluarga.destroy', $kartuKeluarga) }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')

            <button onclick="return confirm('Yakin ingin menghapus data KK ini?')"
                    class="w-full rounded-2xl bg-red-50 px-5 py-3 font-black text-red-600">
                Hapus Data
            </button>
        </form>
    </section>
</x-app-layout>