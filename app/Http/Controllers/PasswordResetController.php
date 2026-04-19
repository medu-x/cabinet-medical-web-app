<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetCodeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    // ── Step 1: Show email form ──────────────────────────────────────────
    public function showRequestForm()
    {
        return view('auth.forgot-password');
    }

    // ── Step 2: Generate code, save to user, send email ─────────────────
    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Aucun compte trouvé avec cette adresse email.',
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate 6-digit code and expiry (10 minutes from now)
        $code   = rand(100000, 999999);
        $expiry = now()->addMinutes(10)->format('Y-m-d H:i:s');

        // Store as "CODE|EXPIRY" in the users table
        $user->update([
            'password_reset_token' => $code . '|' . $expiry,
        ]);

        // Send the code by email
        Mail::to($user->email)->send(new PasswordResetCodeMail($code, $user->name));

        // Store email in session so the next steps know who we're resetting for
        session(['reset_email' => $user->email]);

        return redirect()->route('password.verify')
            ->with('success', 'Un code à 6 chiffres a été envoyé à ' . $user->email);
    }

    // ── Step 3: Show code verification form ────────────────────────────
    public function showVerifyForm()
    {
        // Guard: must have come from sendCode step
        if (! session('reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-code');
    }

    // ── Step 3b: Resend a fresh code using the email already in session ──
    public function resendCode()
    {
        $email = session('reset_email');

        // If session expired, send them back to enter email again
        if (! $email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Session expirée. Veuillez recommencer.']);
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            return redirect()->route('password.request');
        }

        // Generate a brand new code and expiry — overwrites the old one
        $code   = rand(100000, 999999);
        $expiry = now()->addMinutes(10)->format('Y-m-d H:i:s');

        $user->update([
            'password_reset_token' => $code . '|' . $expiry,
        ]);

        Mail::to($user->email)->send(new PasswordResetCodeMail($code, $user->name));

        return redirect()->route('password.verify')
            ->with('success', 'Un nouveau code a été envoyé à ' . $email);
    }

    // ── Step 4: Verify the code ─────────────────────────────────────────
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $email = session('reset_email');

        if (! $email) {
            return redirect()->route('password.request')
                ->withErrors(['code' => 'Session expirée. Recommencez.']);
        }

        $user = User::where('email', $email)->first();

        if (! $user || ! $user->password_reset_token) {
            return back()->withErrors(['code' => 'Aucun code trouvé. Recommencez.']);
        }

        [$storedCode, $expiry] = explode('|', $user->password_reset_token);

        // Check if expired
        if (now()->isAfter($expiry)) {
            $user->update(['password_reset_token' => null]);
            return back()->withErrors(['code' => 'Ce code a expiré. Demandez un nouveau code.']);
        }

        // Check if code matches
        if ($request->code !== $storedCode) {
            return back()->withErrors(['code' => 'Code incorrect. Vérifiez votre email.']);
        }

        // Mark session as verified so reset page is accessible
        session(['reset_verified' => true]);

        return redirect()->route('password.reset');
    }

    // ── Step 5: Show new password form ──────────────────────────────────
    public function showResetForm()
    {
        if (! session('reset_email') || ! session('reset_verified')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    // ── Step 6: Save new password ────────────────────────────────────────
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = session('reset_email');

        if (! $email || ! session('reset_verified')) {
            return redirect()->route('password.request');
        }

        $user = User::where('email', $email)->first();

        $user->update([
            'password'             => Hash::make($request->password),
            'password_reset_token' => null, // Clean up
        ]);

        // Clear session flags
        session()->forget(['reset_email', 'reset_verified']);

        return redirect()->route('login')
            ->with('success', 'Mot de passe réinitialisé avec succès. Connectez-vous.');
    }
}
