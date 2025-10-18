<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (AuthenticationException $e, Request $request) {
            // Debug: Log what's happening
            Log::info('AuthenticationException caught', [
                'path' => $request->path(),
                'is_management' => $request->is('management/*'),
                'route_name' => $request->route()?->getName(),
            ]);

            if ($request->is('management/*')) {
                return redirect()->route('management.login');
            }

            return redirect()->route('login');
        });
    })->create();
