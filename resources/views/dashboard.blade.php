<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Anak Kos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium flex items-center gap-2 shadow-sm">
                            <span>🎉</span>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-6">
                        <h3 class="text-xl font-bold text-gray-800 tracking-tight">Riwayat Booking Kamu</h3>
                        <span class="text-sm text-gray-500 font-medium bg-gray-50 px-3 py-1 rounded-full">
                            Total: {{ $bookings->count() }} Pesanan
                        </span>
                    </div>

                    @if($bookings->isEmpty())
                        <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200 my-4">
                            <div class="text-4xl mb-3">📭</div>
                            <p class="text-gray-500 font-medium mb-4">Kamu belum melakukan booking kamar apa pun.</p>
                            <a href="{{ url('/') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md hover:shadow-lg transition duration-200 text-sm">
                                Cari Kamar Sekarang
                            </a>
                        </div>
                    
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            @foreach($bookings as $b)
                                @php
                                    $isPending = $b->status == 'pending';
                                @endphp
                                
                                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-300 relative border border-gray-100 flex flex-col justify-between
                                    {{ $isPending ? 'border-l-4 border-l-amber-500' : 'border-l-4 border-l-emerald-500' }}">
                                    
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-0.5">Tipe Kamar</p>
                                            <p class="font-black text-2xl text-gray-800 tracking-tight">{{ $b->room->nomor_kamar }}</p>
                                        </div>
                                        
                                        <span class="px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider shadow-sm
                                            {{ $isPending ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                                            {{ str_replace('_', ' ', $b->status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="space-y-2.5 my-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-gray-400 mr-1">Rencana Masuk:</span>
                                            <span class="font-semibold text-gray-700">{{ \Carbon\Carbon::parse($b->tanggal_masuk)->format('d M Y') }}</span>
                                        </div>
                                        
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span class="text-gray-400 mr-1">Harga Sesuai:</span>
                                            <span class="font-bold {{ $isPending ? 'text-amber-600' : 'text-emerald-600' }}">
                                                Rp {{ number_format($b->room->harga, 0, ',', '.') }}
                                            </span>
                                            <span class="text-xs text-gray-400 font-normal ml-1">/ bulan</span>
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        @if($b->status == 'pending')
                                            <div class="flex items-center justify-center gap-2 text-xs font-bold text-amber-700 bg-amber-50/70 border border-amber-100 p-3 rounded-xl">
                                                <span>Menunggu persetujuan Bapak Kos ⏳</span>
                                            </div>
                                            
                                        @elseif($b->status == 'approved')
                                            <div class="mt-2 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                                                <p class="text-sm text-blue-900 font-bold mb-1">Booking Disetujui!</p>
                                                <p class="text-xs text-gray-700 mb-3">Segera transfer ke <strong>BCA 1234567890 a/n Bapak Kos</strong></p>
                                                
                                                <form action="{{ route('booking.bayar', $b->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-2">
                                                        <input type="file" name="bukti_transfer" required
                                                            class="block w-full text-xs text-gray-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer bg-white border border-gray-200 rounded-md">
                                                    </div>
                                                    
                                                    @error('bukti_transfer')
                                                        <p class="text-xs text-red-500 mt-1 mb-2">{{ $message }}</p>
                                                    @enderror

                                                    <button type="submit" class="w-full mt-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2 px-4 rounded-lg transition shadow-sm">
                                                        Kirim Bukti Transfer
                                                    </button>
                                                </form>
                                            </div>

                                        @elseif($b->status == 'menunggu_verifikasi')
                                            <div class="flex items-center justify-center gap-2 text-xs font-bold text-blue-700 bg-blue-50/70 border border-blue-100 p-3 rounded-xl">
                                                <span>⏳ Bukti sedang dicek Admin</span>
                                            </div>

                                        @elseif($b->status == 'lunas')
                                            <div class="flex items-center justify-center gap-2 text-xs font-bold text-emerald-700 bg-emerald-50/70 border border-emerald-100 p-3 rounded-xl">
                                                <span>Pembayaran Lunas! Selamat datang 🎉</span>
                                            </div>
                                            
                                        @elseif($b->status == 'ditolak')
                                            <div class="flex items-center justify-center gap-2 text-xs font-bold text-red-700 bg-red-50/70 border border-red-100 p-3 rounded-xl">
                                                <span>Pembayaran Ditolak. Silakan hubungi Admin. ❌</span>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>