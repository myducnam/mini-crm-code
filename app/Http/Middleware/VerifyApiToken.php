<?php

namespace App\Http\Middleware;

use Closure;

class VerifyApiToken
{
    /**
     * Handle an incoming request from client.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        if ($token !== config('api.api_key')) {
            return response()->unauthenticated('Token invalid.');
        }

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET')
            ->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, X-Token-Auth, Authorization');
    }
}
