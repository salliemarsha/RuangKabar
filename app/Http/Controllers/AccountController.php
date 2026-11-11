<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('account.settings', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->save();

        return redirect()
            ->route('account.settings')
            ->with('success', 'Informasi profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'Password lama tidak sesuai.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru minimal 8 karakter.',
        ]);

        $user = auth()->user();
        $user->password = $validated['password'];
        $user->save();

        return redirect()
            ->route('account.settings')
            ->with('success', 'Password berhasil diperbarui.');
    }
}
