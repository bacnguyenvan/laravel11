<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenKeyIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKeyApp = config('api.api_key');
        $apiKeyAuth = $request->header('x-api-key');
        if ($apiKeyApp != $apiKeyAuth) {
            return response()->json([
                'errors' => "Unauthorized",
                'status_code' => 401
            ], 401);
        }

        return $next($request);
    }
}
