<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservasi - Novotel Karawang</title>
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
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input:focus, select:focus {
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
            <h1>Edit Reservasi</h1>
            <span class="stars">
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                <svg viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
            </span>
        </div>

        <form action="{{ route('reservasi.update', $reservasi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="tamu_id">Pilih Tamu</label>
                <select id="tamu_id" name="tamu_id" required>
                    <option value="">-- Pilih Tamu --</option>
                    @foreach($tamus as $tamu)
                        <option value="{{ $tamu->id }}" {{ old('tamu_id', $reservasi->tamu_id) == $tamu->id ? 'selected' : '' }}>
                            {{ $tamu->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="kamar_id">Pilih Kamar</label>
                <select id="kamar_id" name="kamar_id" required>
                    <option value="">-- Pilih Kamar --</option>
                    @foreach($kamars as $kamar)
                        @php
                            $labels = [
                                'available' => 'Bisa dipesan',
                                'reserved' => 'Sudah dibooking',
                                'occupied' => 'Sudah ditempati',
                                'dirty' => 'Kotor / Belum dibersihkan',
                                'maintenance' => 'Rusak / Maintenance',
                            ];
                            $disabled = ($kamar->status !== 'available' && $kamar->id != $reservasi->kamar_id) ? 'disabled' : '';
                        @endphp
                        <option value="{{ $kamar->id }}" 
                                {{ old('kamar_id', $reservasi->kamar_id) == $kamar->id ? 'selected' : '' }}
                                {{ $disabled }}>
                            {{ $kamar->nomor_kamar }} ({{ $kamar->tipe_kamar }}, Rp {{ number_format($kamar->harga, 0, ',', '.') }})
                            @if($kamar->status !== 'available' && $kamar->id != $reservasi->kamar_id)
                                – {{ $labels[$kamar->status] ?? $kamar->status }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="check_in">Check In</label>
                <input type="date" 
                       id="check_in" 
                       name="check_in" 
                       value="{{ old('check_in', \Carbon\Carbon::parse($reservasi->check_in)->format('Y-m-d')) }}" 
                       required>
            </div>

            <div class="form-group">
                <label for="check_out">Check Out</label>
                <input type="date" 
                       id="check_out" 
                       name="check_out" 
                       value="{{ old('check_out', \Carbon\Carbon::parse($reservasi->check_out)->format('Y-m-d')) }}" 
                       required>
            </div>

            <div class="form-group">
                <label for="metode_pembayaran">Metode Pembayaran</label>
                <select id="metode_pembayaran" name="metode_pembayaran" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="transfer" {{ old('metode_pembayaran', $reservasi->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                    <option value="debit" {{ old('metode_pembayaran', $reservasi->metode_pembayaran) == 'debit' ? 'selected' : '' }}>Debit</option>
                    <option value="cash" {{ old('metode_pembayaran', $reservasi->metode_pembayaran) == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="qris" {{ old('metode_pembayaran', $reservasi->metode_pembayaran) == 'qris' ? 'selected' : '' }}>QRIS</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status_pembayaran">Status Pembayaran</label>
                <select id="status_pembayaran" name="status_pembayaran" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="lunas" {{ old('status_pembayaran', $reservasi->status_pembayaran) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="belum lunas" {{ old('status_pembayaran', $reservasi->status_pembayaran) == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                </select>
            </div>

            <div class="actions">
                <button type="submit" class="btn">Perbarui</button>
                <a href="{{ route('reservasi.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>