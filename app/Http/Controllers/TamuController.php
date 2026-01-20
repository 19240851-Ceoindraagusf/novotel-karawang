<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;

class TamuController extends Controller
{
 public function index()
{
   $tamus = Tamu::with('reservasis')->get();

    return view('tamu.index', compact('tamus'));
}

    public function create()
    {
        return view('tamu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|email|unique:tamus,email',
        ]);

        Tamu::create($request->only(['nama', 'alamat', 'telepon', 'email']));

        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil ditambahkan.');
    }

   // Untuk halaman edit
public function edit(Tamu $tamu)
{
    return view('tamu.edit', compact('tamu'));
}

// Untuk update
public function update(Request $request, Tamu $tamu)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'telepon' => 'required|string',
        'email' => 'required|email|unique:tamus,email,' . $tamu->id,
    ]);

    $tamu->update($request->only(['nama', 'alamat', 'telepon', 'email']));

    return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil diperbarui.');
}

    public function destroy(Tamu $tamu)
    {
        $tamu->delete();
        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil dihapus.');
    }
}