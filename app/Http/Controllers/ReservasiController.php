<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Tamu;
use App\Models\Kamar;
use Illuminate\Http\Request;

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
    $request->validate([
        'tamu_id'   => 'required|integer|exists:tamus,id',
        'kamar_id'  => 'required|integer|exists:kamars,id',
        'check_in'  => 'required|date',
        'check_out' => 'required|date|after:check_in',
    ]);

    $kamar = \App\Models\Kamar::findOrFail($request->kamar_id);

    $checkIn = \Carbon\Carbon::parse($request->check_in);
    $checkOut = \Carbon\Carbon::parse($request->check_out);
    $jumlahHari = $checkOut->diffInDays($checkIn);

    $totalBayar = $kamar->harga * $jumlahHari; // ✅ Hitung total bayar

    Reservasi::create([
        'tamu_id'     => $request->tamu_id,
        'kamar_id'    => $request->kamar_id,
        'check_in'    => $request->check_in,
        'check_out'   => $request->check_out,
        'total_bayar' => $totalBayar,
        'metode_pembayaran' => $request->metode_pembayaran,
        'status_pembayaran' => $request->status_pembayaran,
    ]);

    return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil ditambahkan.');
}

   public function edit(Reservasi $reservasi)
{
    $tamus = \App\Models\Tamu::all();
    $kamars = \App\Models\Kamar::all();
    return view('reservasi.edit', compact('reservasi', 'tamus', 'kamars'));
}

    public function update(Request $request, Reservasi $reservasi)
    {
        $request->validate([
            'tamu_id'   => 'required',
            'kamar_id'  => 'required',
            'check_in'  => 'required',
            'check_out' => 'required',
        ]);

        $reservasi->update($request->all());
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diperbarui');
    }

    public function destroy(Reservasi $reservasi)
    {
        $reservasi->delete();
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dihapus');
    }
}
