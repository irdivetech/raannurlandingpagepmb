<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user()->role);
        }
        return view('parent.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'regNumber' => ['required'], // UI input name is 'regNumber'
            'password' => ['required'],
        ]);

        $loginInput = $credentials['regNumber'];
        $password = $credentials['password'];

        $email = null;
        if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
            // Logging in via Email (like admin or parent with email)
            $email = $loginInput;
        } else {
            // Logging in via Registration Number (parents only)
            $registration = \App\Models\Registration::where('reg_number', $loginInput)->first();
            if ($registration && $registration->user) {
                $email = $registration->user->email;
            }
        }

        if ($email && Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();
            return $this->redirectBasedOnRole(Auth::user()->role);
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('regNumber');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function redirectBasedOnRole($role)
    {
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('parent.dashboard');
    }
}
