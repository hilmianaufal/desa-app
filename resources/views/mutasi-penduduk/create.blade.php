<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Tambah Data</p>
            <h1 class="text-2xl font-black text-slate-900">Mutasi Penduduk Baru</h1>
        </div>

        <form action="{{ route('mutasi-penduduk.store') }}" method="POST"
              class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
            @csrf

            <div class="grid gap-4">
                <select name="penduduk_id" class="rounded-2xl border-slate-200" required>
                    <option value="">Pilih Penduduk</option>
                    @foreach ($penduduks as $penduduk)
                        <option value="{{ $penduduk->id }}">
                            {{ $penduduk->nik }} - {{ $penduduk->nama }}
                        </option>
                    @endforeach
                </select>

                <select name="jenis_mutasi" class="rounded-2xl border-slate-200" required>
                    <option value="">Pilih Jenis Mutasi</option>
                    <option value="Lahir">Lahir</option>
                    <option value="Meninggal">Meninggal</option>
                    <option value="Datang">Datang</option>
                    <option value="Pindah">Pindah</option>
                </select>

                <input type="date" name="tanggal_mutasi" class="rounded-2xl border-slate-200" required>

                <textarea name="keterangan" placeholder="Keterangan"
                          class="w-full rounded-2xl border-slate-200"></textarea>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('mutasi-penduduk.index') }}"
                   class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Batal
                </a>

                <button class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white">
                    Simpan
                </button>
            </div>
        </form>
    </section>
</x-app-layout>