<?php

namespace App\Http\Middleware;

use App\Utils\CacheUtils;
use App\Utils\SessionUtils;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSessionIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $unprotectedPath = ['auth/login', 'auth/change-password'];

        if (SessionUtils::isExist()) {
            if (in_array($request->path(), $unprotectedPath)) {
                return redirect()->route("dashboard");
            }

            return $next($request);
        }

        if (in_array($request->path(), $unprotectedPath)) {
            return $next($request);
        }
        return redirect()->route("login");
    }
}
