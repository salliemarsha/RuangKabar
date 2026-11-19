<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('account.settings', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 100 karakter.',
        ]);

        $user = $request->user();

        $user->name = $validated['name'];
        $user->save();

        return redirect()
            ->route('account.settings')
            ->with('success', 'Nama lengkap berhasil diperbarui.');
    }

    public function updateProfilePhoto(Request $request)
    {
        $validated = $request->validate([
            'profile_photo' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'profile_photo.required' => 'Pilih foto profil terlebih dahulu.',
            'profile_photo.image' => 'File harus berupa gambar.',
            'profile_photo.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WebP.',
            'profile_photo.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $user = $request->user();

        // Simpan foto melalui disk public Laravel.
        $newPhoto = $validated['profile_photo']->store(
            'profile-photos',
            'public'
        );

        if (!$newPhoto) {
            return back()->withErrors([
                'profile_photo' => 'Foto profil gagal disimpan. Silakan coba kembali.',
            ]);
        }

        $oldPhoto = $user->profile_photo;

        $user->profile_photo = $newPhoto;
        $user->save();

        // Hapus foto lama setelah foto baru berhasil disimpan.
        if ($oldPhoto && $oldPhoto !== $newPhoto) {
            $this->deleteProfilePhotoFiles($oldPhoto);
        }

        return redirect()
            ->route('account.settings')
            ->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function deleteProfilePhoto(Request $request)
    {
        $user = $request->user();

        if ($user->profile_photo) {
            $this->deleteProfilePhotoFiles($user->profile_photo);

            $user->profile_photo = null;
            $user->save();
        }

        return redirect()
            ->route('account.settings')
            ->with('success', 'Foto profil berhasil dihapus.');
    }

    private function deleteProfilePhotoFiles(string $path): void
    {
        Storage::disk('public')->delete($path);

        $publicFile = public_path('storage/' . $path);

        if (is_file($publicFile)) {
            unlink($publicFile);
        }
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

        $user = $request->user();

        $user->password = $validated['password'];
        $user->save();

        return redirect()
            ->route('account.settings')
            ->with('success', 'Password berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        abort_if(
            $user->role === 'admin',
            403,
            'Akun administrator tidak dapat dihapus melalui pengaturan akun.'
        );

        $request->validate([
            'confirmation' => ['required', 'in:HAPUS'],
        ], [
            'confirmation.required' => 'Ketik HAPUS untuk mengonfirmasi penghapusan akun.',
            'confirmation.in' => 'Konfirmasi penghapusan akun tidak sesuai.',
        ]);

        $profilePhoto = $user->profile_photo;

        DB::transaction(function () use ($user) {
            // Hapus komentar milik akun.
            $user->comments()->delete();

            // Pertahankan artikel dan relasinya.
            // Anonimkan identitas pemilik artikel.
            $user->name = 'Akun Dihapus';
            $user->email = 'deleted-' . $user->id . '@ruangkabar.invalid';
            $user->password = Hash::make(Str::random(64));
            $user->profile_photo = null;

            $user->save();
        });

        Auth::logout();

        if ($profilePhoto) {
            $this->deleteProfilePhotoFiles($profilePhoto);
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with(
                'success',
                'Akun berhasil dihapus. Artikel yang pernah dibuat tetap tersedia dengan nama penulis Akun Dihapus.'
            );
    }
}
