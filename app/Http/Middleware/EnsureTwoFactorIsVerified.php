<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureTwoFactorIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // If user has 2FA enabled but hasn't verified, redirect them
        if ($user && $user->two_factor_secret && !$request->session()->has('2fa_passed')) {
            if (!$request->is('two-factor-challenge')) {
                return redirect()->route('two-factor.challenge');
            }
        }

        return $next($request);
    }
}
