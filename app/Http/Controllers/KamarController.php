<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $kamars = Kamar::latest()->paginate(10);
        return view('kamar.index', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'nomor_kamar' => 'required|string|max:10',
        'tipe_kamar' => 'required|string|max:50',
        'harga' => 'required|numeric',
        'status' => 'required|in:tersedia,terisi,maintenance'
    ]);

    Kamar::create($validated);

    return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar): View
    {
        return view('kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar): View
    {
        return view('kamar.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar): RedirectResponse
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|max:10',
            'tipe_kamar' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'status' => 'required|in:tersedia,terisi,maintenance'
        ]);

        $kamar->update($validated);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar): RedirectResponse
    {
        $kamar->delete();

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus!');
    }
}