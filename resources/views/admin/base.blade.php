<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Bank Sampah</title>

    {{-- Memuat Tailwind CSS dari CDN untuk kemudahan --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    {{-- Anda bisa juga menggunakan Vite jika sudah di-setup --}}
    {{-- @vite('resources/css/app.css') --}}

    {{-- Font dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    {{-- Style kustom jika diperlukan --}}
    <style>
        /* Anda bisa menambahkan style tambahan di sini jika perlu */
    </style>
</head>
<body class="bg-white-100 font-sans antialiased">
    
    <div class="min-h-screen">
        
        {{-- 1. Memanggil Sidebar --}}
        {{-- Sidebar akan memiliki posisi 'fixed' dan lebar 'w-64' --}}
        @include('admin.partials.sidebar')

        {{-- 2. Konten Utama --}}
        {{-- [PERBAIKAN UTAMA] --}}
        {{-- Kelas 'ml-64' memberi margin kiri pada konten utama selebar sidebar. --}}
        {{-- Ini adalah kunci untuk mencegah konten menabrak sidebar. --}}
        <main class="ml-64">
            <div class="p-6 sm:p-8">
                
                {{-- Header Halaman --}}
                <header class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">
                        @yield('header', 'Dashboard')
                    </h1>
                </header>

                {{-- Konten dari setiap halaman (misal: tabel data nasabah) akan ditampilkan di sini --}}
                <section>
                    @yield('content')
                </section>

            </div>
        </main>
    </div>

    {{-- Tempat untuk script tambahan dari halaman lain (misal: Chart.js, script modal) --}}
    @stack('scripts')
</body>
</html>