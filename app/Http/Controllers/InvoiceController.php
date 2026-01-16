<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;

class InvoiceController extends Controller
{
    public function cetak($id)
    {
        $reservasi = Reservasi::with('tamu', 'kamar')->findOrFail($id);

        return view('invoice.cetak', compact('reservasi'));
    }
}
