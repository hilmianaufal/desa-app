<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Tambah Data</p>
            <h1 class="text-2xl font-black text-slate-900">Penduduk Baru</h1>
        </div>

        <form action="{{ route('penduduk.store') }}"  method="POST" class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5"  x-data="{
        selected: '',
        kks: @js($kartuKeluargas),
        get kk() {
            return this.kks.find(item => item.id == this.selected)
        }
        }"
        action="{{ route('penduduk.store') }}"
        method="POST"
        class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5">
            @csrf

            <div class="grid gap-4 md:grid-cols-2">
                <input name="nik" placeholder="NIK" class="rounded-2xl border-slate-200" required>
                <input name="no_kk" placeholder="Nomor KK" class="rounded-2xl border-slate-200">
                <input name="nama" placeholder="Nama Lengkap" class="rounded-2xl border-slate-200" required>

                <select name="jenis_kelamin" class="rounded-2xl border-slate-200" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>


                <select x-model="selected" name="kartu_keluarga_id" class="rounded-2xl border-slate-200">
                    <option value="">Pilih Kartu Keluarga</option>
                    @foreach ($kartuKeluargas as $kk)
                        <option value="{{ $kk->id }}">
                            {{ $kk->no_kk }} - {{ $kk->kepala_keluarga }}
                        </option>
                    @endforeach
                </select>

                <input name="tempat_lahir" placeholder="Tempat Lahir" class="rounded-2xl border-slate-200">
                <input type="date" name="tanggal_lahir" class="rounded-2xl border-slate-200">

                <input name="agama" placeholder="Agama" class="rounded-2xl border-slate-200">
                <input name="pendidikan" placeholder="Pendidikan" class="rounded-2xl border-slate-200">
                <input name="pekerjaan" placeholder="Pekerjaan" class="rounded-2xl border-slate-200">
                <input name="status_perkawinan" placeholder="Status Perkawinan" class="rounded-2xl border-slate-200">
                <input name="no_kk" :value="kk ? kk.no_kk : ''" placeholder="Nomor KK" class="rounded-2xl border-slate-200">

                <input name="dusun" :value="kk ? kk.dusun : ''" placeholder="Dusun" class="rounded-2xl border-slate-200">

                <input name="blok" :value="kk ? kk.blok : ''" placeholder="Blok" class="rounded-2xl border-slate-200">

                <input name="rt" :value="kk ? kk.rt : ''" placeholder="RT" class="rounded-2xl border-slate-200">

                <input name="rw" :value="kk ? kk.rw : ''" placeholder="RW" class="rounded-2xl border-slate-200">
            </div>

            <textarea name="alamat" placeholder="Alamat Lengkap" class="mt-4 w-full rounded-2xl border-slate-200" x-text="kk ? kk.alamat : ''"></textarea>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('penduduk.index') }}" class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Batal
                </a>

                <button class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white shadow-lg shadow-emerald-900/20">
                    Simpan Data
                </button>
            </div>
        </form>
    </section>
</x-app-layout>