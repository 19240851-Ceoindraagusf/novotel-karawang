<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kamar - Novotel Karawang</title>
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
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #003580;
        }
        .error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
            font-weight: 600;
            background: #003580;
            color: white;
            transition: background 0.2s;
        }
        .btn-primary {
            background: #003580;
            color: white;
        }
        .btn-primary:hover {
            background: #00214d;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
            text-decoration: none;
            display: inline-block;
        }
        .btn-secondary:hover {
            background: #545b62;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-novotel">
            <img src="/build/assets/novotel-logo.svg" alt="Novotel Karawang Logo" class="novotel-logo">
            <h1>Tambah Kamar Baru</h1>
            <span class="stars">
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
            </span>
        </div>

        @if($errors->any())
            <div style="background:#f8d7da;padding:15px;border-radius:5px;margin-bottom:20px;color:#721c24;">
                <ul style="list-style:none;">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nomor_kamar">Nomor Kamar</label>
                <input type="text" id="nomor_kamar" name="nomor_kamar" value="{{ old('nomor_kamar') }}" required placeholder="Contoh: 101">
                @error('nomor_kamar')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipe_kamar">Tipe Kamar</label>
                <input type="text" id="tipe_kamar" name="tipe_kamar" value="{{ old('tipe_kamar') }}" required placeholder="Contoh: Deluxe Room">
                @error('tipe_kamar')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" id="harga" name="harga" value="{{ old('harga') }}" required placeholder="Contoh: 500000">
                @error('harga')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Kamar</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi singkat">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="area">Area (mis. 'Dari 26 m²')</label>
                <input type="text" id="area" name="area" value="{{ old('area') }}" placeholder="Contoh: Dari 26 m²">
                @error('area')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="maks_orang">Maks. jumlah orang</label>
                <input type="number" id="maks_orang" name="maks_orang" value="{{ old('maks_orang') }}" min="1" placeholder="Contoh: 3">
                @error('maks_orang')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="fasilitas">Fasilitas (pisah dengan koma)</label>
                <input type="text" id="fasilitas" name="fasilitas" value="{{ old('fasilitas') }}" placeholder="Contoh: Mini Bar, Pembuat kopi/teh, AC">
                @error('fasilitas')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status Kamar</label>
                <select name="status" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="available">Bisa dipesan</option>
                    <option value="reserved">Sudah dibooking</option>
                    <option value="occupied">Sedang ditempati</option>
                    <option value="dirty">Kotor / Belum dibersihkan</option>
                    <option value="maintenance">Rusak / Maintenance</option>
                </select>
            </div>

            <div class="form-group">
                <label>Foto Kamar</label>
                <input type="file" name="foto" accept="image/*">
                @error('foto')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kamar.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>