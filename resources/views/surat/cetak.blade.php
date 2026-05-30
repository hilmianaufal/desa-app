<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $surat->nomor_surat }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111827;
            line-height: 1.7;
        }

        .kop {
            border-bottom: 3px solid #111827;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .kop table {
            width: 100%;
        }

        .kop h2,
        .kop h3,
        .kop p {
            margin: 0;
        }

        .kop h2 {
            font-size: 20px;
        }

        .kop h3 {
            font-size: 14px;
        }

        .judul {
            text-align: center;
            margin-bottom: 25px;
        }

        .judul h3 {
            margin-bottom: 5px;
            text-decoration: underline;
            text-transform: uppercase;
        }

        table.data {
            width: 100%;
            margin: 15px 0;
        }

        table.data td {
            padding: 4px;
            vertical-align: top;
        }

        .isi {
            text-align: justify;
            margin-top: 10px;
        }

        .ttd {
            margin-top: 60px;
            width: 100%;
        }

        .kanan {
            float: right;
            width: 260px;
            text-align: center;
        }

        .ttd-img {
            height: 80px;
            object-fit: contain;
        }
    </style>
</head>

<body>

    {{-- KOP SURAT --}}
    <div class="kop">
        <table>
            <tr>
                <td width="90" align="center">
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" width="75">
                @endif      
                </td>

                <td align="center">
                    <h3>PEMERINTAH {{ strtoupper($setting->kabupaten ?? 'KABUPATEN') }}</h3>
                    <h3>KECAMATAN {{ strtoupper($setting->kecamatan ?? '-') }}</h3>
                    <h2>DESA {{ strtoupper($setting->nama_desa ?? '-') }}</h2>

                    <p>
                        {{ $setting->alamat ?? '-' }}
                    </p>

                    <p>
                        @if($setting->telepon)
                            Telp. {{ $setting->telepon }}
                        @endif

                        @if($setting->email)
                            | {{ $setting->email }}
                        @endif

                        @if($setting->website)
                            | {{ $setting->website }}
                        @endif
                    </p>
                </td>
            </tr>
        </table>
    </div>

    {{-- JUDUL --}}
    <div class="judul">
        <h3>{{ $surat->jenis_surat }}</h3>
        <p>Nomor : {{ $surat->nomor_surat }}</p>
    </div>

    <p>
        Yang bertanda tangan di bawah ini Kepala Desa
        {{ $setting->nama_desa ?? '-' }},
        Kecamatan {{ $setting->kecamatan ?? '-' }},
        Kabupaten {{ $setting->kabupaten ?? '-' }},
        menerangkan bahwa:
    </p>

    {{-- DATA PENDUDUK --}}
    <table class="data">
        <tr>
            <td width="180">Nama</td>
            <td width="10">:</td>
            <td>{{ $surat->penduduk?->nama }}</td>
        </tr>

        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $surat->penduduk?->nik }}</td>
        </tr>

        <tr>
            <td>Tempat / Tanggal Lahir</td>
            <td>:</td>
            <td>
                {{ $surat->penduduk?->tempat_lahir }},
                {{ $surat->penduduk?->tanggal_lahir }}
            </td>
        </tr>

        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $surat->penduduk?->jenis_kelamin }}</td>
        </tr>

        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $surat->penduduk?->pekerjaan }}</td>
        </tr>

        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>
                {{ $surat->penduduk?->alamat }}

                @if($surat->penduduk?->rt || $surat->penduduk?->rw)
                    RT {{ $surat->penduduk?->rt }}
                    RW {{ $surat->penduduk?->rw }}
                @endif

                @if($surat->penduduk?->dusun)
                    Dusun {{ $surat->penduduk?->dusun }}
                @endif
            </td>
        </tr>
    </table>

    {{-- ISI SURAT DINAMIS --}}
    @if ($surat->jenis_surat == 'Surat Keterangan Domisili')

        <p class="isi">
            Berdasarkan data administrasi kependudukan yang ada pada Pemerintah Desa
            {{ $setting->nama_desa }},
            bahwa nama tersebut benar merupakan warga yang berdomisili di wilayah Desa
            {{ $setting->nama_desa }}.
        </p>

    @elseif ($surat->jenis_surat == 'Surat Keterangan Tidak Mampu')

        <p class="isi">
            Berdasarkan hasil pendataan dan keterangan yang ada pada Pemerintah Desa
            {{ $setting->nama_desa }},
            bahwa yang bersangkutan termasuk warga yang memerlukan bantuan sosial
            dan keringanan administrasi sesuai kebutuhan.
        </p>

    @elseif ($surat->jenis_surat == 'Surat Keterangan Usaha')

        <p class="isi">
            Berdasarkan data yang dimiliki Pemerintah Desa
            {{ $setting->nama_desa }},
            bahwa yang bersangkutan benar memiliki usaha yang berlokasi di wilayah desa.
        </p>

    @elseif ($surat->jenis_surat == 'Surat Pengantar KTP')

        <p class="isi">
            Surat ini digunakan sebagai pengantar administrasi dalam pengurusan
            Kartu Tanda Penduduk (KTP).
        </p>

    @elseif ($surat->jenis_surat == 'Surat Keterangan Kelahiran')

        <p class="isi">
            Surat ini dibuat sebagai dasar administrasi pencatatan kelahiran
            sesuai data yang tersedia pada Pemerintah Desa.
        </p>

    @elseif ($surat->jenis_surat == 'Surat Keterangan Kematian')

        <p class="isi">
            Surat ini dibuat sebagai dasar administrasi pencatatan kematian
            sesuai data yang tersedia pada Pemerintah Desa.
        </p>

    @else

        <p class="isi">
            Yang bersangkutan benar merupakan warga Desa
            {{ $setting->nama_desa }}.
        </p>

    @endif

    <p class="isi">
        Surat ini dibuat untuk keperluan:

        <strong>
            {{ $surat->keperluan ?? '-' }}
        </strong>
    </p>

    <p class="isi">
        Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan
        sebagaimana mestinya.
    </p>

    {{-- TTD --}}
    <div class="ttd">
        <div class="kanan">

            <p>
                {{ $setting->nama_desa ?? 'Desa' }},
                {{ now()->translatedFormat('d F Y') }}
            </p>

            <p>
                Kepala Desa {{ $setting->nama_desa ?? '' }}
            </p>

            @if($setting->ttd_kepala_desa)
                <br>

                <img
                    src="{{ public_path($setting->ttd_kepala_desa) }}"
                    class="ttd-img">

                <br>
            @else
                <br><br><br><br>
            @endif

            <strong>
                {{ $setting->nama_kepala_desa ?? '____________________' }}
            </strong>

            @if($setting->nip_kepala_desa)
                <br>
                NIP. {{ $setting->nip_kepala_desa }}
            @endif

        </div>
    </div>

</body>
</html>