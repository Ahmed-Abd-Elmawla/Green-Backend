<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = auth('admin')->user();
        if($admin->require_login){
            return response()->json(['status' => 405, 'data' => null, 'message' => __('api.not_auth_login')], 405);
        }
        elseif($admin && $admin->is_active && !$admin->is_banned){
            return $next($request);
        }
        elseif($admin && !$admin->is_active){
            return response()->json(['status' => 403, 'data' => null, 'message' => __('api.auth.account_have_deactivated')], 403);
        }
        elseif($admin && $admin->is_banned){
            return response()->json(['status' => 405, 'data' => null, 'message' => __('api.auth.account__banned')], 403);
        }
        else{
            return response()->json(['status' => 405, 'data' => null, 'message' => __('api.auth.incorrect_registration')], 405);
        }
    }
}
