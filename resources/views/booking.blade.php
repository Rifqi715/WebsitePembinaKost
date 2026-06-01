<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulir Booking Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-8 text-gray-900">
                    
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Detail Pesanan Kamu</h3>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8 shadow-inner">
                        <p class="text-lg font-bold text-gray-800 mb-1">Tipe: {{ $kamar->nomor_kamar }}</p>
                        <p class="text-gray-600 text-sm mb-3"><span class="font-semibold">Fasilitas:</span> {{ $kamar->fasilitas }}</p>
                        <p class="text-2xl font-extrabold text-blue-600">
                            Rp {{ number_format($kamar->harga, 0, ',', '.') }} <span class="text-sm font-normal text-gray-500">/ bulan</span>
                        </p>
                    </div>

                    <form action="{{ route('booking.store', $kamar->id) }}" method="POST">
                        @csrf <div class="mb-6">
                            <label for="tanggal_masuk" class="block text-sm font-bold text-gray-700 mb-2">Rencana Tanggal Masuk (Mulai Ngekos)</label>
                            
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm px-4 py-3" required min="{{ date('Y-m-d') }}">
                            
                            @error('tanggal_masuk')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-10">
                            <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-700 font-medium transition">← Batal & Kembali</a>
                            
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-md hover:shadow-lg transition duration-200">
                                Konfirmasi Booking
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>