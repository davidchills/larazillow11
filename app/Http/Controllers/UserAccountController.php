<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends \Illuminate\Routing\Controller
{
    public function create() {
        return Inertia::render('UserAccount/Create');
    }

    public function store(Request $request) {
        $user = User::create($request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]));

        Auth::login($user);
        //event(new Registered($user));

        return redirect()->route('listing.index')
            ->with('success', 'User created successfully.');
    }
}
