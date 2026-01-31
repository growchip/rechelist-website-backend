<?php

namespace App\Http\Middleware;

use Closure;

class CheckApiKey
{
    public function handle($request, Closure $next)
    {
        if ($request->header('X-API-KEY') !== config('app.api_key')) {
            return response()->json([
                'message' => 'Invalid or missing API key. Please provide a valid header.',
                'error' => 'Unauthorized',
            ], 401);
        }
        return $next($request);
    }
}
