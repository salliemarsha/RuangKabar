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

    private ?bool $statusColumnExists = null;

    private function ensureAdmin(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'admin',
            403
        );
    }

    private function ensureManageableUser(User $user): void
    {
        abort_if($user->role === 'admin', 403);
    }

    private function hasStatus(): bool
    {
        if ($this->statusColumnExists === null) {
            $this->statusColumnExists = Schema::hasColumn('users', 'is_active');
        }

        return $this->statusColumnExists;
    }

    public function index(Request $request)
    {
        $this->ensureAdmin();

        $search = trim((string) $request->query('search', ''));
        $role = (string) $request->query('role', '');
        $status = (string) $request->query('status', '');
        $hasStatus = $this->hasStatus();

        if (! in_array($role, ['', ...self::ROLES], true)) {
            $role = '';
        }

        if (! in_array($status, ['', 'active', 'inactive'], true)) {
            $status = '';
        }

        if (! $hasStatus) {
            $status = '';
        }

        $columns = [
            'id',
            'name',
            'email',
            'role',
            'profile_photo',
            'created_at',
        ];

        if ($hasStatus) {
            $columns[] = 'is_active';
        }

        $query = User::query()
            ->select($columns)
            ->withCount(['articles', 'comments']);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $like = '%'.$search.'%';

                $q->where('name', 'like', $like)
                    ->orWhere('email', 'like', $like);
            });
        }

        if ($role !== '') {
            $query->where('role', $role);
        }

        if ($hasStatus && $status !== '') {
            $query->where('is_active', $status === 'active' ? 1 : 0);
        }

        $users = $query
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        if ($users->currentPage() > $users->lastPage()) {
            return redirect()->to($users->url($users->lastPage()));
        }

        $byRole = User::query()
            ->selectRaw('role, COUNT(*) as total')
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
            'name' => ['required', 'string', 'max:100'],
            'role' => ['required', Rule::in(['penulis', 'pengguna'])],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 100 karakter.',
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role yang dipilih tidak valid.',
        ]);

        $user->name = $validated['name'];
        $user->role = $validated['role'];
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function status(Request $request, User $user)
    {
        $this->ensureAdmin();
        $this->ensureManageableUser($user);

        abort_if((int) $user->id === (int) auth()->id(), 403);
        abort_unless($this->hasStatus(), 404);

        $validated = $request->validate([
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $user->is_active = $validated['status'] === 'active';
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                $user->is_active
                    ? 'Akun berhasil diaktifkan.'
                    : 'Akun berhasil dinonaktifkan.'
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
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Password pengguna berhasil direset.');
    }

    public function destroy(User $user)
    {
        $this->ensureAdmin();
        $this->ensureManageableUser($user);

        abort_if((int) $user->id === (int) auth()->id(), 403);

        if ($user->articles()->exists()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Akun tidak dapat dihapus karena masih memiliki artikel.');
        }

        try {
            $user->comments()->delete();
            $user->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Akun tidak dapat dihapus karena masih memiliki data terkait.');
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun pengguna berhasil dihapus.');
    }
}
