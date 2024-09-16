<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
  

class AuthController extends Controller
{
    // Login User
    public function login(Request $request)
    {
        // Validate input fields
        $fields = $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'min:6']
        ]);
    
        // Attempt to login the user with the provided credentials
        if (Auth::attempt(['username' => $fields['username'], 'password' => $fields['password']], $request->filled('remember'))) {
            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->with('error', 'รหัสผ่านผิด');
        }
    }

    // Logout User
    public function logout(Request $request)
    {
        // Logout the user
        Auth::logout();

        // Invalidate user's session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to home
        return redirect()->route('login');
    }
}
