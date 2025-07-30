<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AuthSanctum
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $bearer = str_replace('Bearer', '', $request->header('Authorization'));
            Log::info($bearer);
            $decrypted = Crypt::decryptString($bearer);
            $mixer = substr($decrypted, -5);

            $token = str_replace($mixer, '', $decrypted);
            $personalAccessToken = PersonalAccessToken::findToken($token);

            if ($bearer && $this->isValidToken($token)) {
                if ($personalAccessToken) {

                    $expiration = config('sanctum.expiration');
                    if ($expiration && $this->isTokenExpired($personalAccessToken, $expiration)) {
                        return response()->json(['message' => 'Token has expired'], 401);
                    }

                    $user = $personalAccessToken->tokenable;

                    Auth::setUser($user);
                    return $next($request);
                }
            }

            return response()->json(['message' => 'Invalid token'], 401);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Invalid Token'], 500);
        }
    }

    protected function isValidToken($token)
    {
        $personalAccessToken = PersonalAccessToken::findToken($token);
        return $personalAccessToken !== null;
    }

    protected function isTokenExpired(PersonalAccessToken $token, $expiration)
    {
        return $token->created_at->addMinutes($expiration)->isPast();
    }
}
