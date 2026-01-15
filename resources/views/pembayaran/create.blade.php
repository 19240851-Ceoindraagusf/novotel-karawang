<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Pembayaran Reservasi #{{ $reservasi->id }}</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow max-w-xl">
        <form method="POST" action="{{ route('pembayaran.store') }}">
            @csrf

            <input type="hidden" name="reservasi_id" value="{{ $reservasi->id }}">

            <div class="mb-4">
                <label>Tanggal Bayar</label>
                <input type="date" name="tanggal_bayar" class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Total Bayar</label>
                <input type="number" name="total_bayar" class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Metode Bayar</label>
                <select name="metode_bayar" class="w-full border p-2">
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                    <option value="debit">Debit</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Bayar Sekarang
            </button>
        </form>
    </div>
</x-app-layout>
