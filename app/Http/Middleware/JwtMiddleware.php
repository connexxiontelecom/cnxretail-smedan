<?php

namespace App\Http\Middleware;

use Exception;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;
class JwtMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'message' => 'Token is Invalid',
                    'data' => ''
                ]);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'message' => 'Token is Expired',
                    'data' => '',

                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'message' => 'Authorization Token not found',
                    'data' => ''
                ]);
            }
        }
        return $next($request);
    }
}
