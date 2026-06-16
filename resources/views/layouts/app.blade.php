<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PembinaKost') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors duration-200">
            
            <nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shadow-sm transition-colors duration-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        
                        <div class="flex items-center">
                            
                            <div class="flex-shrink-0 flex items-center h-16 mr-8">
                                <a href="/" class="text-2xl font-black tracking-tighter text-blue-600 dark:text-blue-400">
                                    Pembina<span class="text-gray-900 dark:text-white">Kost</span>
                                </a>
                            </div>
                            
                            <div class="hidden md:flex space-x-6 h-16">
                                <a href="/" 
                                   class="{{ request()->is('/') ? 'text-blue-600 dark:text-blue-400 font-bold border-b-2 border-blue-600 dark:border-blue-400' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600' }} px-1 text-sm font-medium inline-flex items-center h-full transition">
                                    Dashboard
                                </a>
                                <a href="/riwayat" 
                                   class="{{ request()->is('riwayat*') ? 'text-blue-600 dark:text-blue-400 font-bold border-b-2 border-blue-600 dark:border-blue-400' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600' }} px-1 text-sm font-medium inline-flex items-center h-full transition">
                                    Riwayat Pemesanan
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center">
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
                        </div>

                    </div>
                </div>
            </nav>
            
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 dark:text-white">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>