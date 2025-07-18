<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login page.
     */
    public function create()
    {
        return Inertia::render('LogIn');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Handles auth & remember me logic
        $request->authenticate();

        // Regenerate session to prevent fixation
        $request->session()->regenerate();

        // Flash a success message to be displayed in Vue
        $request->session()->flash('success', 'Welcome back!');

        // Redirect to intended page or dashboard
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Logout and destroy session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended(route('home', absolute: true));
    }
}

