<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->old('email') ?? 'unknown';
        $ip = $request->ip();
        $key = "login:{$email}:{$ip}";
        $maxAttempts = 5;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);

            return view('backend.locked', ['minutes' => $minutes]);
        }

        return view('backend.login');
    }


    public function authenticate(Request $request)
    {

        $key = 'login:'.$request->ip();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            RateLimiter::clear($key);
            $request->session()->regenerate();
            return redirect()->intended('/backend/beranda');
        }

        RateLimiter::hit($key, 900);
        $remaining = 5 - RateLimiter::attempts($key);

        return back()->with('loginError', 'Email atau password salah. Sisa percobaan: '.$remaining);
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');

    }
}
