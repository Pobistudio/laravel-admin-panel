<?php

use App\Http\Middleware\EnsurePermissionIsValid;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(['permissionIsValid' => EnsurePermissionIsValid::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, Request $request) {
            return redirect()->back()
                ->withInput($request->except('_token'))
                ->with('error', 'Sesi telah berakhir atau token kedaluwarsa. Silakan coba lagi.');
        });

         // 2. Tangani SEMUA Exception yang tersisa (catch-all)
        //$exceptions->report(function (Throwable $e) {
            // Logika untuk melaporkan atau mengirim notifikasi (misalnya ke Sentry/Log)
            // Anda dapat menaruh kode logging kustom di sini
        //});
    })->create();
