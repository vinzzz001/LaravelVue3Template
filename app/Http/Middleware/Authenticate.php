<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Response;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;

// TODO :: refactor
class Authenticate extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // TODO :: not the best way. but it works
        if ($cookie = $request->cookie('Authorization')) {
            $request->headers->set('Authorization', $cookie);
        }

        try {
            $this->auth->parseToken()->authenticate();
        } catch (Exception $e) {
            $status = $e->getMessage();

            // $status = 'Authorization Token not found';
            // if ($e instanceof TokenInvalidException) {
            //     $status = 'Authorization Token is not valid';
            // } elseif ($e instanceof TokenExpiredException) {
            //     $status = 'Authorization Token has expired';
            // }


            return response()->json(['errors' => $status], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
