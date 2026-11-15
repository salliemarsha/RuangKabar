<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class PengelolaanPenggunaController extends Controller
{
    private const ROLES = ['admin', 'penulis', 'pengguna'];

    private function ensureAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
    }

    private function ensureManageableUser(User $user): void
    {
        abort_if(
            $user->role === 'admin',
            403,
            'Akun admin dilindungi dan tidak dapat dikelola melalui halaman ini.'
        );
    }

    private function hasStatus(): bool
    {
        static $has = null;

        return $has ??= Schema::hasColumn('users', 'is_active');
    }

    public function index(Request $request)
    {
        $this->ensureAdmin();

        $hasStatus = $this->hasStatus();

        $rawSearch = $request->query('search');
        $search = is_string($rawSearch) ? trim($rawSearch) : '';

        $role = in_array($request->query('role'), self::ROLES, true)
            ? $request->query('role')
            : '';

        $status = $hasStatus && in_array($request->query('status'), ['active', 'inactive'], true)
            ? $request->query('status')
            : '';

        $columns = ['id', 'name', 'username', 'role', 'created_at'];

        if ($hasStatus) {
            $columns[] = 'is_active';
        }

        $users = User::query()
            ->select($columns)
            ->withCount(['articles', 'comments'])
            ->when($search !== '', function ($query) use ($search) {
                $like = '%' . addcslashes($search, '%\_\\') . '%';

                $query->where(function ($query) use ($like) {
                    $query->where('name', 'like', $like)
                        ->orWhere('username', 'like', $like);
                });
            })
            ->when($role !== '', fn ($query) => $query->where('role', $role))
            ->when($status !== '', fn ($query) => $query->where('is_active', $status === 'active'))
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        if ($users->isEmpty() && $users->currentPage() > 1) {
            return redirect()->route('admin.users.index', array_merge(
                $request->query(),
                ['page' => $users->lastPage()]
            ));
        }

        $byRole = User::selectRaw('role, COUNT(*) as total')
            ->groupBy('role')
            ->pluck('total', 'role');

        $inactive = $hasStatus
            ? User::where('is_active', false)->count()
            : null;

        return view('admin.users', compact(
            'users',
            'search',
            'role',
            'status',
            'hasStatus',
            'byRole',
            'inactive'
        ));
    }

    public function update(Request $request, User $user)
    {
        $this->ensureAdmin();
        $this->ensureManageableUser($user);

        $validated = $request->validateWithBag('editUser', [
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'role' => ['required', Rule::in(['penulis', 'pengguna'])],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan akun lain.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, strip, dan garis bawah.',
            'role.required' => 'Peran wajib dipilih.',
            'role.in' => 'Peran yang dipilih tidak valid.',
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->role = $validated['role'];
        $user->save();

        return back()->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function status(Request $request, User $user)
    {
        $this->ensureAdmin();
        $this->ensureManageableUser($user);

        if (! $this->hasStatus()) {
            return back()->with(
                'error',
                'Fitur status akun belum aktif. Jalankan migration kolom is_active terlebih dahulu.'
            );
        }

        $validated = $request->validate([
            'status' => ['required', 'in:active,inactive'],
        ]);

        $user->is_active = $validated['status'] === 'active';
        $user->save();

        return back()->with(
            'success',
            $user->is_active
                ? 'Akun ' . $user->name . ' berhasil diaktifkan.'
                : 'Akun ' . $user->name . ' berhasil dinonaktifkan.'
        );
    }

    public function password(Request $request, User $user)
    {
        $this->ensureAdmin();
        $this->ensureManageableUser($user);

        $validated = $request->validateWithBag('resetPassword', [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('success', 'Password ' . $user->name . ' berhasil direset.');
    }

    public function destroy(User $user)
    {
        $this->ensureAdmin();
        $this->ensureManageableUser($user);

        $articles = $user->articles()->count();
        $comments = $user->comments()->count();

        if ($articles > 0 || $comments > 0) {
            $reasons = [];

            if ($articles > 0) {
                $reasons[] = $articles . ' artikel';
            }

            if ($comments > 0) {
                $reasons[] = $comments . ' komentar';
            }

            return back()->with(
                'error',
                'Akun ' . $user->name . ' tidak dapat dihapus karena masih memiliki ' .
                implode(' dan ', $reasons) .
                '. Nonaktifkan akun untuk mempertahankan data historis.'
            );
        }

        try {
            $user->delete();
        } catch (QueryException $e) {
            report($e);

            return back()->with(
                'error',
                'Akun tidak dapat dihapus karena masih terhubung dengan data lain.'
            );
        }

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
