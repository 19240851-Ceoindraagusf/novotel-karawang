<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Tamu;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservasiController extends Controller
{
    public function index()
{
    $reservasi = \App\Models\Reservasi::with('tamu', 'kamar')->get();
    return view('reservasi.index', compact('reservasi'));
}

    public function create()
{
    $tamus = \App\Models\Tamu::all();
    $kamars = \App\Models\Kamar::all();
    return view('reservasi.create', compact('tamus', 'kamars'));
}


public function store(Request $request)
{
    $kamar = Kamar::findOrFail($request->kamar_id);

    $checkIn  = Carbon::parse($request->check_in);
    $checkOut = Carbon::parse($request->check_out);

    $malam = max(1, $checkIn->diffInDays($checkOut));
    $total = $malam * $kamar->harga;

    Reservasi::create([
        'tamu_id' => $request->tamu_id,
        'kamar_id' => $request->kamar_id,
        'check_in' => $request->check_in,
        'check_out' => $request->check_out,
        'total_harga' => $total,
        'metode_pembayaran' => $request->metode_pembayaran,
        'status_pembayaran' => 'lunas'
    ]);

    return redirect()->route('reservasi.index')
        ->with('success', 'Reservasi berhasil disimpan');
}





   public function edit(Reservasi $reservasi)
{
    $tamus = \App\Models\Tamu::all();
    $kamars = \App\Models\Kamar::all();
    return view('reservasi.edit', compact('reservasi', 'tamus', 'kamars'));
}

    public function update(Request $request, Reservasi $reservasi)
{
   $reservasi->update([
    'tamu_id' => $request->tamu_id,
    'kamar_id' => $request->kamar_id,
    'check_in' => $request->check_in,
    'check_out' => $request->check_out,
    'metode_pembayaran' => $request->metode_pembayaran,
    'status_pembayaran' => $request->status_pembayaran,
]);


    return redirect()->route('reservasi.index')
        ->with('success', 'Reservasi berhasil diperbarui');
}


    public function destroy(Reservasi $reservasi)
    {
        $reservasi->delete();
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dihapus');
    }

    public function checkIn($id)
    {
    $reservasi = Reservasi::with('kamar')->findOrFail($id);

    // VALIDASI LOGIKA
    if ($reservasi->check_in_at !== null) {
        return back()->with('error', 'Tamu sudah check-in');
    }

    if ($reservasi->kamar->status !== 'reserved') {
        return back()->with('error', 'Kamar belum siap untuk check-in');
    }

    // SIMPAN CHECK-IN
    $reservasi->update([
        'check_in_at' => now()
    ]);

    // UPDATE STATUS KAMAR
    $reservasi->kamar->update([
        'status' => 'occupied'
    ]);

    return back()->with('success', 'Check-in berhasil');
    
    }

    /* ===============================
       CHECK-OUT + DENDA + PAJAK
    =============================== */
    public function checkout($id)
    {
        $reservasi = Reservasi::with('kamar')->findOrFail($id);

        if ($reservasi->check_out_at !== null) {
            return back()->with('error', 'Tamu sudah check-out');
        }

        $now = Carbon::now();
        $checkoutLimit = Carbon::parse($reservasi->check_out)->setTime(12, 0);

        $hargaPerMalam = $reservasi->kamar->harga;
        $subtotal = $reservasi->total_harga;

        /* ===== HITUNG DENDA ===== */
        $denda = 0;

        if ($now->greaterThan($checkoutLimit)) {
            if ($now->hour > 18) {
                $denda = $hargaPerMalam; // 1 malam
            } else {
                $denda = $hargaPerMalam * 0.5; // 50%
            }
        }

        /* ===== HITUNG PAJAK & SERVICE ===== */
        $pajak = ($subtotal + $denda) * 0.10;          // 10%
        $service = ($subtotal + $denda) * 0.05;        // 5%

        $grandTotal = $subtotal + $denda + $pajak + $service;

        /* ===== SIMPAN ===== */
        $reservasi->update([
            'check_out_at' => $now,
            'denda' => $denda,
            'pajak' => $pajak,
            'service_charge' => $service,
            'grand_total' => $grandTotal
        ]);

        /* ===== UPDATE STATUS KAMAR ===== */
        $reservasi->kamar->update([
            'status' => 'dirty'
        ]);

        return back()->with('success', 'Check-out berhasil');
    }

    


}
