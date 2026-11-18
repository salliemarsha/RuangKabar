<?php

namespace App\Http\Controllers;

use App\Models\AuthorApplication;
use App\Notifications\AuthorApplicationNotification;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorApplicationController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        abort_unless($user->role === 'pengguna', 403);

        $validated = $request->validate([
            'reason' => ['required', 'string', 'min:20', 'max:2000'],
        ]);

        $pending = AuthorApplication::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($pending) {
            return back()->with('error', 'Pengajuanmu masih menunggu keputusan admin.');
        }

        $application = AuthorApplication::create([
            'user_id' => $user->id,
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        User::where('role', 'admin')->get()->each(
            fn ($admin) => $admin->notify(
                new AuthorApplicationNotification($application->id, $user->name)
            )
        );

        return back()->with('success', 'Pengajuan menjadi penulis berhasil dikirim.');
    }
}
