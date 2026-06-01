<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Kamar Kos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-700">Daftar Kamar</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b-2 border-gray-200">
                                    <th class="p-3 font-semibold text-gray-700">Nama/Tipe Kamar</th>
                                    <th class="p-3 font-semibold text-gray-700">Fasilitas</th>
                                    <th class="p-3 font-semibold text-gray-700">Harga/Bulan</th>
                                    <th class="p-3 font-semibold text-gray-700 text-center">Status</th>
                                    <th class="p-3 font-semibold text-gray-700 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kamar as $k)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                                    <td class="p-3 font-medium text-gray-900">{{ $k->nomor_kamar }}</td>
                                    <td class="p-3 text-sm text-gray-600">{{ $k->fasilitas }}</td>
                                    <td class="p-3 text-sm font-semibold text-gray-800">Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
                                    <td class="p-3 text-center">
                                        <span class="px-3 py-1 text-xs font-bold text-green-800 bg-green-200 rounded-full">
                                            {{ strtoupper($k->status) }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        <a href="{{ route('kamar.edit', $k->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold text-sm">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($kamar->isEmpty())
                        <p class="text-gray-500 text-center mt-6">Belum ada data kamar. Silakan tambah kamar baru.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>