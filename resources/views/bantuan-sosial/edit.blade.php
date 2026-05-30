<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Edit Data</p>
            <h1 class="text-2xl font-black text-slate-900">Bantuan Sosial</h1>
        </div>

        <form action="{{ route('bantuan-sosial.update', $bantuanSosial) }}" method="POST"
              class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
            @csrf
            @method('PUT')

            <div class="grid gap-4">
                <select name="penduduk_id" class="rounded-2xl border-slate-200" required>
                    @foreach ($penduduks as $penduduk)
                        <option value="{{ $penduduk->id }}" @selected(old('penduduk_id', $bantuanSosial->penduduk_id) == $penduduk->id)>
                            {{ $penduduk->nik }} - {{ $penduduk->nama }}
                        </option>
                    @endforeach
                </select>

                <select name="jenis_bantuan" class="rounded-2xl border-slate-200" required>
                    @foreach (['BLT Dana Desa', 'PKH', 'BPNT', 'Bantuan Beras', 'Bantuan UMKM'] as $jenis)
                        <option value="{{ $jenis }}" @selected(old('jenis_bantuan', $bantuanSosial->jenis_bantuan) == $jenis)>
                            {{ $jenis }}
                        </option>
                    @endforeach
                </select>

                <input name="periode" value="{{ old('periode', $bantuanSosial->periode) }}"
                       class="rounded-2xl border-slate-200">

                <input type="number" name="nominal" value="{{ old('nominal', $bantuanSosial->nominal) }}"
                       class="rounded-2xl border-slate-200">

                <select name="status" class="rounded-2xl border-slate-200" required>
                    @foreach (['Diajukan', 'Diverifikasi', 'Diterima', 'Ditolak'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $bantuanSosial->status) == $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>

                <textarea name="keterangan"
                          class="w-full rounded-2xl border-slate-200">{{ old('keterangan', $bantuanSosial->keterangan) }}</textarea>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('bantuan-sosial.show', $bantuanSosial) }}"
                   class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Batal
                </a>

                <button class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white">
                    Update
                </button>
            </div>
        </form>

        <form action="{{ route('bantuan-sosial.destroy', $bantuanSosial) }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')

            <button onclick="return confirm('Yakin ingin menghapus data bantuan ini?')"
                    class="w-full rounded-2xl bg-red-50 px-5 py-3 font-black text-red-600">
                Hapus Data
            </button>
        </form>
    </section>
</x-app-layout>