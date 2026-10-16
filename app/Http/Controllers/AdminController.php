<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::query()
            ->select(['id', 'name', 'username', 'role', 'created_at'])
            ->orderBy('id')
            ->paginate(10);

        return response()->json($users);
    }

    public function userIndex(Request $request)
{
    $search = trim($request->query('search', ''));
    $role = $request->query('role', '');

    if (! in_array($role, ['', 'penulis', 'pengguna'], true)) {
        $role = '';
    }

    $users = User::query()
        ->select(['id', 'name', 'username', 'role', 'created_at'])
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%');
            });
        })
        ->when($role !== '', function ($query) use ($role) {
            $query->where('role', $role);
        })
        ->orderBy('id')
        ->paginate(10)
        ->withQueryString();

    return view('admin.users', compact('users', 'search', 'role'));
}

public function updateUser(Request $request, User $user)
{
    if ($user->role === 'admin') {
        abort(403, 'Akun admin tidak dapat diubah melalui fitur ini.');
    }

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'username' => [
            'required',
            'string',
            'max:255',
            'alpha_dash',
            \Illuminate\Validation\Rule::unique('users', 'username')->ignore($user->id),
        ],
        'role' => ['required', 'in:penulis,pengguna'],
    ]);

    $user->name = $validated['name'];
    $user->username = $validated['username'];
    $user->role = $validated['role'];
    $user->save();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'Data pengguna berhasil diperbarui.');
}

public function deleteUser(User $user)
{
    if ($user->role === 'admin' || $user->id === auth()->id()) {
        abort(403, 'Akun ini tidak dapat dihapus.');
    }

    $user->delete();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'Pengguna berhasil dihapus.');
}
}
