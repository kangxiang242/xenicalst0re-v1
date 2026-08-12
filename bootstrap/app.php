<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'defend' => \App\Http\Middleware\DefendMiddleware::class,
            'redirect.device' => \App\Http\Middleware\RedirectDeviceMiddleware::class,
            'access.log' => \App\Http\Middleware\AccessLogMiddleware::class,
            'googlebot.checked' => \App\Http\Middleware\GooglebotChecked::class,
        ]);

                $middleware->web(
            prepend: [
                \App\Http\Middleware\AccessLogMiddleware::class,
            ],
            replace: [
                \Illuminate\Cookie\Middleware\EncryptCookies::class => \App\Http\Middleware\EncryptCookies::class,
                \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class => \App\Http\Middleware\VerifyCsrfToken::class,
            ],
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
