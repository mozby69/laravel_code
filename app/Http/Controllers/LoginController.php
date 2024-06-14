<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function main_page()
    {
        // This is your main page after login
        return view('home');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to the main page
            return redirect()->route('home');
        } else {
            // Authentication failed, redirect back to login with an error message
            return redirect('/')->with('error', 'Incorrect email or password');
        }
    }

    public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); // Redirect to home page after logout
    }

}
