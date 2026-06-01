<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Anak Kos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-8 text-gray-900">
                    
                    <h3 class="text-xl font-bold mb-4 border-b pb-2">Riwayat Booking Kamu</h3>

                    @if($bookings->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">Kamu belum melakukan booking kamar apa pun.</p>
                            <a href="{{ url('/') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">Cari Kamar Sekarang</a>
                        </div>
                    
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            @foreach($bookings as $b)
                                <div class="border rounded-xl p-6 shadow-sm relative overflow-hidden {{ $b->status == 'pending' ? 'bg-yellow-50 border-yellow-200' : 'bg-green-50 border-green-200' }}">
                                    
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Tipe Kamar</p>
                                            <p class="font-extrabold text-2xl text-gray-800">{{ $b->room->nomor_kamar }}</p>
                                        </div>
                                        
                                        <span class="px-4 py-1 rounded-full text-xs font-bold capitalize tracking-wide shadow-sm
                                            {{ $b->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                            {{ $b->status }}
                                        </span>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-600"><span class="font-bold">Rencana Masuk:</span> {{ \Carbon\Carbon::parse($b->tanggal_masuk)->format('d M Y') }}</p>
                                        <p class="text-sm text-gray-600"><span class="font-bold">Harga:</span> Rp {{ number_format($b->room->harga, 0, ',', '.') }} / bulan</p>
                                    </div>

                                    @if($b->status == 'pending')
                                        <p class="text-xs font-semibold text-yellow-700 bg-yellow-100 p-2 rounded text-center">Menunggu persetujuan Bapak Kos ⏳</p>
                                    @else
                                        <p class="text-xs font-semibold text-green-700 bg-green-100 p-2 rounded text-center">Booking Diterima! Selamat datang 🎉</p>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>