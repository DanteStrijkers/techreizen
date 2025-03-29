<?php

use App\Http\Middleware\Localization;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\UserAccess;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'user-access' => UserAccess::class,
            'localization' => Localization::class,
        ]);

        $middleware->appendToGroup('web', [
            'localization', // add localisation middleware to web group so it runs *after* StartSession
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
