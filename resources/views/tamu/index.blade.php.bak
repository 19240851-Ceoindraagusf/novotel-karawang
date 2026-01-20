<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tamu - Novotel Karawang</title>
    <style>
        @keyframes slideInTable {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes headerGlow {
            0%, 100% {
                box-shadow: inset 0 0 0 rgba(0, 53, 128, 0.1);
            }
            50% {
                box-shadow: inset 0 0 10px rgba(0, 53, 128, 0.2);
            }
        }

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
            animation: headerGlow 2s ease-in-out infinite;
        }
        tbody tr {
            animation: slideInTable 0.5s ease-out both;
        }
        tbody tr:nth-child(1) { animation-delay: 0.1s; }
        tbody tr:nth-child(2) { animation-delay: 0.15s; }
        tbody tr:nth-child(3) { animation-delay: 0.2s; }
        tbody tr:nth-child(4) { animation-delay: 0.25s; }
        tbody tr:nth-child(5) { animation-delay: 0.3s; }
        tbody tr:nth-child(6) { animation-delay: 0.35s; }
        tbody tr:nth-child(7) { animation-delay: 0.4s; }
        tbody tr:nth-child(8) { animation-delay: 0.45s; }
        tbody tr:nth-child(9) { animation-delay: 0.5s; }
        tbody tr:nth-child(10) { animation-delay: 0.55s; }
        tbody tr:nth-child(n+11) { animation-delay: 0.6s; }
        tbody tr {
            transition: all 0.3s ease;
        }
        tbody tr:hover {
            background: linear-gradient(90deg, #f0f4ff 0%, #f5f5f5 100%);
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0, 53, 128, 0.1);
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
            <h1>Daftar Tamu Hotel Novotel Karawang</h1>
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

        <a href="{{ route('tamu.create') }}" class="btn">+ Tambah Tamu Baru</a>
        <a href="{{ route('dashboard') }}" class="btn btn-dashboard"> Kembali ke Dashboard</a>
</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tamus as $index => $t)
      

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $t->nama }}</td>
                        <td>{{ $t->alamat }}</td>
                        <td>{{ $t->telepon }}</td>
                        <td>{{ $t->email }}</td>
                        <td>
                  
                            <div class="actions">
                                <a href="{{ route('tamu.edit', $t->id) }}" class="btn-sm btn-warning">Edit</a>
                                <form action="{{ route('tamu.destroy', $t->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus tamu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;">Belum ada data tamu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html> </table>
    </div>
</body>
</html>