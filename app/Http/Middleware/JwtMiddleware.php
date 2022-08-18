<?php

namespace App\Http\Middleware;

use Exception;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Closure;
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
            if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'message' => 'Token is Invalid',
                    'data' => ''
                ]);
            } else if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'message' => 'Token is Expired',
                    'data' => '',
                ]);
            }
            else if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'message' => 'Token is Rejected',
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
