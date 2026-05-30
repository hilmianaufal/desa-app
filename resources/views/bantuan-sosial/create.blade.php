<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Tambah Data</p>
            <h1 class="text-2xl font-black text-slate-900">Bantuan Sosial Baru</h1>
        </div>

        <form action="{{ route('bantuan-sosial.store') }}" method="POST"
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

                <select name="jenis_bantuan" class="rounded-2xl border-slate-200" required>
                    <option value="">Pilih Jenis Bantuan</option>
                    <option>BLT Dana Desa</option>
                    <option>PKH</option>
                    <option>BPNT</option>
                    <option>Bantuan Beras</option>
                    <option>Bantuan UMKM</option>
                </select>

                <input name="periode" placeholder="Periode contoh: 2026 / Mei 2026"
                       class="rounded-2xl border-slate-200">

                <input type="number" name="nominal" placeholder="Nominal bantuan"
                       class="rounded-2xl border-slate-200">

                <select name="status" class="rounded-2xl border-slate-200" required>
                    <option value="Diajukan">Diajukan</option>
                    <option value="Diverifikasi">Diverifikasi</option>
                    <option value="Diterima">Diterima</option>
                    <option value="Ditolak">Ditolak</option>
                </select>

                <textarea name="keterangan" placeholder="Keterangan"
                          class="w-full rounded-2xl border-slate-200"></textarea>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('bantuan-sosial.index') }}"
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