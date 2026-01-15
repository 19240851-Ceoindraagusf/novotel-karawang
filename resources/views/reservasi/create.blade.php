<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Reservasi - Novotel Karawang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            border: none;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-cancel {
            background: #6c757d;
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
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
        <h1>Tambah Reservasi</h1>

        <form action="{{ route('reservasi.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="tamu_id">Pilih Tamu</label>
                <select name="tamu_id" required>
    <option value="">-- Pilih Tamu --</option>
    @foreach($tamus as $tamu)
        <option value="{{ $tamu->id }}">{{ $tamu->nama }}</option> <!-- value = ID -->
    @endforeach
</select>
            </div>

            <div class="form-group">
                <label for="kamar_id">Pilih Kamar</label>
                <select id="kamar_id" name="kamar_id" required>
                    <option value="">-- Pilih Kamar --</option>
                    @foreach($kamars as $kamar)
                        <option value="{{ $kamar->id }}" {{ $kamar->status == 'terisi' ? 'disabled' : '' }}>
                            {{ $kamar->nomor_kamar }} ({{ $kamar->tipe_kamar }}, Rp {{ number_format($kamar->harga, 0, ',', '.') }})
                            @if($kamar->status == 'terisi')
                                – Terisi
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="check_in">Check In</label>
                <input type="date" id="check_in" name="check_in" required>
            </div>

            <div class="form-group">
                <label for="check_out">Check Out</label>
                <input type="date" id="check_out" name="check_out" required>
            </div>

            <div class="form-group">
                <label for="metode_pembayaran">Metode Pembayaran</label>
                <select id="metode_pembayaran" name="metode_pembayaran" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="transfer">Transfer</option>
                    <option value="debit">Debit</option>
                    <option value="cash">Cash</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status_pembayaran">Status Pembayaran</label>
                <select id="status_pembayaran" name="status_pembayaran" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="lunas">Lunas</option>
                    <option value="belum lunas">Belum Lunas</option>
                </select>
            </div>

            <div class="actions">
                <button type="submit" class="btn">Simpan</button>
                <a href="{{ route('reservasi.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>