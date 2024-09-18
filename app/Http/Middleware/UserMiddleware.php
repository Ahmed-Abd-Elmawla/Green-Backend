<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('user')->check() && auth('user')->user()->is_active && !auth('user')->user()->is_banned) {
            return $next($request);
        } elseif (auth('user')->check() &&  auth('user')->user()->is_active  == 0) {
            return response()->json(['status' => 403, 'message' => __('Inactive Account'), 'data' => null], 422);
        } elseif (auth('user')->check() &&  auth('user')->user()->is_banned) {
            return response()->json(['status' => 403, 'message' => __('Banned Account'), 'data' => null], 405);
        } else {
            return response()->json(['status' => 401, 'message' => __('Incorrect registration credentials'), 'data' => null], 401);
        }
    }
}
