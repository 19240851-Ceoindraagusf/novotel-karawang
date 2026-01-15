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
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg" style="margin-right:2px;"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg" style="margin-right:2px;"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg" style="margin-right:2px;"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#FFD700" xmlns="http://www.w3.org/2000/svg"><polygon points="12,2 15,9 22,9.3 17,14.1 18.5,21 12,17.5 5.5,21 7,14.1 2,9.3 9,9"/></svg>
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
                <h3 style="color:#003580;font-weight:bold;">Selamat Datang, {{ Auth::user()->name }}</h3>
                <p>Role: <span class="badge bg-primary">{{ Auth::user()->role }}</span></p>
            </div>
            <div class="card mt-4">
                <div class="card-header text-white">
                    <span style="font-size:1.1rem;">Menu Utama</span>
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
</div>
<!-- ABOUT HOTEL -->
<div class="card mt-4 shadow">
    <div class="card-header bg-primary text-white">
        <strong>Tentang Novotel Karawang</strong>
    </div>
    <style>
.about-scroll {
    max-height: 200px;
    overflow-y: auto;
}
</style>

    <div class="card-body about-scroll">
        <p>
            Novotel Karawang merupakan hotel bintang 4 yang terletak strategis
            di pusat kota Karawang. Hotel ini menawarkan kenyamanan modern
            dengan fasilitas lengkap untuk kebutuhan bisnis maupun liburan.
        </p>

        <p>
            Dengan desain elegan dan pelayanan profesional, Novotel Karawang
            memiliki berbagai tipe kamar yang nyaman, restoran, ruang meeting,
            kolam renang, serta fasilitas kebugaran.
        </p>

        <p>
            Lokasi hotel sangat dekat dengan kawasan industri, pusat perbelanjaan,
            dan akses tol, sehingga menjadi pilihan ideal bagi tamu lokal maupun
            internasional.
        </p>

        <p>
            Visi kami adalah memberikan pengalaman menginap terbaik dengan
            standar internasional dan keramahan khas Indonesia.
        </p>
    </div>
</div>

</body>
</html>