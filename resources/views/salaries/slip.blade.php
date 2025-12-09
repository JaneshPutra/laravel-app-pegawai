<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji {{ \Carbon\Carbon::parse($salary->periode)->format('F Y') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
            color: #2d3748;
        }
        .container {
            width: 100%;
            max-width: 780px;
            margin: 30px auto;
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 40px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
        }
        .header p {
            margin: 8px 0 0;
            font-size: 17px;
            opacity: 0.95;
        }
        .content {
            padding: 40px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
        }
        .info-row div {
            font-size: 16px;
        }
        .info-row strong {
            color: #667eea;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            font-size: 18px;
        }
        td {
            padding: 14px 0;
            border-bottom: 1px dashed #cbd5e0;
        }
        .label {
            width: 55%;
            color: #718096;
            font-weight: 500;
        }
        .value {
            text-align: right;
            font-weight: 600;
        }
        .total-row td {
            padding: 22px 0;
            border-bottom: none;
            font-size: 24px;
            font-weight: 700;
        }
        .total-row .label {
            color: #2d3748;
        }
        .total-row .value {
            color: #667eea;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #a0aec0;
            font-size: 13px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        @page { margin: 20px; }
        @media print {
            body { background: white; }
            .container { box-shadow: none; margin: 0; }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>Slip Gaji Bulanan</h1>
        <p>{{ \Carbon\Carbon::parse($salary->periode)->format('F Y') }}</p>
    </div>

    <div class="content">

        <!-- Nama & Periode -->
        <div class="info-row">
            <div><strong>{{ $salary->employee->nama_lengkap }}</strong></div>
            <div>Jabatan: {{ $salary->employee->jabatan->nama_jabatan ?? '-' }}</div>
        </div>

        <!-- Tabel Gaji -->
        <table>
            <tr>
                <td class="label">Gaji Pokok</td>
                <td class="value">Rp{{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Tunjangan / Bonus</td>
                <td class="value" style="color:#38a169;">
                    + Rp{{ number_format($salary->tunjangan, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td class="label">Potongan</td>
                <td class="value" style="color:#e53e3e;">
                    - Rp{{ number_format($salary->potongan, 0, ',', '.') }}
                </td>
            </tr>

            <!-- Total -->
            <tr class="total-row">
                <td class="label">Total Gaji Bersih</td>
                <td class="value">Rp{{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>{{ $salary->created_at->format('d F Y, H:i') }} WIB</p>
        </div>
    </div>
</div>

</body>
</html>