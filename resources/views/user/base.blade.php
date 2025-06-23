<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bank Sampah - Nasabah')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('user.partials.sidebar')
        <!-- Main Content -->
        <main class="flex-1 bg-white ml-64 min-h-screen p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
