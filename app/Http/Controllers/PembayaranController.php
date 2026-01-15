<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('reservasi')->get();
        return view('pembayaran.index', compact('pembayarans'));
    }

    public function create($reservasi_id)
    {
        $reservasi = Reservasi::findOrFail($reservasi_id);
        return view('pembayaran.create', compact('reservasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservasi_id' => 'required',
            'tanggal_bayar' => 'required|date',
            'total_bayar' => 'required|numeric',
            'metode_bayar' => 'required'
        ]);

        Pembayaran::create([
            'reservasi_id' => $request->reservasi_id,
            'tanggal_bayar' => $request->tanggal_bayar,
            'total_bayar' => $request->total_bayar,
            'metode_bayar' => $request->metode_bayar,
            'status' => 'lunas'
        ]);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil disimpan');
    }
}
