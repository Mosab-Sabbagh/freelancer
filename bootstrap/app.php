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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'job_seeker' => \App\Http\Middleware\JobSeekerMiddleware::class,
            'job_poster' => \App\Http\Middleware\JobPosterMiddleware::class,
            'supporter' => \App\Http\Middleware\SupporterMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'role.redirect' => \App\Http\Middleware\RedirectIfAuthenticatedByRole::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
