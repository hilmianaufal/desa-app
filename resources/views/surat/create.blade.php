<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Buat Surat</p>
            <h1 class="text-2xl font-black text-slate-900">Pengajuan Surat Baru</h1>
        </div>

        <form action="{{ route('surat.store') }}" method="POST" class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
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

                <select name="jenis_surat" class="rounded-2xl border-slate-200" required>
                    <option value="">Pilih Jenis Surat</option>
                    <option>Surat Keterangan Domisili</option>
                    <option>Surat Keterangan Tidak Mampu</option>
                    <option>Surat Keterangan Usaha</option>
                    <option>Surat Pengantar KTP</option>
                    <option>Surat Keterangan Kelahiran</option>
                    <option>Surat Keterangan Kematian</option>
                </select>

                <textarea name="keperluan" placeholder="Keperluan surat" class="w-full rounded-2xl border-slate-200"></textarea>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('surat.index') }}" class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Batal
                </a>

                <button class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white">
                    Simpan
                </button>
            </div>
        </form>
    </section>
</x-app-layout>