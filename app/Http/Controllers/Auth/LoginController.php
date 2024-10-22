<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

   
        if (Auth::attempt($request->only('email', 'password'))) {

            return redirect()->route('home'); 
        }

        // If the login fails, redirect back with an error
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function home()
    {
       $user = Auth::user();
       return view('home',compact('user'));
    }

    public function logout()
    {
        Auth::logout();

        // Redirect to a desired route (e.g., login page)
        return redirect()->route('login');
    }
}
