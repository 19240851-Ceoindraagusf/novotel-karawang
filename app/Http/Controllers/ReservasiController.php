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
}
