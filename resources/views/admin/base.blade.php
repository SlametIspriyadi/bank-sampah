<!-- resources/views/admin/base.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-white">
    <div class="flex">
        @include('admin.partials.sidebar')
        <main class="flex-1 ml-64 min-h-screen p-8">
            <header class="mb-6">
                <h1 class="text-2xl font-bold">@yield('header', 'Dashboard')</h1>
            </header>
            <section>
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>

<!-- Sidebar -->
<aside class="sidebar">
    <!-- ...menu lain... -->
    <a href="{{ route('admin.laporan.index') }}" class="sidebar-link">Laporan</a>
    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100 rounded">Logout</button>
    </form>
</aside>
