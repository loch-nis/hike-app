<?php

use App\Http\Middleware\ApiAuthenticate;
use App\Http\Middleware\RedirectIfAuthenticatedApi;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            '/api/hikes',
            '/api/hikes/*',
            '/api/personal-checklist-items/*',
            '/api/common-checklist-items/*',
            '/api/auth/*',
            // todo set up CSRF !!!
        ]);
        $middleware->alias([
            'guest.api' => RedirectIfAuthenticatedApi::class,
            'jwt.auth' => ApiAuthenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
