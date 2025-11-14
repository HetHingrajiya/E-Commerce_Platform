<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Throwable;

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
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        // Only use validated fields (avoid accidental mass assignment)
        $data = $request->validated();

        // Pick only attributes you expect to update (name, email)
        $name  = $data['name'] ?? $user->name;
        $email = $data['email'] ?? $user->email;

        // If email changed, mark as unverified
        if ($email !== $user->email) {
            $user->email_verified_at = null;
        }

        $user->name  = $name;
        $user->email = $email;

        try {
            $user->save();
        } catch (Throwable $e) {
            // Log and return a friendly error
            Log::error('Profile update failed for user id '.$user->id.': '.$e->getMessage(), [
                'exception' => $e,
                'payload' => $data,
            ]);

            // If request expects JSON (AJAX), return JSON error
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Could not update profile. Please try again later.'
                ], 500);
            }

            return back()->withInput()->withErrors(['error' => 'Could not update profile. Please try again later.']);
        }

        // Return JSON for AJAX or normal redirect for form submit
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['status' => 'profile-updated']);
        }

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

        return Redirect::to('/');
    }
}
