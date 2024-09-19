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

        // Check if the user exists
        $user = User::where('username', $fields['username'])->first();

        if (!$user) {
            // User not found
            return redirect()->back()->with('error', 'ชื่อผู้ใช้ไม่ถูกต้อง');
        }

        // Attempt to log in the user with the provided credentials and "Remember Me" functionality
        if (Auth::attempt(['username' => $fields['username'], 'password' => $fields['password']])) {
            return redirect()->intended('/dashboard'); // Change to your desired route
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
