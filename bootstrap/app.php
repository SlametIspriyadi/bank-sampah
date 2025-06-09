<?php

// bootstrap/app.php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\NoCacheHeaders; // Import middleware Anda

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Daftarkan middleware Anda di sini
        $middleware->alias([
            'no.cache' => NoCacheHeaders::class, // Ini adalah pendaftaran alias middleware Anda
        ]);

        // Atau, jika Anda ingin menambahkannya ke grup middleware web secara global:
        // $middleware->web(append: [
        //     NoCacheHeaders::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
