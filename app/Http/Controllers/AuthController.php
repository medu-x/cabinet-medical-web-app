<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;          // Gives us access to form data ($request->name, $request->email, etc.)
use Illuminate\Support\Facades\Auth;  // Laravel's authentication system (login, logout, check if logged in)
use Illuminate\Support\Facades\Hash;  // Password encryption (never store plain passwords!)
use App\Models\User;                  // Our User model to interact with the 'users' table

class AuthController extends Controller
{
    // ==========================================
    // REGISTER
    // ==========================================

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
            'name'     => 'required|string|max:255',          // Must exist, be text, max 255 chars
            'email'    => 'required|email|unique:users',      // Must be valid email & not already in DB
            'password' => 'required|min:6|confirmed',         // Min 6 chars & must match password_confirmation field
            'role'     => 'required|in:patient,doctor,secretary', // Must be one of these 3 values
        ]);

        // STEP 2: Create the user in the database
        // Hash::make() encrypts the password so it's never stored as plain text
        // Example: "abc123" becomes "$2y$12$xK8f..." (impossible to reverse)
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        // STEP 3: Log the user in immediately after registration
        // This creates a session — the user won't need to go to the login page
        Auth::login($user);

        // STEP 4: Redirect to the dashboard
        // route('dashboard') generates the URL from the route name (we'll define it later)
        return redirect()->route('dashboard');
    }

    // ==========================================
    // LOGIN
    // ==========================================

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

        // STEP 2: Attempt to login
        // Auth::attempt() does TWO things:
        //   1. Finds the useecks if Hash::chr by email
        //   2. Check(plain_password, hashed_password) matches
        // $request->boolean('remember') reads the "remember me" checkbox
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // STEP 3: Regenerate session (security — prevents session fixation attacks)
            $request->session()->regenerate();

            // STEP 4: Redirect to dashboard
            // Inside login(), after session()->regenerate():
            return redirect()->intended(route('dashboard'));
            
            // intended() remembers where the user was trying to go before being redirected to login
        }

        // If login failed, redirect back with an error on the 'email' field
        // back() goes to the previous page (the login form)
        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas.',
        ])->onlyInput('email'); // Keep the email in the form, but clear the password
    }
    public function redirect(){
        if (Auth::user()->role == 'doctor') {
            return view('doctor.dashboard');
        } elseif (Auth::user()->role == 'secretary') {
            return view('secritaire.dashboard');
        } elseif (Auth::user()->role == 'admin'){
            return view('admin.dashboard');
        } else {
            return view('patient.dashboard');
        }
    }
        
    

    // ==========================================
    // LOGOUT
    // ==========================================

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