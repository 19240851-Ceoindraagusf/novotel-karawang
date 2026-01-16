<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function cetak($id)
    {
        $reservasi = Reservasi::with('tamu', 'kamar')->findOrFail($id);

        $pdf = Pdf::loadView('invoice.cetak', compact('reservasi'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Invoice-Novotel-Karawang.pdf');
        // kalau mau auto download:
        // return $pdf->download('Invoice-Novotel-Karawang.pdf');
    }
}
