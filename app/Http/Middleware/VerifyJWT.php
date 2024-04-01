<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Middleware\JWTAuth;

use Illuminate\Http\Request;

class VerifyJWT
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
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }
        
        try {
            // $decoded = JWT::decode($token, env('JWT_SECRET'), $algorithm);
            $decoded = JWTAuth::decode($token);
            dd($decoded);
            if ($decoded->exp < time()) {
                return response()->json(['message' => 'Token has expired'], 401);
            }
    
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid token'], 401);
        }
    
        return $next($request);
    }
}
