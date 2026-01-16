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

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        table th {
            background: #f1f5f9;
            text-align: left;
            font-size: 12px;
        }

        .section-title {
            margin-top: 25px;
            font-weight: bold;
            color: #0f172a;
            font-size: 14px;
        }

        .right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #64748b;
        }
    </style>
</head>
<body>

@php
    // ===== HITUNGAN REAL HOTEL =====
    $subtotal = $reservasi->total_harga ?? 0;
    $denda = $reservasi->denda ?? 0;

    $pajak = $subtotal * 0.10;        // Pajak 10%
    $service = $subtotal * 0.05;      // Service charge 5%

    $grandTotal = $subtotal + $pajak + $service + $denda;
@endphp

<div class="invoice-box">

    <!-- HEADER -->
    <div class="header">
        <div>
            <div class="hotel-name">Novotel Karawang</div>
            <small>
                Jl Interchange Karawang Barat<br>
                Karawang, Jawa Barat
            </small>
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
            <td>{{ $reservasi->tamu->nama }}</td>
        </tr>
        <tr>
            <td>No. Telepon</td>
            <td>{{ $reservasi->tamu->telepon ?? '-' }}</td>
        </tr>
    </table>

    <!-- DETAIL RESERVASI -->
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

    <!-- RINCIAN PEMBAYARAN -->
    <div class="section-title">Rincian Pembayaran</div>
    <table>
        <tr>
            <td>Subtotal Kamar</td>
            <td class="right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Pajak (10%)</td>
            <td class="right">Rp {{ number_format($pajak, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Service Charge (5%)</td>
            <td class="right">Rp {{ number_format($service, 0, ',', '.') }}</td>
        </tr>

        @if($denda > 0)
        <tr>
            <td>Denda Overstay</td>
            <td class="right">Rp {{ number_format($denda, 0, ',', '.') }}</td>
        </tr>
        @endif

        <tr>
            <th>Total Akhir</th>
            <th class="right">
                Rp {{ number_format($grandTotal, 0, ',', '.') }}
            </th>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Terima kasih telah menginap di Novotel Karawang<br>
        Dicetak pada {{ now()->format('d M Y H:i') }}
    </div>

</div>

</body>
</html>
