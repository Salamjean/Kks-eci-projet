<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
    // Validation du champ commune
    $validatedData = $request->validate([
        'commune' => 'required|string|in:abobo,adjame,attécoube,cocody,koumassi,marcory,plateau,port-bouët,treichville,yopougon',
    ]);

    // Ajouter la commune aux données validées
    $validatedData['commune'] = $request->input('commune');

    $validatedData['name'] = $request->input('name');
    $validatedData['prenom'] = $request->input('prenom');

    // Remplir l'utilisateur avec les données validées
    $request->user()->fill($validatedData);

    // Réinitialiser la vérification de l'email si l'email est modifié
    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    // Sauvegarder les modifications de l'utilisateur
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
