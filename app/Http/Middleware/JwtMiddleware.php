<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = auth()->guard('api')->user();
            if (! $user) {
                return response()->json(['error' => 'Usuario no autorizado'], 401);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Token no válido'], 401);
        }

        $request->attributes->add(['user' => $user]);

        return $next($request);
    }
}
