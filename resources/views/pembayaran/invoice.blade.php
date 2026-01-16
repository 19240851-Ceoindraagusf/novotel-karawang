<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pembayaran</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .box {
            border: 1px solid #000;
            padding: 15px;
        }
        table {
            width: 100%;
        }
        td {
            padding: 6px;
        }
        .right {
            text-align: right;
        }
        .total {
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>INVOICE PEMBAYARAN</h2>
    <p>Hotel Novotel Karawang</p>
</div>

<div class="box">
    <table>
        <tr>
            <td>Nama Tamu</td>
            <td>: {{ $reservasi->tamu->nama }}</td>
        </tr>
        <tr>
            <td>Kamar</td>
            <td>: {{ $reservasi->kamar->nomor_kamar }}</td>
        </tr>
        <tr>
            <td>Check In</td>
            <td>: {{ $reservasi->check_in }}</td>
        </tr>
        <tr>
            <td>Check Out</td>
            <td>: {{ $reservasi->check_out }}</td>
        </tr>
        <tr>
            <td>Metode Pembayaran</td>
            <td>: {{ ucfirst($reservasi->metode_pembayaran) }}</td>
        </tr>
        <tr>
            <td>Status Pembayaran</td>
            <td>: {{ ucfirst($reservasi->status_pembayaran) }}</td>
        </tr>
    </table>

    <hr>

    <table>
        <tr>
       <div class="total">
    Total Pembayaran : Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}
</div>


        </tr>
    </table>
</div>

<p style="margin-top:20px;">
    Dicetak pada: {{ now()->format('d-m-Y H:i') }}
</p>

</body>
</html>
