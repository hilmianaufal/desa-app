<x-app-layout>
    <section class="px-5 pt-6 md:px-0">
        <div>
            <p class="text-sm font-bold text-emerald-600">Tambah Data</p>
            <h1 class="text-2xl font-black text-slate-900">Penduduk Baru</h1>
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
            action="{{ route('penduduk.store') }}"
            method="POST"
            x-data="{
                selected: '',
                tanggal_lahir: '',
                umur: '',
                no_kk: '',
                dusun: '',
                blok: '',
                rt: '',
                rw: '',
                alamat: '',
                kks: @js($kartuKeluargas),

                get kk() {
                    return this.kks.find(item => item.id == this.selected)
                },

                syncKK() {
                    if (this.kk) {
                        this.no_kk = this.kk.no_kk ?? '';
                        this.dusun = this.kk.dusun ?? '';
                        this.blok = this.kk.blok ?? '';
                        this.rt = this.kk.rt ?? '';
                        this.rw = this.kk.rw ?? '';
                        this.alamat = this.kk.alamat ?? '';
                    } else {
                        this.no_kk = '';
                        this.dusun = '';
                        this.blok = '';
                        this.rt = '';
                        this.rw = '';
                        this.alamat = '';
                    }
                },

                hitungUmur() {
                    if (!this.tanggal_lahir) {
                        this.umur = '';
                        return;
                    }

                    const lahir = new Date(this.tanggal_lahir);
                    const hariIni = new Date();

                    let usia = hariIni.getFullYear() - lahir.getFullYear();
                    const bulan = hariIni.getMonth() - lahir.getMonth();

                    if (bulan < 0 || (bulan === 0 && hariIni.getDate() < lahir.getDate())) {
                        usia--;
                    }

                    this.umur = usia >= 0 ? usia : '';
                }
            }"
            class="mt-6 rounded-[2rem] bg-white p-5 shadow-xl shadow-emerald-900/5"
        >
            @csrf

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-sm font-black text-slate-700">NIK</label>
                    <input
                        name="nik"
                        value="{{ old('nik') }}"
                        placeholder="NIK"
                        class="mt-2 w-full rounded-2xl border-slate-200"
                        required>
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Nama Lengkap</label>
                    <input
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Nama Lengkap"
                        class="mt-2 w-full rounded-2xl border-slate-200"
                        required>
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="mt-2 w-full rounded-2xl border-slate-200" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Kartu Keluarga</label>
                    <select
                        x-model="selected"
                        @change="syncKK()"
                        name="kartu_keluarga_id"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                        <option value="">Pilih Kartu Keluarga</option>
                        @foreach ($kartuKeluargas as $kk)
                            <option value="{{ $kk->id }}">
                                {{ $kk->no_kk }} - {{ $kk->kepala_keluarga }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Nomor KK</label>
                    <input
                        name="no_kk"
                        x-model="no_kk"
                        placeholder="Nomor KK"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Tempat Lahir</label>
                    <input
                        name="tempat_lahir"
                        value="{{ old('tempat_lahir') }}"
                        placeholder="Tempat Lahir"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Tanggal Lahir</label>
                    <input
                        type="date"
                        name="tanggal_lahir"
                        x-model="tanggal_lahir"
                        @change="hitungUmur()"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Umur</label>
                    <input
                        type="number"
                        name="umur"
                        x-model="umur"
                        readonly
                        placeholder="Otomatis"
                        class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-100 text-slate-600">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Agama</label>
                    <input
                        name="agama"
                        value="{{ old('agama') }}"
                        placeholder="Agama"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Pendidikan</label>
                    <input
                        name="pendidikan"
                        value="{{ old('pendidikan') }}"
                        placeholder="Pendidikan"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Pekerjaan</label>
                    <input
                        name="pekerjaan"
                        value="{{ old('pekerjaan') }}"
                        placeholder="Pekerjaan"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Status Perkawinan</label>
                    <input
                        name="status_perkawinan"
                        value="{{ old('status_perkawinan') }}"
                        placeholder="Status Perkawinan"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Dusun</label>
                    <input
                        name="dusun"
                        x-model="dusun"
                        placeholder="Dusun"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">Blok</label>
                    <input
                        name="blok"
                        x-model="blok"
                        placeholder="Blok"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">RT</label>
                    <input
                        name="rt"
                        x-model="rt"
                        placeholder="RT"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>

                <div>
                    <label class="text-sm font-black text-slate-700">RW</label>
                    <input
                        name="rw"
                        x-model="rw"
                        placeholder="RW"
                        class="mt-2 w-full rounded-2xl border-slate-200">
                </div>
            </div>

            <div class="mt-4">
                <label class="text-sm font-black text-slate-700">Alamat Lengkap</label>
                <textarea
                    name="alamat"
                    x-model="alamat"
                    placeholder="Alamat Lengkap"
                    class="mt-2 w-full rounded-2xl border-slate-200"></textarea>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('penduduk.index') }}"
                   class="rounded-2xl bg-slate-100 px-5 py-3 font-black text-slate-600">
                    Batal
                </a>

                <button class="rounded-2xl bg-emerald-600 px-5 py-3 font-black text-white shadow-lg shadow-emerald-900/20">
                    Simpan Data
                </button>
            </div>
        </form>
    </section>
</x-app-layout>