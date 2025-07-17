<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Bank Sampah</title>
    
    {{-- Memuat Tailwind CSS dari CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    {{-- Font dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans antialiased">
    
    <div class="min-h-screen">
        {{-- Memanggil Sidebar --}}
        @include('user.partials.sidebar')

        {{-- Konten Utama --}}
        {{-- Kelas 'ml-64' memberi margin kiri agar konten tidak tertutup sidebar --}}
        <main class="ml-64">
            <div class="p-6 sm:p-8">
                <header class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">
                        @yield('header')
                    </h1>
                </header>
                <section>
                    @yield('content')
                </section>
            </div>
        </main>
    </div>

    {{-- Tempat untuk script tambahan dari halaman lain --}}
    @stack('scripts')
</body>
</html>