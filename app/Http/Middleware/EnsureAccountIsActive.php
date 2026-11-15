<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ($user->is_active ?? true) == false) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')
                ->withErrors(['username' => 'Akun Anda dinonaktifkan. Hubungi admin untuk mengaktifkannya kembali.'])
                ->with('error', 'Akun Anda dinonaktifkan. Hubungi admin untuk mengaktifkannya kembali.');
        }

        return $next($request);
    }
}