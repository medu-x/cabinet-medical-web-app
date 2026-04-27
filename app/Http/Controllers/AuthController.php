<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Patient;
use App\Models\DossierMedical;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;
use RuntimeException;

class AuthController extends Controller
{

    /**
     * Show the registration form (GET /register)
     * This just returns the Blade view — no logic needed.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle the registration form submission (POST /register)
     * This is where the real work happens:
     * 1. Validate → 2. Create user → 3. Login → 4. Redirect
     */
    public function register(Request $request)
    {
        // STEP 1: Validate the form data
        // If validation fails, Laravel AUTOMATICALLY redirects back to the form
        // with error messages — you don't need to write any if/else for that!
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|min:6|confirmed',
            'cin'               => 'required|string|max:20|unique:patients,cin',
            'telephone'         => 'nullable|string|max:20',
            'adresse'           => 'nullable|string|max:255',
            'date_naissance'    => 'nullable|date|before:today',
        ]);

        // STEP 2: Create the user in the database
        // Hash::make() encrypts the password so it's never stored as plain text
        // Example: "abc123" becomes "$2y$12$xK8f..." (impossible to reverse)
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'patient', // Public registration always creates a patient account
        ]);

        // Create the linked Patient profile row
        $patient = Patient::create([
            'user_id'        => $user->id,
            'cin'            => $validated['cin'],
            'telephone'      => $validated['telephone'],
            'adresse'        => $validated['adresse'],
            'date_naissance' => $validated['date_naissance'],
        ]);

        // Automatically create an empty dossier médical for this patient
        DossierMedical::create([
            'patient_id'     => $patient->id,
            'groupe_sanguin' => null,
            'allergies'      => null,
            'antecedents'    => null,
        ]);

        // STEP 3: Generate a 6-digit verification code and send it by email
        $code   = random_int(100000, 999999);
        $expiry = now()->addMinutes(10)->format('Y-m-d H:i:s');

        $user->update([
            'email_verification_token' => $code . '|' . $expiry,
        ]);

        $emailSent = false;
        try {
            Mail::to($user->email)->send(new EmailVerificationMail((string) $code, $user->name));
            $emailSent = true;
        } catch (\Throwable $exception) {
            \Log::error('Email verification send failed: ' . $exception->getMessage());
        }

        // Store email in session so the verification page knows who to verify
        session(['verify_email' => $user->email]);

        $message = $emailSent
            ? 'Un code de vérification a été envoyé à ' . $user->email
            : 'Compte créé. L\'envoi d\'email a échoué — utilisez "Renvoyer le code" sur la page suivante.';

        // STEP 4: Redirect to the email verification page (not logged in yet)
        return redirect()->route('email.verify.form')
            ->with('success', $message);
    }


    /**
     * Show the login form (GET /login)
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle the login form submission (POST /login)
     * Checks email + password against the database
     */
    public function login(Request $request)
    {
        // STEP 1: Validate
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // STEP 2: Attempt to login
        // Auth::attempt() does TWO things:
        //   1. Finds the useecks if Hash::chr by email
        //   2. Check(plain_password, hashed_password) matches
        // $request->boolean('remember') reads the "remember me" checkbox
        try {
            $authenticated = Auth::attempt($credentials, $request->boolean('remember'));
        } catch (RuntimeException) {
            $authenticated = false;
        }

        if ($authenticated) {

            // STEP 3: Regenerate session (security — prevents session fixation attacks)
            $request->session()->regenerate();

            // STEP 4: Redirect to dashboard
            // Inside login(), after session()->regenerate():
            return redirect()->intended(route('dashboard'));

            // intended() remembers where the user was trying to go before being redirected to login
        }

        // Legacy-hash fallback:
        // if the stored password uses a different algorithm, verify once with PHP directly,
        // then rehash it with the application's current hasher.
        if ($user && password_verify($credentials['password'], $user->password)) {
            $user->forceFill([
                'password' => Hash::make($credentials['password']),
            ])->save();

            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        // If login failed, redirect back with an error on the 'email' field
        // back() goes to the previous page (the login form)
        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas.',
        ])->onlyInput('email'); // Keep the email in the form, but clear the password
    }
   




    /**
     * Log the user out (POST /logout)
     */
    public function logout(Request $request)
    {
        Auth::logout();                            // End the authentication session
        $request->session()->invalidate();         // Destroy all session data
        $request->session()->regenerateToken();     // Generate new CSRF token (security)

        return redirect()->route('login');          // Send back to login page
    }
}
