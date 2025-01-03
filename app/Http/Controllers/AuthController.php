<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends \Illuminate\Routing\Controller
{
    public function create() {
        //return inertia('Auth/Login');
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request) {
        
        if (!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]), true)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.'
            ]);
        }
        
        /*
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials, true)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.'
            ]);
        }
        */

        $request->session()->regenerate();

        return redirect()->intended('/listing');
    }

    public function destroy(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('listing.index');

    }   
}
