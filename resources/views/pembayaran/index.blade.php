<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Data Pembayaran</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Kamar</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Total</th>
                    <th class="border p-2">Metode</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayarans as $p)
                <tr>
                    <td class="border p-2">{{ $p->reservasi->id }}</td>
                    <td class="border p-2">{{ $p->tanggal_bayar }}</td>
                    <td class="border p-2">Rp {{ number_format($p->total_bayar) }}</td>
                    <td class="border p-2">{{ strtoupper($p->metode_bayar) }}</td>
                    <td class="border p-2 text-green-600">{{ $p->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
