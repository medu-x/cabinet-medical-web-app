<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && is_null($user->email_verified_at)) {
            session(['verify_email' => $user->email]);
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('email.verify.form')
                ->with('info', 'Veuillez vérifier votre adresse email avant de continuer.');
        }

        return $next($request);
    }
}
