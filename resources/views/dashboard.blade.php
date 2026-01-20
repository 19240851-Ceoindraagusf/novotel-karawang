<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Novotel Karawang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark" style="background:#003580;">
    <div class="container align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="/build/assets/novotel-logo.svg" alt="Novotel Karawang Logo" class="novotel-logo">
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
        <div class="col-md-8">
            <div class="text-center mb-4">
                <h3 style="color:#003580;font-weight:bold;">
                    Selamat Datang, {{ Auth::user()->name }}
                </h3>
                <p>Role: <span class="badge bg-primary">{{ Auth::user()->role }}</span></p>
            </div>

            <div class="card mt-4">
                <div class="card-header text-white">
                    Menu Utama
                </div>
                <div class="card-body">
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ url('/admin/kamar') }}" class="btn btn-primary w-100 mb-2">Kamar</a>
                        <a href="{{ url('/admin/tamu') }}" class="btn btn-success w-100 mb-2">Tamu</a>
                        <a href="{{ url('/admin/reservasi') }}" class="btn btn-info w-100 mb-2">Reservasi</a>
                    @elseif(Auth::user()->role == 'resepsionis')
                        <a href="{{ url('/reservasi') }}" class="btn btn-info w-100 mb-2">Reservasi</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ABOUT HOTEL -->
    <div class="card mt-4">
        <div class="card-header text-white">
            Tentang Novotel Karawang
        </div>
        <div class="card-body" style="max-height:200px;overflow-y:auto;">
            <p>Novotel Karawang merupakan hotel bintang 4 yang terletak strategis di pusat kota Karawang.</p>
            <p>Hotel ini menawarkan kenyamanan modern dengan fasilitas lengkap.</p>
            <p>Dekat kawasan industri, pusat perbelanjaan, dan akses tol.</p>
            <p>Memberikan pengalaman menginap berstandar internasional.</p>
        </div>
    </div>

    <!-- 📍 LOKASI HOTEL (DITAMBAHKAN, TANPA MERUBAH STRUKTUR) -->
    <div class="card mt-4 mb-5">
        <div class="card-header text-white">
            Lokasi Hotel
        </div>
        <div class="card-body">
            <iframe
                src="https://www.google.com/maps?q=Novotel%20Karawang&output=embed"
                width="100%"
                height="300"
                style="border:0;border-radius:12px;"
                loading="lazy">
            </iframe>

            <div class="mt-3">
                <strong>Alamat:</strong><br>
                Jl. Interchange Karawang Barat, Margakaya,<br>
                Teluk Jambe Barat, Karawang, Jawa Barat 41361
            </div>

            <!-- 🏨 HOTEL SERVICES -->
<div class="card mt-4 mb-5">
    <div class="card-header text-white">
        Hotel Services & Information
    </div>
    <div class="card-body">

        <div class="row">
            <!-- Check-in / Check-out -->
            <div class="col-md-6 mb-3">
                <strong>Check-in / Check-out</strong>
                <ul class="mt-2">
                    <li>Check-in from <strong>02:00 PM</strong></li>
                    <li>Check-out up to <strong>12:00 PM</strong></li>
                </ul>
            </div>

            <!-- On Site Services -->
            <div class="col-md-6 mb-3">
                <strong>On-site Facilities</strong>
                <ul class="mt-2">
                    <li>Swimming Pool</li>
                    <li>Restaurant</li>
                    <li>Bar</li>
                    <li>Fitness Center</li>
                    <li>Meeting Rooms</li>
                </ul>
            </div>
        </div>

        <div class="row mt-2">
            <!-- Accessibility -->
            <div class="col-md-6 mb-3">
                <strong>Accessibility & Comfort</strong>
                <ul class="mt-2">
                    <li>Wheelchair Accessible</li>
                    <li>Air Conditioning</li>
                    <li>Free Wi-Fi</li>
                </ul>
            </div>

            <!-- Additional Services -->
            <div class="col-md-6 mb-3">
                <strong>Additional Services</strong>
                <ul class="mt-2">
                    <li>Car Park</li>
                    <li>Breakfast Available</li>
                    <li>Room Service</li>
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
