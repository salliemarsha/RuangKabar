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
}
