<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Mutasi Penduduk</title>

    <style>
        @page { margin: 28px 32px; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #0f172a;
        }

        .header {
            border-bottom: 4px solid #f97316;
            padding-bottom: 14px;
            margin-bottom: 18px;
        }

        .brand {
            font-size: 11px;
            color: #ea580c;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .title {
            margin: 4px 0 0;
            font-size: 22px;
            font-weight: bold;
            color: #7c2d12;
        }

        .subtitle {
            margin-top: 4px;
            color: #64748b;
        }

        .summary {
            width: 100%;
            margin: 18px 0;
            border-spacing: 8px;
        }

        .summary td {
            background: #fff7ed;
            border: 1px solid #fed7aa;
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
            color: #ea580c;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th {
            background: #7c2d12;
            color: white;
            padding: 9px 7px;
            font-size: 9px;
            text-align: left;
            text-transform: uppercase;
        }

        table.data td {
            border-bottom: 1px solid #e2e8f0;
            padding: 8px 7px;
            vertical-align: top;
        }

        table.data tr:nth-child(even) {
            background: #f8fafc;
        }

        .badge {
            padding: 3px 8px;
            font-size: 9px;
            font-weight: bold;
            border-radius: 999px;
            background: #ffedd5;
            color: #c2410c;
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

        .footer-left { float: left; }
        .footer-right { float: right; }
    </style>
</head>

<body>
    <div class="header">
        <div class="brand">Aplikasi Manajemen Data Desa</div>
        <h1 class="title">Laporan Mutasi Penduduk</h1>
        <div class="subtitle">Rekapitulasi data kelahiran, kematian, datang, dan pindah penduduk.</div>
        <div class="subtitle">Dicetak pada: {{ now()->format('d-m-Y H:i') }}</div>
    </div>

    <table class="summary">
        <tr>
            <td>
                <div class="summary-label">Total Mutasi</div>
                <div class="summary-value">{{ $mutasis->count() }}</div>
            </td>
            <td>
                <div class="summary-label">Lahir</div>
                <div class="summary-value">{{ $mutasis->where('jenis_mutasi', 'Lahir')->count() }}</div>
            </td>
            <td>
                <div class="summary-label">Datang</div>
                <div class="summary-value">{{ $mutasis->where('jenis_mutasi', 'Datang')->count() }}</div>
            </td>
            <td>
                <div class="summary-label">Pindah</div>
                <div class="summary-value">{{ $mutasis->where('jenis_mutasi', 'Pindah')->count() }}</div>
            </td>
            <td>
                <div class="summary-label">Meninggal</div>
                <div class="summary-value">{{ $mutasis->where('jenis_mutasi', 'Meninggal')->count() }}</div>
            </td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Mutasi</th>
                <th>Tanggal</th>
                <th>Status Penduduk</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($mutasis as $mutasi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $mutasi->penduduk?->nama ?? '-' }}</strong></td>
                    <td>{{ $mutasi->penduduk?->nik ?? '-' }}</td>
                    <td><span class="badge">{{ $mutasi->jenis_mutasi }}</span></td>
                    <td>{{ $mutasi->tanggal_mutasi }}</td>
                    <td>{{ $mutasi->penduduk?->status ?? '-' }}</td>
                    <td>{{ $mutasi->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div class="footer-left">Laporan Mutasi Penduduk Desa</div>
        <div class="footer-right">Generated by Desa Digital</div>
    </div>
</body>
</html>