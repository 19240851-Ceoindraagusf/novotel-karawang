<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pembayaran</title>

    <style>
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            font-size: 12px;
            color: #1f2937;
            background: #e5e7eb;
            padding: 30px;
        }

        .invoice-wrapper {
            max-width: 820px;
            margin: auto;
            background: #ffffff;
            padding: 35px;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 15px;
        }

        .hotel-info h1 {
            font-size: 20px;
            margin: 0;
            letter-spacing: 1px;
        }

        .hotel-info small {
            color: #6b7280;
            line-height: 1.4;
        }

        .invoice-info {
            text-align: right;
        }

        .invoice-info h2 {
            margin: 0;
            font-size: 18px;
            letter-spacing: 2px;
        }

        .status {
            display: inline-block;
            margin-top: 6px;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 11px;
        }

        .paid {
            background: #dcfce7;
            color: #166534;
        }

        .unpaid {
            background: #fee2e2;
            color: #991b1b;
        }

        /* SECTION */
        .section {
            margin-top: 25px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-size: 12px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 8px 6px;
        }

        th {
            text-align: left;
            background: #f9fafb;
            font-size: 11px;
            text-transform: uppercase;
            color: #374151;
        }

        /* SUMMARY */
        .summary {
            margin-top: 10px;
            width: 100%;
        }

        .summary td {
            padding: 6px;
        }

        .summary .label {
            color: #6b7280;
        }

        .summary .value {
            text-align: right;
        }

        .summary .grand-total {
            font-weight: bold;
            font-size: 14px;
            border-top: 2px solid #111827;
        }

        /* FOOTER */
        .footer {
            margin-top: 35px;
            text-align: center;
            font-size: 11px;
            color: #6b7280;
        }

        /* BUTTON */
        .actions {
            text-align: center;
            margin-top: 30px;
        }

        .btn-back {
            padding: 8px 22px;
            border: 1px solid #111827;
            background: transparent;
            color: #111827;
            text-decoration: none;
            font-size: 11px;
            letter-spacing: 1px;
        }

        .btn-back:hover {
            background: #111827;
            color: #fff;
        }

        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }

            .actions {
                display: none;
            }
        }
    </style>
</head>
<body>

@php
    $subtotal = $reservasi->total_harga ?? 0;
    $denda = $reservasi->denda ?? 0;
    $pajak = $subtotal * 0.10;
    $service = $subtotal * 0.05;
    $grandTotal = $subtotal + $pajak + $service + $denda;
@endphp

<div class="invoice-wrapper">

    <!-- HEADER -->
    <div class="header">
        <div class="hotel-info">
            <h1>NOVOTEL KARAWANG</h1>
            <small>
                Jl Interchange Karawang Barat<br>
                Karawang, Jawa Barat<br>
                Indonesia
            </small>
        </div>

        <div class="invoice-info">
            <h2>INVOICE</h2>
            @if($reservasi->status_pembayaran === 'lunas')
                <div class="status paid">PAID</div>
            @else
                <div class="status unpaid">UNPAID</div>
            @endif
        </div>
    </div>

    <!-- GUEST -->
    <div class="section">
        <div class="section-title">Guest Information</div>
        <table>
            <tr>
                <td width="30%">Guest Name</td>
                <td>: {{ $reservasi->tamu->nama }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>: {{ $reservasi->tamu->telepon ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- RESERVATION -->
    <div class="section">
        <div class="section-title">Reservation Details</div>
        <table>
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Payment</th>
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
    </div>

    <!-- PAYMENT SUMMARY -->
    <div class="section">
        <div class="section-title">Payment Summary</div>

        <table class="summary">
            <tr>
                <td class="label">Room Charge</td>
                <td class="value">Rp {{ number_format($subtotal,0,',','.') }}</td>
            </tr>
            <tr>
                <td class="label">Tax (10%)</td>
                <td class="value">Rp {{ number_format($pajak,0,',','.') }}</td>
            </tr>
            <tr>
                <td class="label">Service Charge (5%)</td>
                <td class="value">Rp {{ number_format($service,0,',','.') }}</td>
            </tr>

            @if($denda > 0)
            <tr>
                <td class="label">Overstay Penalty</td>
                <td class="value">Rp {{ number_format($denda,0,',','.') }}</td>
            </tr>
            @endif

            <tr class="grand-total">
                <td>Total Amount</td>
                <td class="value">
                    Rp {{ number_format($grandTotal,0,',','.') }}
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Thank you for staying with us<br>
        Printed on {{ now()->format('d M Y H:i') }}
    </div>

    <div class="actions">
        <a href="{{ route('dashboard') }}" class="btn-back">
            BACK TO DASHBOARD
        </a>
    </div>

</div>

</body>
</html>
