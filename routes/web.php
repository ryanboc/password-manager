<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        if (!session('2fa_passed') && auth()->user()->two_factor_secret) {
            return redirect('/two-factor-challenge');
        }
        return view('home');
    })->name('home');

    Route::get('/two-factor-challenge', function () {
        return view('auth.two-factor-challenge');
    })->name('two-factor.challenge');

    Route::post('/two-factor-challenge', function (Illuminate\Http\Request $request) {
        $user = auth()->user();
        $google2fa = new \PragmaRX\Google2FA\Google2FA();

        if (!$google2fa->verifyKey(decrypt($user->two_factor_secret), $request->code)) {
            return back()->withErrors(['code' => 'Invalid authentication code.']);
        }

        session(['2fa_passed' => true]);
        return redirect('/home');
    });

    Route::resource('passwords', PasswordController::class);

    Route::post('/user/two-factor-authentication', function (Request $request) {
        auth()->user()->enableTwoFactorAuthentication();
        return back()->with('success', '2FA Enabled!');
    });

    Route::delete('/user/two-factor-authentication', function (Request $request) {
        auth()->user()->disableTwoFactorAuthentication();
        return back()->with('success', '2FA Disabled!');
    });
});





