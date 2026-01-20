<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kamar - Novotel Karawang</title>
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
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn:hover {
            background: #00214d;
        }
        .btn-secondary {
            background: #6c757d;
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
        .status {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        .status.tersedia {
            background: #d4edda;
            color: #155724;
        }
        .status.terisi {
            background: #f8d7da;
            color: #721c24;
        }
        .status.maintenance {
            background: #fff3cd;
            color: #856404;
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
        }
        .btn-warning {
            background: #ffc107;
            color: #333;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 5px;
        }
        .pagination a, .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #003580;
        }
        .pagination .active {
            background: #003580;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-novotel">
            <img src="/build/assets/novotel-logo.svg" alt="Novotel Karawang Logo" class="novotel-logo">
            <h1>Daftar Kamar Hotel Novotel Karawang</h1>
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

        <a href="{{ route('kamar.create') }}" class="btn">+ Tambah Kamar Baru</a>
        <a href="{{ route('dashboard') }}" class="btn" style="background:#6c757d;">Kembali ke Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Kamar</th>
                    <th>Tipe Kamar</th>
                    <th>Harga</th>
                    <th>Status</th>
                         <!-- TAMBAHAN FOTO -->
                    <th>Foto</th>
                    <th>Aksi</th>
                    
                </tr>
            </thead>
            <tbody>
                @forelse($kamars as $index => $kamar)
                    <tr>
                        <td>{{ $kamars->firstItem() + $index }}</td>
                        <td>{{ $kamar->nomor_kamar }}</td>
                       <td>{{ $kamar->tipe_kamar ?? '-' }}</td>
                        <td>Rp {{ number_format($kamar->harga, 0, ',', '.') }}</td>

                        
                        <td>
                            <span class="status {{ $kamar->status }}">
                                {{ ucfirst($kamar->status) }}
                            </span>
                        </td>

                          <!-- TAMBAHAN FOTO -->
       <td>
    @if($kamar->foto)
        <img src="{{ asset('storage/kamar/'.$kamar->foto) }}" width="100" class="img-thumbnail">
    @else
        -
    @endif
</td>


                        <td>
                            <div class="actions">
                                <a href="{{ route('kamar.edit', $kamar->id) }}" class="btn-sm btn-warning">Edit</a>
                                <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;">Belum ada data kamar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $kamars->links() }}
        </div>
    </div>
</body>
</html>