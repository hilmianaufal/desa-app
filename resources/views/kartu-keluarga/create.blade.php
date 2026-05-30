<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Tambah Data</p>
            <h1 class="text-2xl font-black text-slate-900">Kartu Keluarga Baru</h1>
        </div>

        <form action="{{ route('kartu-keluarga.store') }}" method="POST" class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
            @csrf

            <div class="grid gap-4 md:grid-cols-2">
                <input name="no_kk" placeholder="Nomor KK" class="rounded-2xl border-slate-200" required>
                <input name="kepala_keluarga" placeholder="Nama Kepala Keluarga" class="rounded-2xl border-slate-200" required>

                <input name="dusun" placeholder="Dusun" class="rounded-2xl border-slate-200">
                <input name="blok" placeholder="Blok" class="rounded-2xl border-slate-200">

                <input name="rt" placeholder="RT" class="rounded-2xl border-slate-200">
                <input name="rw" placeholder="RW" class="rounded-2xl border-slate-200">
            </div>

            <textarea name="alamat" placeholder="Alamat Lengkap" class="mt-4 w-full rounded-2xl border-slate-200"></textarea>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('kartu-keluarga.index') }}" class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Batal
                </a>

                <button class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white shadow-lg shadow-emerald-900/20">
                    Simpan Data
                </button>
            </div>
        </form>
    </section>
</x-app-layout>