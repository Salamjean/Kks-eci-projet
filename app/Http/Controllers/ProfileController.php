<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Gestion de la photo de profil
        if ($request->hasFile('profile_picture')) {
            // Supprimer l'ancienne photo si elle existe
            if ($request->user()->profile_picture) {
                Storage::delete('public/' . $request->user()->profile_picture);
            }
    
            // Stocker la nouvelle photo
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $path;
        }
    
        // Mettre à jour les autres champs
        $request->user()->fill($validatedData);
    
        // Réinitialiser la vérification de l'email si l'email est modifié
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
    
        // Sauvegarder les modifications
        $request->user()->save();
    
        // Rediriger avec un message de succès
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('login');
    }
}
