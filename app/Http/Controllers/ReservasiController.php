<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Tamu;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservasiController extends Controller
{
    /* ===============================
        INDEX
    =============================== */
    public function index()
    {
        $reservasi = Reservasi::with('tamu', 'kamar')->get();
        return view('reservasi.index', compact('reservasi'));
    }

    /* ===============================
        CREATE
    =============================== */
    public function create()
    {
        $tamus = Tamu::all();
        $kamars = Kamar::all();
        return view('reservasi.create', compact('tamus', 'kamars'));
    }

    /* ===============================
        STORE (HITUNG MALAM BENAR)
    =============================== */
    public function store(Request $request)
    {
        $kamar = Kamar::findOrFail($request->kamar_id);

        $checkIn  = Carbon::parse($request->check_in)->startOfDay();
        $checkOut = Carbon::parse($request->check_out)->startOfDay();

        // LOGIKA HOTEL: jumlah malam
        $jumlahMalam = max(1, $checkIn->diffInDays($checkOut));
        $totalHarga  = $jumlahMalam * $kamar->harga;

        Reservasi::create([
            'tamu_id' => $request->tamu_id,
            'kamar_id' => $request->kamar_id,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'total_harga' => $totalHarga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        // kamar otomatis ter-booking
        $kamar->update([
            'status' => 'reserved'
        ]);

        return redirect()->route('reservasi.index')
            ->with('success', 'Reservasi berhasil disimpan');
    }

    /* ===============================
        EDIT
    =============================== */
    public function edit(Reservasi $reservasi)
    {
        $tamus = Tamu::all();
        $kamars = Kamar::all();
        return view('reservasi.edit', compact('reservasi', 'tamus', 'kamars'));
    }

    /* ===============================
        UPDATE (TOTAL IKUT BERUBAH)
    =============================== */
    public function update(Request $request, Reservasi $reservasi)
    {
        $kamar = Kamar::findOrFail($request->kamar_id);

        $checkIn  = Carbon::parse($request->check_in)->startOfDay();
        $checkOut = Carbon::parse($request->check_out)->startOfDay();

        $jumlahMalam = max(1, $checkIn->diffInDays($checkOut));
        $totalHarga  = $jumlahMalam * $kamar->harga;

        $reservasi->update([
            'tamu_id' => $request->tamu_id,
            'kamar_id' => $request->kamar_id,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'total_harga' => $totalHarga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->route('reservasi.index')
            ->with('success', 'Reservasi berhasil diperbarui');
    }

    /* ===============================
        DELETE
    =============================== */
    public function destroy(Reservasi $reservasi)
    {
        $reservasi->kamar->update([
            'status' => 'available'
        ]);

        $reservasi->delete();

        return redirect()->route('reservasi.index')
            ->with('success', 'Reservasi berhasil dihapus');
    }

    /* ===============================
        CHECK-IN
    =============================== */
    public function checkIn($id)
    {
        $reservasi = Reservasi::with('kamar')->findOrFail($id);

        if ($reservasi->check_in_at !== null) {
            return back()->with('error', 'Tamu sudah check-in');
        }

        if ($reservasi->kamar->status !== 'reserved') {
            return back()->with('error', 'Kamar belum siap untuk check-in');
        }

        $reservasi->update([
            'check_in_at' => now()
        ]);

        $reservasi->kamar->update([
            'status' => 'occupied'
        ]);

        return back()->with('success', 'Check-in berhasil');
    }

    /* ===============================
        CHECK-OUT (PEMBAYARAN AKURAT)
    =============================== */
    public function checkout($id)
    {
        $reservasi = Reservasi::with('kamar')->findOrFail($id);

        if ($reservasi->check_out_at !== null) {
            return back()->with('error', 'Tamu sudah check-out');
        }

        $actualCheckout = now();

        // hitung jumlah malam SESUAI REAL
        $checkInDate = Carbon::parse($reservasi->check_in_at);
        $jumlahMalam = max(1, $checkInDate->diffInDays($actualCheckout));

        $hargaPerMalam = $reservasi->kamar->harga;
        $subtotal = $jumlahMalam * $hargaPerMalam;

        /* ===== DENDA ===== */
        $denda = 0;
        $limitCheckout = Carbon::parse($reservasi->check_out)->setTime(12, 0);

        if ($actualCheckout->greaterThan($limitCheckout)) {
            if ($actualCheckout->hour > 18) {
                $denda = $hargaPerMalam;
            } else {
                $denda = $hargaPerMalam * 0.5;
            }
        }

        /* ===== PAJAK & SERVICE ===== */
        $pajak   = ($subtotal + $denda) * 0.10;
        $service = ($subtotal + $denda) * 0.05;

        $grandTotal = $subtotal + $denda + $pajak + $service;

        /* ===== SIMPAN ===== */
        $reservasi->update([
            'check_out_at' => $actualCheckout,
            'total_harga' => $subtotal,
            'denda' => $denda,
            'pajak' => $pajak,
            'service_charge' => $service,
            'grand_total' => $grandTotal,
        ]);

        $reservasi->kamar->update([
            'status' => 'dirty'
        ]);

        return back()->with('success', 'Check-out berhasil');
    }
}
