<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Kosan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-200">
    
    <nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shadow-sm transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
            
                <div class="flex items-center">
                
                    <div class="flex-shrink-0 flex items-center h-16 mr-8">
                        <a href="/" class="text-2xl font-black tracking-tighter text-blue-600 dark:text-blue-400">
                            Pembina<span class="text-gray-900 dark:text-white">Kost</span>
                        </a>
                    </div>
                
                    @auth
                    <div class="hidden md:flex space-x-6 h-16">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ url('/admin') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-1 py-2 text-sm font-medium inline-flex items-center h-full transition border-b-2 border-transparent hover:border-gray-300">
                                Panel Admin
                            </a>
                        @else
                            <a href="/" class="{{ request()->is('/') ? 'text-blue-600 dark:text-blue-400 font-bold border-b-2 border-blue-600 dark:border-blue-400' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600' }} px-1 py-2 text-sm font-medium inline-flex items-center h-full transition">
                                Dashboard
                            </a>
                            <a href="{{ route('riwayat') }}" class="{{ request()->is('riwayat*') ? 'text-blue-600 dark:text-blue-400 font-bold border-b-2 border-blue-600 dark:border-blue-400' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600' }} px-1 py-2 text-sm font-medium inline-flex items-center h-full transition">
                                Riwayat Pemesanan
                            </a>
                        @endif
                    </div>
                    @endauth
                </div>

                <div class="flex items-center">
                    @auth
                        <div x-data="{ open: false }" class="relative ml-3">
                            <div>
                                <button @click="open = !open" type="button" class="flex items-center max-w-xs text-sm bg-gray-100 dark:bg-gray-800 p-2 px-3 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition focus:outline-none">
                                    <span class="mr-2 font-medium text-gray-700 dark:text-gray-200">
                                        {{ auth()->user()->name ?? 'Penghuni' }}
                                    </span>
                                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </div>

                            <div x-show="open" 
                                 @click.away="open = false" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-50 mt-2 w-56 origin-top-right rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-1 shadow-lg focus:outline-none" 
                                style="display: none;">
                            
                                <div x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" 
                                     x-init="$watch('darkMode', val => { localStorage.setItem('theme', val ? 'dark' : 'light'); document.documentElement.classList.toggle('dark', val) })" 
                                     class="flex items-center justify-between px-3 py-2 text-xs text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700 mb-1">
                                    <span>Mode Tema</span>
                                    <div class="flex items-center bg-gray-100 dark:bg-gray-700 p-0.5 rounded-lg space-x-0.5">
                                        <button @click="darkMode = false" :class="!darkMode ? 'bg-white dark:bg-gray-600 text-yellow-500 shadow-sm' : 'text-gray-400'" class="p-1 rounded-md transition focus:outline-none">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 14.05a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm-.707-8.485a1 1 0 010-1.414l.707-.707a1 1 0 111.414 1.414l-.707.707a1 1 0 01-1.414 0zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z"/></svg>
                                        </button>
                                        <button @click="darkMode = true" :class="darkMode ? 'bg-white dark:bg-gray-600 text-blue-500 shadow-sm' : 'text-gray-400'" class="p-1 rounded-md transition focus:outline-none">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                                        </button>
                                    </div>
                                </div>

                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md transition">
                                    Edit Profil
                                </a>

                                <form method="POST" action="{{ route('logout') }}" class="block w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 rounded-md transition font-medium">
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold mr-4 transition">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-bold shadow-md transition">Daftar</a>
                        @endif
                    @endauth
                </div>

            </div>
        </div>
    </nav>
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white text-center py-20 px-4 shadow-inner">
        <h2 class="text-4xl md:text-5xl font-extrabold mb-4">Temukan Kamar Kos Idamanmu!</h2>
        <p class="text-lg md:text-xl font-light mb-8 max-w-2xl mx-auto">Fasilitas lengkap, lokasi strategis, dan harga terjangkau untuk mahasiswa & pekerja. Pesan sekarang sebelum kehabisan!</p>
    </div>

    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-16">
            <h3 class="text-3xl font-bold text-gray-800 dark:text-white">Pilihan Tipe Kamar Kami</h3>
            <div class="w-24 h-1 bg-blue-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="mb-16">
            <div class="flex items-center justify-between mb-6 border-b-2 border-gray-200 dark:border-gray-700 pb-3">
                <h4 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Tipe Premium (Ukuran 4 x 4)</h4>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($kamar as $k)
                    @if(str_contains(strtolower($k->nomor_kamar), '4 x 4'))
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-1 transition duration-300 flex flex-col">
                            <div class="h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center relative">
                                <span class="text-gray-400 dark:text-gray-500 font-medium">Foto Kamar</span>
                                @if(strtolower($k->status) == 'tersedia')
                                    <span class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">Tersedia</span>
                                @else
                                    <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">Penuh</span>
                                @endif
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <h4 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-3">{{ $k->nomor_kamar }}</h4>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 flex-grow">
                                    <span class="font-semibold text-gray-700 dark:text-gray-300 block mb-1">Fasilitas:</span>
                                    {{ $k->fasilitas }}
                                </p>
                                <div class="text-2xl font-extrabold text-blue-600 dark:text-blue-400 mb-6">
                                    Rp {{ number_format($k->harga, 0, ',', '.') }}<span class="text-sm text-gray-500 dark:text-gray-400 font-normal">/bln</span>
                                </div>
                                @if(strtolower($k->status) == 'tersedia')
                                    <a href="{{ route('booking.create', $k->id) }}" class="block text-center w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-200">Booking Sekarang</a>
                                @else
                                    <button class="w-full bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 font-bold py-3 rounded-xl cursor-not-allowed" disabled>Kamar Sudah Terisi</button>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-6 border-b-2 border-gray-200 dark:border-gray-700 pb-3">
                <h4 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Tipe Standard (Ukuran 3 x 3)</h4>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($kamar as $k)
                    @if(str_contains(strtolower($k->nomor_kamar), '3 x 3'))
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-1 transition duration-300 flex flex-col">
                            <div class="h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center relative">
                                <span class="text-gray-400 dark:text-gray-500 font-medium">Foto Kamar</span>
                                @if(strtolower($k->status) == 'tersedia')
                                    <span class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">Tersedia</span>
                                @else
                                    <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">Penuh</span>
                                @endif
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <h4 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-3">{{ $k->nomor_kamar }}</h4>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 flex-grow">
                                    <span class="font-semibold text-gray-700 dark:text-gray-300 block mb-1">Fasilitas:</span>
                                    {{ $k->fasilitas }}
                                </p>
                                <div class="text-2xl font-extrabold text-blue-600 dark:text-blue-400 mb-6">
                                    Rp {{ number_format($k->harga, 0, ',', '.') }}<span class="text-sm text-gray-500 dark:text-gray-400 font-normal">/bln</span>
                                </div>
                                @if(strtolower($k->status) == 'tersedia')
                                    <a href="{{ route('booking.create', $k->id) }}" class="block text-center w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-200">Booking Sekarang</a>
                                @else
                                    <button class="w-full bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 font-bold py-3 rounded-xl cursor-not-allowed" disabled>Kamar Sudah Terisi</button>
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