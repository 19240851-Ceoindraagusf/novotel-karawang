<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kamar - Novotel Karawang</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e6eaf3 0%, #f8fafc 100%);
            padding: 20px;
        }
        .container {
            max-width: 600px;
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
            text-align: left;
        }
        .stars {
            margin-left: 10px;
            display: flex;
            align-items: center;
        }
        .stars svg {
            width: 18px; height: 18px; margin-right: 2px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #003580;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #003580;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #003580;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            border: none;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn:hover {
            background: #00214d;
        }
        .btn-cancel {
            background: #6c757d;
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            margin-left: 10px;
        }
        .btn-cancel:hover {
            background: #5a6268;
        }
        .actions {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-novotel">
            <img src="/build/assets/novotel-logo.svg" alt="Novotel Karawang Logo" class="novotel-logo">
            <h1>Edit Data Kamar</h1>
            <span class="stars">
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
            </span>
        </div>

        <form action="{{ route('kamar.update', $kamar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nomor_kamar">Nomor Kamar</label>
                <input type="text" 
                       id="nomor_kamar" 
                       name="nomor_kamar" 
                       value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}" 
                       required>
            </div>

            <div class="form-group">
                <label for="tipe_kamar">Tipe Kamar</label>
                <input type="text" 
                       id="tipe_kamar" 
                       name="tipe_kamar" 
                       value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}" 
                       placeholder="Contoh: Deluxe Room"
                       required>
            </div>

            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" 
                       id="harga" 
                       name="harga" 
                       value="{{ old('harga', $kamar->harga) }}" 
                       min="0" 
                       required>
            </div>

            <div class="mb-3">
    <label class="form-label">Status Kamar</label>
    <select name="status" class="form-control" required>
        <option value="available" {{ $kamar->status == 'available' ? 'selected' : '' }}>
            Bisa dipesan
        </option>
        <option value="reserved" {{ $kamar->status == 'reserved' ? 'selected' : '' }}>
            Sudah dibooking
        </option>
        <option value="occupied" {{ $kamar->status == 'occupied' ? 'selected' : '' }}>
            Sedang ditempati
        </option>
        <option value="dirty" {{ $kamar->status == 'dirty' ? 'selected' : '' }}>
            Kotor / Belum dibersihkan
        </option>
        <option value="maintenance" {{ $kamar->status == 'maintenance' ? 'selected' : '' }}>
            Rusak / Maintenance
        </option>
    </select>
</div>

            <div class="actions">
                <button type="submit" class="btn">Perbarui</button>
                <a href="{{ route('kamar.index') }}" class="btn-cancel">Batal</a>
            
            
   @if($kamar->foto)
    <img src="{{ asset('storage/kamar/'.$kamar->foto) }}" width="120">
@else
    <span>Tidak ada foto</span>
@endif

<input type="file" name="foto">

            </div>
        </form>
    </div>
</body>
</html>