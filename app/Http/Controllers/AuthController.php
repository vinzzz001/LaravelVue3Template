<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Error;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
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
    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if (!$token = auth()->attempt($validated)) {
            return abort(401, 'Wrong Username or Password',  ['error' => 'Wrong Username or Password']);;
        }
        $user = $this->guard->userOrFail(); //This should always work, since the login succeeded.

        $responseData = [
            'status' => 'success',
            'user' => $user,
            // 'user' => new LoggedInUserResource($user),
        ];

        //? What does 'production' do here.
        $secureCookie = config('app.env') === 'production';

        return (new JsonResponse($responseData, Response::HTTP_OK))->cookie(self::COOKIE_NAME, "Bearer {$token}", 60 * 24 * 30, '/', '', $secureCookie, true);

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

    /**
     * Sends a reset mail to recover forgotten pasword using a reset token that is put in the database.
     *
     * @return void
     */
    public function forgot(ForgotPasswordRequest $request) {
        //recieve email to send to.
        $validated = $request->validated();


        $user = User::Where('email', $validated)->firstOrFail();

        //Create token
        $token = substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(32))), 0, 32);

        //put token in user database
        $user->reset_token = $token;
        $user->push();

        //mail link + token
        $mail = Mail::to('vinzzz001@gmail.com')->send(new ResetPasswordMail($user, $token));


        return response()->json(['message' => 'Response Mail Send']);
    }


    /**
     * Resets the password of the user
     *
     * @return void
     */
    public function reset(ResetPasswordRequest $request) //token?
    {
        $validated = $request->validated();

        //The user that should have the reset token.
        $user = User::firstWhere('email', $validated['email']);

        //Token needs to be the same and not null to allow for password reset.
        if($user->reset_token != $validated["token"] || $user->reset_token == null) return abort(422, 'reset-token mismatch');

        //Set password and reset token
        $user->password =  password_hash($validated['password'], PASSWORD_BCRYPT);
        $user->reset_token = null;
        $user->push();

        return;
    }
}
