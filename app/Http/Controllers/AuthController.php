<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use PHPOpenSourceSaver\JWTAuth\JWTGuard;

class AuthController extends Controller
{
    private const COOKIE_NAME = 'Authorization';
    private JWTGuard $guard;

    /**
     * Create a new AuthController instance.
     *
     * @param Guard $guard
     * @return void
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }



    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = $this->guard->userOrFail();

        $responseData = [
            'status' => 'success',
            'user' => $user,
            // 'user' => new LoggedInUserResource($user),
        ];

        //todo: ask what this 'production' does here. 
        $secureCookie = config('app.env') === 'production';

        return (new JsonResponse($responseData, Response::HTTP_OK))
            ->cookie(self::COOKIE_NAME, "Bearer {$token}", 60 * 24 * 30, '/', '', $secureCookie, true);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(
            auth()->user(),
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
}
