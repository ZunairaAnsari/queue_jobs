<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    // Show the reset form and store the token in session
    public function showResetForm($token)
    {
        session(['token' => $token]); // Store token in session
        return view('auth.passwords.reset');
    }

    // Handle the reset request
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:3',
        ]);

        // Retrieve token from session
        $token = session('token');

        $response = Password::reset(
            array_merge($request->only('email', 'password', 'password_confirmation'), ['token' => $token]),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        // Clear session token after reset
        session()->forget('token');

        // Redirect based on success or failure of reset
        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }
}
