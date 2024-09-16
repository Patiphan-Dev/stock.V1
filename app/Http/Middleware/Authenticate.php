<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!auth()->check()) {
            return redirect()->route('getLogin')->with('error', 'คุณต้องเข้าสู่ระบบเพื่อเข้าถึงหน้านี้');
        }
        return $request->expectsJson() ? null : route('login');
    }
}
