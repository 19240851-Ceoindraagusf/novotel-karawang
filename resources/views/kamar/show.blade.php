<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kamar - {{ $kamar->nomor_kamar }}</title>
    <style>
        body{font-family:Arial, sans-serif;background:#f7f9fb;padding:24px}
        .card{max-width:980px;margin:0 auto;background:#fff;padding:20px;border-radius:12px;box-shadow:0 6px 18px rgba(2,10,40,0.06)}
        .header{display:flex;align-items:center;justify-content:space-between;gap:12px}
        .title{font-size:20px;color:#003580;font-weight:700}
        .sub{color:#666}
        .grid{display:grid;grid-template-columns:1fr 380px;gap:20px;margin-top:18px}
        .carousel{background:#eef3ff;border-radius:8px;padding:12px;display:flex;flex-direction:column;align-items:center}
        .carousel img{max-width:100%;border-radius:6px}
        .photo-controls{display:flex;align-items:center;gap:8px;margin-top:8px}
        .btn{background:#003580;color:#fff;padding:8px 12px;border-radius:6px;text-decoration:none}
        .meta{background:#fafafa;padding:12px;border-radius:8px}
        .meta h3{margin:0 0 8px 0;color:#003580}
        .meta dl{display:grid;grid-template-columns:120px 1fr;row-gap:8px;column-gap:12px}
        .desc{margin-top:12px;color:#333}
        .back{margin-top:16px;display:inline-block}
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <div>
                <div class="title">Kamar {{ $kamar->nomor_kamar }} — {{ $kamar->tipe_kamar ?? '-' }}</div>
                <div class="sub">Rp {{ number_format($kamar->harga,0,',','.') }} · {{ $kamar->status ?? '-' }}</div>
            </div>
                <div>
                <a href="{{ route('kamar.index') }}?page={{ request()->get('page', 1) }}" class="btn back">Kembali ke Daftar</a>
            </div>
        </div>

        <div class="grid">
            <div>
                <div class="carousel" id="carousel">
                    @if($kamar->foto)
                        <img src="{{ asset('storage/kamar/'.trim($kamar->foto)) }}" alt="Foto Kamar">
                    @else
                        <div style="padding:60px;color:#666">Tidak ada foto</div>
                    @endif
                </div>

                <div class="desc">
                    <h3 style="color:#003580;margin-bottom:8px">Deskripsi</h3>
                    <p>
                        {{ $kamar->deskripsi ?? "Enjoy work and quietness. Our {$kamar->tipe_kamar} room mixes modern decor, ergonomic comfort and high end facilities." }}
                    </p>

                    <h4 style="margin-top:12px;color:#003580">Fitur utama</h4>
                    <ul>
                        @if($kamar->fasilitas)
                            @foreach(array_filter(array_map('trim', explode(',', $kamar->fasilitas))) as $f)
                                <li>{{ $f }}</li>
                            @endforeach
                        @else
                            <li>Makanan & Minuman: Fasilitas Makan dan Minum</li>
                            <li>Fasilitas pembuat kopi/teh</li>
                            <li>Mini Bar</li>
                        @endif
                    </ul>
                </div>
            </div>

            <aside class="meta">
                <h3>Informasi Kamar</h3>
                <dl>
                    <dt>Nomor</dt><dd>{{ $kamar->nomor_kamar }}</dd>
                    <dt>Tipe</dt><dd>{{ $kamar->tipe_kamar ?? '-' }}</dd>
                    <dt>Harga</dt><dd>Rp {{ number_format($kamar->harga,0,',','.') }}</dd>
                    <dt>Status</dt><dd>{{ $kamar->status ?? '-' }}</dd>
                    <dt>Area</dt><dd>{{ $kamar->area ?? 'Dari 26 m²' }}</dd>
                    <dt>Maks. Orang</dt><dd>{{ $kamar->maks_orang ?? '3' }}</dd>
                    <dt>Tempat Tidur</dt><dd>{{ $kamar->tempat_tidur ?? 'Tempat tidur ganda x1' }}</dd>
                </dl>

                <div style="margin-top:12px">
                    <a href="{{ route('kamar.edit', $kamar->id) }}?page={{ request()->get('page', 1) }}" class="btn">Edit Kamar</a>
                </div>
            </aside>
        </div>
    </div>

    
</body>
</html>
