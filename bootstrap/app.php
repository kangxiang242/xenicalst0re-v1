<?php

use App\Exceptions\ValidationFailedException;
use App\Http\JsonResponse;
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
        // 站点在 Cloudflare(Flexible SSL) 之后，origin 收 HTTP 请求，
        // 必须信任代理的 X-Forwarded-Proto 头，否则 asset()/Livewire 生成 http:// 资源被浏览器拦截(混合内容)
        $middleware->trustProxies(
            at: '*',
            headers: \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR
                | \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST
                | \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT
                | \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO,
        );

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
        // 前端统一用 fetch/jQuery ajax 提交表单，校验异常必须返回 JSON，否则前端 r.json() 解析失败报 500
        $exceptions->render(function (ValidationFailedException $e, $request) {
            return JsonResponse::make()->status(false)->statusCode(422)->message($e->getMessage())->send();
        });
    })->create();
