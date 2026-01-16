<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pembayaran</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: #333;
            background: #f5f6fa;
            padding: 20px;
        }

        .invoice-box {
            background: #fff;
            max-width: 800px;
            margin: auto;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,.08);
        }

        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .hotel-name {
            font-size: 22px;
            font-weight: bold;
            color: #0c4a6e;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h2 {
            margin: 0;
            color: #111827;
        }

        .status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
            margin-top: 5px;
        }

        .lunas {
            background: #dcfce7;
            color: #166534;
        }

        .belum {
            background: #fee2e2;
            color: #991b1b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background: #f1f5f9;
            text-align: left;
            padding: 10px;
            font-size: 12px;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .section-title {
            margin-top: 25px;
            font-weight: bold;
            color: #0f172a;
            font-size: 14px;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 15px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #64748b;
        }

        .btn-back {
            display: inline-block;
            margin-top: 25px;
            padding: 8px 18px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="invoice-box">

    <!-- HEADER -->
    <div class="header">
        <div>
            <div class="hotel-name">Novotel Karawang</div>
            <small>Jl. Internasional No. 1, Karawang</small>
        </div>

        <div class="invoice-title">
            <h2>INVOICE</h2>

            @if($reservasi->status_pembayaran === 'lunas')
                <span class="status lunas">LUNAS</span>
            @else
                <span class="status belum">BELUM LUNAS</span>
            @endif
        </div>
    </div>

    <!-- DATA TAMU -->
    <div class="section-title">Data Tamu</div>
    <table>
        <tr>
            <td width="30%">Nama Tamu</td>
            <td>: {{ $reservasi->tamu->nama }}</td>
        </tr>
        <tr>
            <td>No. Telepon</td>
            <td>: {{ $reservasi->tamu->telepon ?? '-' }}</td>
        </tr>
    </table>

    <!-- DATA RESERVASI -->
    <div class="section-title">Detail Reservasi</div>
    <table>
        <thead>
            <tr>
                <th>Kamar</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Metode Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $reservasi->kamar->nomor_kamar }}</td>
                <td>{{ \Carbon\Carbon::parse($reservasi->check_in)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($reservasi->check_out)->format('d M Y') }}</td>
                <td>{{ strtoupper($reservasi->metode_pembayaran ?? '-') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- TOTAL -->
    <div class="total">
        Total Pembayaran : Rp {{ number_format($reservasi->total_harga ?? 0, 0, ',', '.') }}
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Terima kasih telah menginap di Novotel Karawang<br>
        Invoice ini dicetak secara otomatis oleh sistem
    </div>

    <div style="text-align:center;">
       <a href="{{ url()->previous() }}" class="btn-back">← Kembali ke Reservasi</a>
    </div>

</div>

</body>
</html>
