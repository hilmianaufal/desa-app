<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penduduk</title>

    <style>
        @page {
            margin: 28px 32px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #0f172a;
            background: #ffffff;
        }

        .header {
            border-bottom: 4px solid #10b981;
            padding-bottom: 14px;
            margin-bottom: 18px;
        }

        .brand {
            font-size: 11px;
            color: #059669;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .title {
            margin: 4px 0 0;
            font-size: 22px;
            font-weight: bold;
            color: #064e3b;
        }

        .subtitle {
            margin-top: 4px;
            color: #64748b;
        }

        .meta {
            margin-top: 10px;
            font-size: 10px;
            color: #475569;
        }

        .summary {
            width: 100%;
            margin: 18px 0;
            border-spacing: 8px;
        }

        .summary td {
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 12px;
        }

        .summary-label {
            font-size: 9px;
            color: #64748b;
            font-weight: bold;
            text-transform: uppercase;
        }

        .summary-value {
            margin-top: 4px;
            font-size: 18px;
            font-weight: bold;
            color: #047857;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table.data thead th {
            background: #064e3b;
            color: #ffffff;
            padding: 9px 7px;
            font-size: 9px;
            text-transform: uppercase;
            text-align: left;
        }

        table.data tbody td {
            border-bottom: 1px solid #e2e8f0;
            padding: 8px 7px;
            vertical-align: top;
        }

        table.data tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 999px;
            background: #dcfce7;
            color: #047857;
            font-size: 9px;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: -10px;
            left: 0;
            right: 0;
            font-size: 9px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
        }

        .footer-left {
            float: left;
        }

        .footer-right {
            float: right;
        }
    </style>
</head>

<body>
    <div class="header">
        @if (!empty($filter))
            <div style="margin: 10px 0 15px; padding: 10px; background: #ecfdf5; border: 1px solid #bbf7d0;">
                <strong>Filter Wilayah:</strong>
                Dusun: {{ $filter['dusun'] ?? 'Semua' }} |
                RW: {{ $filter['rw'] ?? 'Semua' }} |
                RT: {{ $filter['rt'] ?? 'Semua' }} |
                Blok: {{ $filter['blok'] ?? 'Semua' }}
            </div>
        @endif
        <div class="brand">Aplikasi Manajemen Data Desa</div>
        <h1 class="title">Laporan Data Penduduk</h1>
        <div class="subtitle">
            Rekapitulasi data penduduk berdasarkan database administrasi desa.
        </div>

        <div class="meta">
            Dicetak pada: {{ now()->format('d-m-Y H:i') }}
        </div>
    </div>

    <table class="summary">
        <tr>
            <td>
                <div class="summary-label">Total Penduduk</div>
                <div class="summary-value">{{ $penduduks->count() }}</div>
            </td>
            <td>
                <div class="summary-label">Laki-laki</div>
                <div class="summary-value">{{ $penduduks->where('jenis_kelamin', 'Laki-laki')->count() }}</div>
            </td>
            <td>
                <div class="summary-label">Perempuan</div>
                <div class="summary-value">{{ $penduduks->where('jenis_kelamin', 'Perempuan')->count() }}</div>
            </td>
            <td>
                <div class="summary-label">Aktif</div>
                <div class="summary-value">{{ $penduduks->where('status', 'Aktif')->count() }}</div>
            </td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="15%">NIK</th>
                <th width="18%">Nama</th>
                <th width="10%">JK</th>
                <th width="12%">Dusun</th>
                <th width="7%">RT</th>
                <th width="7%">RW</th>
                <th width="14%">Pekerjaan</th>
                <th width="13%">Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($penduduks as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nik }}</td>
                    <td><strong>{{ $item->nama }}</strong></td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->dusun ?? '-' }}</td>
                    <td>{{ $item->rt ?? '-' }}</td>
                    <td>{{ $item->rw ?? '-' }}</td>
                    <td>{{ $item->pekerjaan ?? '-' }}</td>
                    <td>
                        <span class="badge">{{ $item->status }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div class="footer-left">
            Laporan Penduduk Desa
        </div>
        <div class="footer-right">
            Generated by Desa Digital
        </div>
    </div>
</body>
</html>