<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Novotel Karawang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e6eaf3 0%, #f8fafc 100%);
        }
        .navbar {
            box-shadow: 0 2px 8px rgba(0,53,128,0.08);
        }
        .novotel-logo {
            height: 48px;
            margin-right: 16px;
        }
        .card {
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0,53,128,0.07);
        }
        .card-header {
            background: #003580 !important;
            letter-spacing: 1px;
        }
        .btn-primary, .btn-success, .btn-info {
            font-weight: 600;
            border-radius: 10px;
        }
        .menu-btn {
            padding: 15px 20px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            color: white;
        }
        .menu-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
        .menu-btn-kamar {
            background: linear-gradient(135deg, #0052cc 0%, #003d99 100%);
        }
        .menu-btn-kamar:hover {
            background: linear-gradient(135deg, #003d99 0%, #002966 100%);
            color: white;
        }
        .menu-btn-tamu {
            background: linear-gradient(135deg, #196833 0%, #134e27 100%);
        }
        .menu-btn-tamu:hover {
            background: linear-gradient(135deg, #1a6a34 0%, #0f5c1e 100%);
            color: white;
        }
        .menu-btn-reservasi {
            background: linear-gradient(135deg, #7ab7e6 0%, #226974 100%);
        }
        .menu-btn-reservasi:hover {
            background: linear-gradient(135deg, #0d5f6b 0%, #074554 100%);
            color: white;
        }
    </style>
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark" style="background:#003580;">
    <div class="container align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="#">
            @php
                use Illuminate\Support\Facades\Storage;
                $candidates = ['public/kamar/novotel-logo.png', 'public/kamar/novotel-logo.jpg', 'public/kamar/novotel-logo.jpeg'];
                $found = null;
                foreach ($candidates as $p) {
                    if (Storage::exists($p)) { $found = $p; break; }
                }
                $logoPath = $found ? asset(str_replace('public/', 'storage/', $found)) : asset('build/assets/novotel-logo.svg');
            @endphp
            <img src="{{ $logoPath }}" alt="Novotel Karawang Logo" class="novotel-logo">
            <span style="font-size:1.4rem;font-weight:bold;letter-spacing:1px;" class="d-flex align-items-center">
                Novotel Karawang
                <span class="ms-2 d-flex align-items-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#FFD700"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#FFD700"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#FFD700"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#FFD700"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                </span>
            </span>
        </a>
        <div class="d-flex ms-3">
            <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-warning">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="text-center mb-4">
                <h3 style="color:#003580;font-weight:bold;">
                    Selamat Datang, {{ Auth::user()->name }}
                </h3>
                <p>Role: <span class="badge bg-primary">{{ Auth::user()->role }}</span></p>
            </div>

            <div class="d-flex justify-content-center">
                <div class="card w-100" style="max-width:760px;">
                    <div class="card-header text-white text-center">
                        Menu Utama
                    </div>
                    <div class="card-body">
                        @if(Auth::user()->role == 'admin')
                            <div class="row g-3">
                                <div class="col-6 d-flex">
                                    <a href="{{ url('/admin/kamar') }}" class="menu-btn menu-btn-kamar w-100">
                                        <i class="bi bi-door-closed"></i>
                                        Kamar
                                    </a>
                                </div>
                                <div class="col-6 d-flex">
                                    <a href="{{ url('/admin/tamu') }}" class="menu-btn menu-btn-tamu w-100">
                                        <i class="bi bi-people-fill"></i>
                                        Tamu
                                    </a>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <a href="{{ url('/admin/reservasi') }}" class="menu-btn menu-btn-reservasi" style="width:60%;">
                                        <i class="bi bi-calendar-check"></i>
                                        Reservasi
                                    </a>
                                </div>
                            </div>
                        @elseif(Auth::user()->role == 'resepsionis')
                            <div class="d-flex justify-content-center">
                                <a href="{{ url('/reservasi') }}" class="menu-btn menu-btn-reservasi" style="width:70%;">
                                    <i class="bi bi-calendar-check"></i>
                                    Reservasi
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="card mt-4 w-100" style="max-width:760px;">
                    <div class="card-header text-white text-center">
                        <span style="font-size:1.05rem;">Ketersediaan Kamar</span>
                    </div>
                    <div class="card-body">
                        @php
                            // counts dan kamars di-pass dari route
                            $statusLabels = [
                                'available' => 'Bisa dipesan',
                                'reserved' => 'Sudah dibooking',
                                'occupied' => 'Sudah ditempati',
                                'dirty' => 'Kotor / Belum dibersihkan',
                                'maintenance' => 'Rusak / Maintenance',
                            ];
                        @endphp

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>Total</strong>
                                <div class="h5 mb-0">{{ $counts['total'] ?? 0 }}</div>
                            </div>
                            <div class="text-end">
                                <small class="text-success">Bisa dipesan: <strong>{{ $counts['available'] ?? 0 }}</strong></small><br>
                                <small class="text-warning">Sudah dibooking: <strong>{{ $counts['reserved'] ?? 0 }}</strong></small><br>
                                <small class="text-danger">Sudah ditempati: <strong>{{ $counts['occupied'] ?? 0 }}</strong></small><br>
                                <small class="text-muted">Kotor: <strong>{{ $counts['dirty'] ?? 0 }}</strong></small><br>
                                <small class="text-secondary">Rusak/Maintenance: <strong>{{ $counts['maintenance'] ?? 0 }}</strong></small>
                            </div>
                        </div>

                        <hr>

                        <h6>Preview Kamar</h6>
                        @if(isset($kamars) && $kamars->count())
                            <ul class="list-group">
                                @foreach($kamars as $k)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <div style="font-weight:600;">{{ $k->nomor_kamar }} <small class="text-muted">({{ $k->tipe ?? $k->tipe_kamar ?? '-' }})</small></div>
                                            <small class="text-muted">Rp {{ number_format($k->harga,0,',','.') }}</small>
                                        </div>
                                        @php
                                            $badgeClass = 'bg-secondary';
                                            if($k->status == 'available') $badgeClass = 'bg-success';
                                            elseif($k->status == 'reserved') $badgeClass = 'bg-warning text-dark';
                                            elseif($k->status == 'occupied') $badgeClass = 'bg-danger';
                                            elseif($k->status == 'dirty') $badgeClass = 'bg-dark text-white';
                                            elseif($k->status == 'maintenance') $badgeClass = 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $statusLabels[$k->status] ?? ucfirst($k->status) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Tidak ada data kamar.</p>
                        @endif

                        <div class="mt-3">
                            <a href="{{ url('/admin/kamar') }}" class="btn btn-outline-primary w-100">Lihat Semua Kamar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ABOUT HOTEL -->
    <div class="mt-5 mb-5">
        <h2 style="color:#003580;font-weight:bold;margin-bottom:30px;text-align:center;">Tentang Novotel Karawang</h2>
        <div style="max-width:900px;margin:0 auto;line-height:1.8;text-align:center;">
            <p style="font-size:1.05rem;color:#333;">Novotel Karawang merupakan hotel bintang 4 yang terletak strategis di pusat kota Karawang, Jawa Barat. Dengan lokasi yang sempurna, hotel kami menawarkan akses mudah ke berbagai destinasi bisnis dan wisata di sekitar kota Karawang.</p>
            
            <p style="font-size:1.05rem;color:#333;">Hotel ini menawarkan kenyamanan modern dengan fasilitas lengkap yang dirancang untuk memenuhi kebutuhan para tamu bisnis maupun wisatawan. Setiap kamar dilengkapi dengan peralatan modern, kenyamanan maksimal, dan pelayanan yang ramah dari tim profesional kami.</p>
            
            <p style="font-size:1.05rem;color:#333;">Berlokasi dekat dengan kawasan industri, pusat perbelanjaan, dan akses tol utama, memudahkan Anda untuk menjangkau berbagai lokasi penting. Kami memahami kebutuhan perjalanan bisnis dan liburan Anda dengan sempurna.</p>
            
            <p style="font-size:1.05rem;color:#333;">Novotel Karawang berkomitmen memberikan pengalaman menginap berstandar internasional dengan harga yang kompetitif. Dengan tim staf yang terlatih dan berpengalaman, kami siap memberikan pelayanan terbaik untuk membuat kunjungan Anda tak terlupakan.</p>
            
            <p style="font-size:1.05rem;color:#333;">Fasilitas lengkap termasuk kolam renang, restoran, bar, pusat kebugaran, dan ruang meeting yang dapat disesuaikan dengan kebutuhan acara Anda. Setiap detail dirancang untuk memberikan kenyamanan maksimal selama menginap.</p>
        </div>
    </div>

    <!-- 📍 LOKASI HOTEL -->
    <div class="card mt-4 mb-5" style="border-radius:18px;overflow:hidden;">
        <div class="card-header text-white" style="background:#003580;border:none;">
            Lokasi Hotel
        </div>
        <div class="card-body" style="padding:0;">
            <iframe
                src="https://www.google.com/maps?q=Novotel%20Karawang&output=embed"
                width="100%"
                height="300"
                style="border:0;display:block;"
                loading="lazy">
            </iframe>

            <div class="mt-3 p-3">
                <strong>Alamat:</strong><br>
                Jl. Interchange Karawang Barat, Margakaya,<br>
                Teluk Jambe Barat, Karawang, Jawa Barat 41361
            </div>
        </div>
    </div>

    <!-- 🏨 HOTEL SERVICES -->
    <div class="card mt-4 mb-5" style="border-radius:18px;overflow:hidden;">
        <div class="card-header text-white" style="background:#003580;border:none;">
            Hotel Services & Information
        </div>
        <div class="card-body">

            <div class="row">
                <!-- Check-in / Check-out -->
                <div class="col-md-6 mb-3">
                    <strong>Check-in / Check-out</strong>
                    <ul class="mt-2">
                        <li><i class="bi bi-clock-fill" style="margin-right:8px;color:#003580;"></i>Check-in from <strong>02:00 PM</strong></li>
                        <li><i class="bi bi-door-closed" style="margin-right:8px;color:#003580;"></i>Check-out up to <strong>12:00 PM</strong></li>
                    </ul>
                </div>

                <!-- On Site Services -->
                <div class="col-md-6 mb-3">
                    <strong>On-site Facilities</strong>
                    <ul class="mt-2">
                        <li><i class="bi bi-water" style="margin-right:8px;color:#003580;"></i>Swimming Pool</li>
                        <li><i class="bi bi-shop" style="margin-right:8px;color:#003580;"></i>Restaurant</li>
                        <li><i class="bi bi-cup-hot-fill" style="margin-right:8px;color:#003580;"></i>Bar</li>
                        <li><i class="bi bi-heart-pulse" style="margin-right:8px;color:#003580;"></i>Fitness Center</li>
                        <li><i class="bi bi-people-fill" style="margin-right:8px;color:#003580;"></i>Meeting Rooms</li>
                    </ul>
                </div>
            </div>

            <div class="row mt-2">
                <!-- Accessibility -->
                <div class="col-md-6 mb-3">
                    <strong>Accessibility & Comfort</strong>
                    <ul class="mt-2">
                        <li><i class="bi bi-universal-access" style="margin-right:8px;color:#003580;"></i>Wheelchair Accessible</li>
                        <li><i class="bi bi-snow" style="margin-right:8px;color:#003580;"></i>Air Conditioning</li>
                        <li><i class="bi bi-wifi" style="margin-right:8px;color:#003580;"></i>Free Wi-Fi</li>
                    </ul>
                </div>

                <!-- Additional Services -->
                <div class="col-md-6 mb-3">
                    <strong>Additional Services</strong>
                    <ul class="mt-2">
                        <li><i class="bi bi-car-front-fill" style="margin-right:8px;color:#003580;"></i>Car Park</li>
                        <li><i class="bi bi-egg-fried" style="margin-right:8px;color:#003580;"></i>Breakfast Available</li>
                        <li><i class="bi bi-bell-fill" style="margin-right:8px;color:#003580;"></i>Room Service</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

        </div>
    </div>

</div>

</body>
</html>
