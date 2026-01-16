<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Reservasi - Novotel Karawang</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e6eaf3 0%, #f8fafc 100%);
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0,53,128,0.07);
        }
        .header-novotel {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }
        .novotel-logo {
            height: 48px;
        }
        h1 {
            color: #003580;
            font-weight: bold;
            margin-bottom: 0;
        }
        .stars {
            margin-left: 10px;
            display: flex;
            align-items: center;
        }
        .stars svg {
            width: 18px; height: 18px; margin-right: 2px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #003580;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 20px;
            margin-right: 10px;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn:hover {
            background: #00214d;
        }
        .btn-dashboard {
            background: #6c757d;
        }
        .btn-dashboard:hover {
            background: #5a6268;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #003580;
            color: white;
            letter-spacing: 1px;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .btn-sm {
            padding: 5px 10px;
            font-size: 14px;
            text-decoration: none;
            border-radius: 3px;
            border: none;
            cursor: pointer;
            display: inline-block;
            text-align: center;
        }
        .btn-warning {
            background: #ffc107;
            color: #333;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-novotel">
            <img src="/build/assets/novotel-logo.svg" alt="Novotel Karawang Logo" class="novotel-logo">
            <h1>Daftar Reservasi Hotel Novotel Karawang</h1>
            <span class="stars">
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
            </span>
        </div>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('reservasi.create') }}" class="btn">+ Tambah Reservasi</a>
        <a href="{{ route('dashboard') }}" class="btn btn-dashboard">Kembali ke Dashboard</a>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tamu</th>
                    <th>Kamar</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservasi as $index => $r)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $r->tamu->nama ?? '–' }}</td>
                        <td>{{ $r->kamar->nomor_kamar ?? '–' }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->check_in)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->check_out)->format('d M Y') }}</td>
                        <td>@if($r->metode_pembayaran)
    {{ strtoupper($r->metode_pembayaran) }}
@else
    <em>Belum dipilih</em>
@endif
</td>

@if($r->check_in_at && $r->check_out_at === null)
<form action="{{ route('reservasi.checkout', $r->id) }}" method="POST" style="display:inline">
    @csrf
    <button class="btn btn-danger btn-sm"
        onclick="return confirm('Check-out tamu sekarang?')">
        Check-out
    </button>
</form>
@endif



                        <td>{{ $r->status_pembayaran ? ucfirst($r->status_pembayaran) : '-' }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('reservasi.edit', $r->id) }}" class="btn-sm btn-warning">Edit</a>
                                
        <a href="{{ route('invoice.pdf', $r->id) }}"
   target="_blank"
   class="btn-sm"
   style="background:#28a745;color:white;">
   Cetak Invoice (PDF)
</a>

        
                                <form action="{{ route('reservasi.destroy', $r->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;">Belum ada data reservasi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>