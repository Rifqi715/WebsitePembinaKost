<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Kosan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">
    
    <nav class="bg-white shadow-md py-4 px-6 md:px-12 flex justify-between items-center">
        <h1 class="text-2xl font-extrabold text-blue-600 tracking-tight">KOS<span class="text-gray-800">KU</span></h1>
        <div>
            @if (Route::has('login'))
                @auth
                    {{-- Logika jika yang login adalah Bapak Kos --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ url('/admin') }}" class="text-gray-600 hover:text-blue-600 font-semibold mr-6 transition">Panel Admin</a>
                    {{-- Logika jika yang login adalah Anak Kos --}}
                    @else
                        <a href="{{ route('riwayat') }}" class="text-gray-600 hover:text-blue-600 font-semibold mr-6 transition">Riwayat Pemesanan</a>
                    @endif
                    
                    {{-- Tombol Logout Universal (Wajib pakai form & @csrf buat keamanan) --}}
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg font-bold shadow-md transition cursor-pointer">Keluar</button>
                    </form>
                @else
                    {{-- Tampilan kalau belum login sama sekali --}}
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-semibold mr-6 transition">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-bold shadow-md transition">Daftar</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white text-center py-20 px-4 shadow-inner">
        <h2 class="text-4xl md:text-5xl font-extrabold mb-4">Temukan Kamar Kos Idamanmu!</h2>
        <p class="text-lg md:text-xl font-light mb-8 max-w-2xl mx-auto">Fasilitas lengkap, lokasi strategis, dan harga terjangkau untuk mahasiswa & pekerja. Pesan sekarang sebelum kehabisan!</p>
    </div>

    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-16">
            <h3 class="text-3xl font-bold text-gray-800">Pilihan Tipe Kamar Kami</h3>
            <div class="w-24 h-1 bg-blue-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="mb-16">
            <div class="flex items-center justify-between mb-6 border-b-2 border-gray-200 pb-3">
                <h4 class="text-2xl font-bold text-gray-800">Tipe Premium (Ukuran 4 x 4)</h4>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($kamar as $k)
                    @if(str_contains(strtolower($k->nomor_kamar), '4 x 4'))
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-300 flex flex-col">
                            <div class="h-48 bg-gray-200 flex items-center justify-center relative">
                                <span class="text-gray-400 font-medium">Foto Kamar</span>
                                @if(strtolower($k->status) == 'tersedia')
                                    <span class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">Tersedia</span>
                                @else
                                    <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">Penuh</span>
                                @endif
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <h4 class="text-xl font-bold text-gray-800 mb-3">{{ $k->nomor_kamar }}</h4>
                                <p class="text-gray-600 text-sm mb-6 flex-grow">
                                    <span class="font-semibold text-gray-700 block mb-1">Fasilitas:</span>
                                    {{ $k->fasilitas }}
                                </p>
                                <div class="text-2xl font-extrabold text-blue-600 mb-6">
                                    Rp {{ number_format($k->harga, 0, ',', '.') }}<span class="text-sm text-gray-500 font-normal">/bln</span>
                                </div>
                                @if(strtolower($k->status) == 'tersedia')
                                    <a href="{{ route('booking.create', $k->id) }}" class="block text-center w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-200">Booking Sekarang</a>
                                @else
                                    <button class="w-full bg-gray-200 text-gray-500 font-bold py-3 rounded-xl cursor-not-allowed" disabled>Kamar Sudah Terisi</button>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-6 border-b-2 border-gray-200 pb-3">
                <h4 class="text-2xl font-bold text-gray-800">Tipe Standard (Ukuran 3 x 3)</h4>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($kamar as $k)
                    @if(str_contains(strtolower($k->nomor_kamar), '3 x 3'))
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-300 flex flex-col">
                            <div class="h-48 bg-gray-200 flex items-center justify-center relative">
                                <span class="text-gray-400 font-medium">Foto Kamar</span>
                                @if(strtolower($k->status) == 'tersedia')
                                    <span class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">Tersedia</span>
                                @else
                                    <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">Penuh</span>
                                @endif
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <h4 class="text-xl font-bold text-gray-800 mb-3">{{ $k->nomor_kamar }}</h4>
                                <p class="text-gray-600 text-sm mb-6 flex-grow">
                                    <span class="font-semibold text-gray-700 block mb-1">Fasilitas:</span>
                                    {{ $k->fasilitas }}
                                </p>
                                <div class="text-2xl font-extrabold text-blue-600 mb-6">
                                    Rp {{ number_format($k->harga, 0, ',', '.') }}<span class="text-sm text-gray-500 font-normal">/bln</span>
                                </div>
                                @if(strtolower($k->status) == 'tersedia')
                                    <a href="{{ route('booking.create', $k->id) }}" class="block text-center w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-200">Booking Sekarang</a>
                                @else
                                    <button class="w-full bg-gray-200 text-gray-500 font-bold py-3 rounded-xl cursor-not-allowed" disabled>Kamar Sudah Terisi</button>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>

</body>
</html>