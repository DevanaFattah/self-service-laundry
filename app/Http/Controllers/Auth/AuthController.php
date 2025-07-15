<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends Controller
{
    public function index () {
        return view('auth.index');
    }   

    public function auth(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
    
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
    
                return redirect()->intended('/v1/dashboard');
            }
    
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
        ]   )->onlyInput('email');
        }
        
        catch (Throwable $t) {
            $t->getMessage();
        }
    }
}
