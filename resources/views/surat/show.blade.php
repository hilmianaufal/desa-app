<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div class="rounded-[2rem] bg-gradient-to-br from-emerald-500 to-lime-400 p-6 text-white shadow-xl shadow-emerald-900/20">
            @if (session('success'))
                <div class="mb-5 rounded-2xl bg-emerald-100 px-4 py-3 text-sm font-bold text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif
            <p class="text-sm font-bold text-emerald-50">Detail Surat</p>
            <h1 class="mt-1 text-3xl font-black">{{ $surat->jenis_surat }}</h1>
            <p class="mt-2 text-sm font-semibold text-emerald-50">{{ $surat->nomor_surat }}</p>
        </div>

        <div class="mt-5 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ([
                    'Nomor Surat' => $surat->nomor_surat,
                    'Jenis Surat' => $surat->jenis_surat,
                    'Nama Pemohon' => $surat->penduduk?->nama,
                    'NIK' => $surat->penduduk?->nik,
                    'Tanggal Surat' => $surat->tanggal_surat,
                    'Status' => $surat->status,
                    'Keperluan' => $surat->keperluan,
                ] as $label => $value)
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-xs font-black uppercase text-slate-400">{{ $label }}</p>
                        <p class="mt-1 font-bold text-slate-800">{{ $value ?? '-' }}</p>
                    </div>
                @endforeach
            </div>
            <form action="{{ route('surat.update-status', $surat) }}" method="POST" class="mt-6 rounded-2xl bg-slate-50 p-4">
                @csrf
                @method('PATCH')

                <label class="text-xs font-black uppercase text-slate-400">Ubah Status Surat</label>

                <div class="mt-3 flex gap-3">
                    <select name="status" class="flex-1 rounded-2xl border-slate-200 font-bold">
                        <option value="Diajukan" @selected($surat->status == 'Diajukan')>Diajukan</option>
                        <option value="Diproses" @selected($surat->status == 'Diproses')>Diproses</option>
                        <option value="Selesai" @selected($surat->status == 'Selesai')>Selesai</option>
                        <option value="Ditolak" @selected($surat->status == 'Ditolak')>Ditolak</option>
                    </select>

                    <button class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white">
                        Update
                    </button>
                    <a href="{{ route('surat.cetak', $surat) }}" target="_blank"
                    class="rounded-2xl bg-slate-900 px-5 py-3 font-black text-white">
                        Cetak PDF
                    </a>

                    <form action="{{ route('surat.destroy', $surat) }}"
                        method="POST"
                        onsubmit="return confirm('Hapus surat ini?')">
                        @csrf
                        @method('DELETE')

                        <button class="rounded-xl bg-red-50 px-3 py-2 text-xs font-black text-red-700">
                            Hapus
                        </button>
                    </form>
                 </div>
            </form>
            <div class="mt-6 flex gap-3">
                <a href="{{ route('surat.index') }}" class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Kembali
                </a>
            </div>
        </div>
    </section>
</x-app-layout>