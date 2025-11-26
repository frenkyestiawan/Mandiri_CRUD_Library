<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfilePasswordController extends Controller
{
    /**
     * Update the authenticated user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Validate with error bag "updatePassword" to match the Blade partial
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Update password
        $user->forceFill([
            'password' => Hash::make($validated['password']),
        ])->save();

        // Optionally refresh login session
        Auth::login($user);

        return Redirect::route('profile.edit')->with('status', 'password-updated');
    }
}
