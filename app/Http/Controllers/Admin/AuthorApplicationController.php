<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuthorApplication;
use App\Notifications\AuthorApplicationDecisionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorApplicationController extends Controller
{
    public function index()
    {
        $applications = AuthorApplication::with(['user', 'reviewer'])
            ->latest()
            ->paginate(10);

        return view('admin.author-applications', compact('applications'));
    }

    public function approve(AuthorApplication $authorApplication)
    {
        abort_unless($authorApplication->status === 'pending', 404);

        $applicant = $authorApplication->user;

        DB::transaction(function () use ($authorApplication) {
            $authorApplication->user()->update([
                'role' => 'penulis',
            ]);

            $authorApplication->update([
                'status' => 'approved',
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
            ]);
        });

        $applicant->notify(
            new AuthorApplicationDecisionNotification(
                'author_application_approved',
                'Selamat! Pengajuan Anda menjadi penulis RuangKabar telah disetujui. Sekarang Anda dapat mengakses dashboard penulis.',
                '/penulis/dashboard'
            )
        );

        return back()->with(
            'success',
            'Pengajuan disetujui. Pengguna sekarang menjadi penulis.'
        );
    }

    public function reject(Request $request, AuthorApplication $authorApplication)
    {
        abort_unless($authorApplication->status === 'pending', 404);

        $validated = $request->validate([
            'admin_note' => ['nullable', 'string', 'max:2000'],
        ]);

        $applicant = $authorApplication->user;

        $authorApplication->update([
            'status' => 'rejected',
            'reviewed_by' => auth()->id(),
            'admin_note' => $validated['admin_note'] ?? null,
            'reviewed_at' => now(),
        ]);

        $message = 'Pengajuan Anda menjadi penulis RuangKabar belum disetujui.';

        if (! empty($validated['admin_note'])) {
            $message .= ' Catatan admin: '.$validated['admin_note'];
        }

        $applicant->notify(
            new AuthorApplicationDecisionNotification(
                'author_application_rejected',
                $message,
                '/beranda'
            )
        );

        return back()->with(
            'success',
            'Pengajuan berhasil ditolak.'
        );
    }
}
