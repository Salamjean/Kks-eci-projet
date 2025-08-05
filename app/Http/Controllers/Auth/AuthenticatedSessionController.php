<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
        return redirect()->route('login')->withErrors([
            'email' => 'Le mot de passe incorrect.',
        ]);
    }

    // Si l'authentification réussit, régénérer la session
    $request->session()->regenerate();

    // Rediriger vers la page de tableau de bord avec un message de succès
    return redirect()->intended(route('dashboard', absolute: false))->with('success', 'Bienvenue sur votre page!');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
